<?php

namespace App\Services;

use App\Helpers\PhoneFormatter;
use App\Mail\PeopleActived;
use App\Mail\PeopleIndicatedActived;
use App\Mail\PeopleRegistered;
use App\Models\People;
use App\Models\Profile;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PeopleService
{
    private ContaAzulService $contaAzulService;
    private UserService $userService;

    public function __construct(ContaAzulService $contaAzulService, UserService $userService)
    {
        $this->contaAzulService = $contaAzulService;
        $this->userService = $userService;
    }

    public function insert(array $data): People
    {
        DB::beginTransaction();
        try {
            $people = new People($data);

            if ($people->profile_id === Profile::DIRETOR) {
                $people->is_active = true;
                $people->user_id = $this->userService->insert($data);
            } else {
                $people->setPeopleId($data['indicated_by']);
            }

            $people->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }

        if ($people->profile_id !== Profile::DIRETOR) {
            Mail::to($people->email)->send(new PeopleRegistered($people->name));
        }

        return $people;
    }

    public function update(People $people, array $data): People
    {
        DB::beginTransaction();
        try {
            $people->fill($data);

            if (strlen($data['indicated_by']) >= 12 && $people->profile_id != Profile::DIRETOR) {
                $people->setPeopleId($data['indicated_by']);
            }

            $people->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $people;
    }

    public function changeActive(People $people, ?int $profileId = null): People
    {
        DB::beginTransaction();
        try {
            $people->is_active = !$people->is_active;

            if (!$people->profile_id) {
                $people->profile_id = $profileId;
            }

            $people->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }

        if ($profileId) {
            Mail::to($people->email)->send(new PeopleActived($people));
        }

        if ($people->people_id && $profileId) {
            Mail::to($people->people->email)->send(new PeopleIndicatedActived($people));
        }

        return $people;
    }

    public function export(): string
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Representantes');
        $sheet->setCellValue('A1', 'Nome');
        $sheet->setCellValue('B1', 'Telefone');
        $sheet->setCellValue('C1', 'UF');
        $sheet->setCellValue('D1', 'Cidade');
        $sheet->setCellValue('E1', 'Indicado por');
        $sheet->setCellValue('F1', 'Data');
        $sheet->setCellValue('G1', 'Status');
        $sheet->setCellValue('H1', 'Perfil');
        $sheet->setCellValue('I1', 'Link Indicação');

        $people = People::all();

        $line = 2;
        foreach ($people as $person) {
            $sheet->setCellValue('A' . $line, $person->name);
            $sheet->setCellValue('B' . $line, PhoneFormatter::formatter($person->cellphone));
            $sheet->setCellValue('C' . $line, $person->city->state->abbreviation);
            $sheet->setCellValue('D' . $line, $person->city->name);
            $sheet->setCellValue('E' . $line, $person->people_id ? $person->people->name : '');
            $sheet->setCellValue('F' . $line, $person->created_at->format('d/m/Y'));
            $sheet->setCellValue('G' . $line, $person->is_active ? 'Ativo' : 'Inativo');
            $sheet->setCellValue('H' . $line, $person->profile->name);
            $sheet->setCellValue('I' . $line, $person->getReferralLink());
            $line++;
        }

        $file = storage_path('app/representantes.xlsx');

        $writer = new Xlsx($spreadsheet);
        $writer->save($file);

        return $file;
    }
}
