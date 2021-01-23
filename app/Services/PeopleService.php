<?php

namespace App\Services;

use App\Models\People;
use Exception;
use Illuminate\Support\Facades\DB;

class PeopleService
{
    public function insert(array $data): People
    {
        DB::beginTransaction();
        try {
            $people = People::create($data);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
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
        }

        return $people;
    }
}
