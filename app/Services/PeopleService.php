<?php

namespace App\Services;

use App\Gateway\ContaAzul\ContaAzul;
use App\Models\People;
use Exception;
use Illuminate\Support\Facades\DB;

class PeopleService
{
    public function insert(array $data, ContaAzulService $contaAzulService): People
    {
        DB::beginTransaction();
        try {
            $people = new People($data);

            $people->conta_azul_code = $contaAzulService->createCustomer($people);

            $people->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $people;
    }

    public function update(People $people, array $data): People
    {
        DB::beginTransaction();
        try {
            $people->update($data);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $people;
    }

    public function active(People $people, ?int $profileId): People
    {
        DB::beginTransaction();
        try {
            $people->is_active = true;

            if (!$people->profile_id) {
                $people->profile_id = $profileId;
            }

            $people->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $people;
    }
}
