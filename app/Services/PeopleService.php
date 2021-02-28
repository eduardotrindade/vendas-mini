<?php

namespace App\Services;

use App\Models\People;
use App\Models\Profile;
use Exception;
use Illuminate\Support\Facades\DB;

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
                $people->conta_azul_code = $this->contaAzulService->createCustomer($people);
            }

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
