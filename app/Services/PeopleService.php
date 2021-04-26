<?php

namespace App\Services;

use App\Mail\PeopleActived;
use App\Mail\PeopleIndicatedActived;
use App\Mail\PeopleRegistered;
use App\Models\People;
use App\Models\Profile;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
}
