<?php

namespace App\Services;

use App\Mail\OrderIdentifiedPayment;
use App\Models\Order;
use DateTime;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use MercadoPago\Item;
use MercadoPago\Payment;
use MercadoPago\Preference;
use MercadoPago\SDK;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class OrderService
{
    private ContaAzulService $contaAzulService;

    public function __construct(ContaAzulService $contaAzulService)
    {
        $this->contaAzulService = $contaAzulService;
    }

    public function insert(array $data): Order
    {
        DB::beginTransaction();
        try {
            $order = Order::create($data);

            $this->createPayment($order);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $order;
    }

    private function createPayment(Order $order): void
    {
        SDK::setAccessToken(config('mercado-pago.access_token'));

        $item = new Item();
        $item->title = $order->product->description;
        $item->quantity = 1;
        $item->unit_price = $order->amount_paid;

        $preference = new Preference();
        $preference->items = array($item);

        $urlFeedback = url('/feedback'); //rota front-end
        $preference->back_urls = array(
            'success' => $urlFeedback,
            'failure' => $urlFeedback,
            'pending' => $urlFeedback
        );
        $preference->auto_return = 'approved';

        $preference->statement_descriptor = 'VENDASMINISITIO';
        $preference->external_reference = $order->id;
        $preference->notification_url = route('paymentNotification');

        $preference->expires = true;

        $preference->expiration_date_to = (new DateTime())->modify('+ 5 days')->format('Y-m-d\TH:i:sO');

        $preference->binary_mode = true;

        $preference->save();

        $order->payment_code = $preference->id;
        $order->payment_link = $preference->init_point;
        $order->save();
    }

    public function paymentNotification(array $data): void
    {
        $typeNotification = $data['topic'] ?? $data['type'];
        if ($typeNotification !== 'payment') {
            return;
        }

        SDK::setAccessToken(config('mercado-pago.access_token'));

        $payment = Payment::find_by_id($data['id']);

        $order = Order::where('id', $payment->external_reference)->first();

        $this->changeStatusPayment($order, $payment);
    }

    public function searchStatusPayment(): void
    {
        try {
            SDK::setAccessToken(config('mercado-pago.access_token'));

            $orders = Order::query()->where('status', false)->get();
            foreach ($orders as $order) {
                $search = Payment::search([
                    'sort' => 'date_created',
                    'criteria' => 'desc',
                    'external_reference' => $order->id
                ]);

                $payments = $search->getArrayCopy();

                $payment = array_shift($payments);
                if (!$payment) {
                    continue;
                }

                $this->changeStatusPayment($order, $payment);
            }
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    private function changeStatusPayment(Order $order, Payment $payment): void
    {
        if ($payment->status !== 'approved') {
            return;
        }

        $order->status = true;
        $order->payment_date = date('Y-m-d H:i:s');
        $order->conta_azul_code = $this->contaAzulService->createSale($order);
        $order->save();

        Mail::to($order->people->email)->send(new OrderIdentifiedPayment($order));
    }

    public function export(): string
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Compras');
        $sheet->setCellValue('A1', 'Código');
        $sheet->setCellValue('B1', 'Item');
        $sheet->setCellValue('C1', 'Valor');
        $sheet->setCellValue('D1', 'Status');
        $sheet->setCellValue('E1', 'Criado');
        $sheet->setCellValue('F1', 'Informação');
        $sheet->setCellValue('G1', 'Representante');
        $sheet->setCellValue('H1', 'Perfil');

        $orders = Order::all();

        $line = 2;
        foreach ($orders as $order) {
            $sheet->setCellValue('A' . $line, $order->id);
            $sheet->setCellValue('B' . $line, $order->product->description);
            $sheet->setCellValue('C' . $line, number_format($order->amount_paid, 2, ',', '.'));
            $sheet->setCellValue('D' . $line, $order->status ? 'Pago' : 'Aguardando Pagamento');
            $sheet->setCellValue('E' . $line, $order->created_at->format('d/m/Y'));
            $sheet->setCellValue('F' . $line, $order->information);
            $sheet->setCellValue('G' . $line, $order->people->name);
            $sheet->setCellValue('H' . $line, $order->people->profile->name);
            $line++;
        }

        $file = storage_path('app/compras.xlsx');

        $writer = new Xlsx($spreadsheet);
        $writer->save($file);

        return $file;
    }
}
