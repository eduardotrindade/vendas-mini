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
}
