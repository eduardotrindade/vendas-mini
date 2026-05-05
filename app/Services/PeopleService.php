<?php

namespace App\Services;

use App\Helpers\PhoneFormatter;
use App\Mail\PeopleActived;
use App\Mail\PeopleIndicatedActived;
use App\Mail\PeopleRegistered;
use App\Models\People;
use App\Models\Profile;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PeopleService
{
    private $contaAzulService;
    private $userService;

    public function __construct(ContaAzulService $contaAzulService, UserService $userService)
    {
        $this->contaAzulService = $contaAzulService;
        $this->userService = $userService;
    }

    public function insert($data)
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

    public function update($people, $data)
    {
        DB::beginTransaction();
        try {
            $people->fill($data);

            if (strlen($data['indicated_by']) >= 12 && $people->profile_id != Profile::DIRETOR) {
                $indicatedBy = explode('/', $data['indicated_by']);
                $indicatedBy = Arr::last($indicatedBy);
                $people->setPeopleId($indicatedBy);
            }

            if ($people->profile_id === Profile::DIRETOR && !$people->user_id) {
                $people->user_id = $this->userService->insert($data);
            }

            $idUserForDelete = null;
            if ($people->profile_id !== Profile::DIRETOR && $people->user_id) {
                $idUserForDelete = $people->user_id;
                $people->user_id = null;
            }

            $people->save();

            if ($idUserForDelete) {
                $this->userService->delete($idUserForDelete);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $people;
    }

    public function changeActive($people, $profileId = null)
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

    public function export()
    {
        $file = storage_path('app/representantes.csv');
        $handle = fopen($file, 'w');

        // Add UTF-8 BOM for Excel compatibility
        fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));

        fputcsv($handle, [
            'Nome', 'Telefone', 'UF', 'Cidade', 'Indicado por', 'Data', 'Status', 'Perfil', 'Link Indicação'
        ], ';');

        /** @var People[] $people */
        $people = People::all();

        foreach ($people as $person) {
            fputcsv($handle, [
                $person->name,
                PhoneFormatter::formatter($person->cellphone),
                $person->city->state->abbreviation ?? '',
                $person->city->name ?? '',
                $person->people_id ? ($person->people->name ?? '') : '',
                $person->created_at->format('d/m/Y'),
                $person->is_active ? 'Ativo' : 'Inativo',
                $person->profile_id ? ($person->profile->name ?? '') : '',
                $person->getReferralLink()
            ], ';');
        }

        fclose($handle);

        return $file;
    }
}
