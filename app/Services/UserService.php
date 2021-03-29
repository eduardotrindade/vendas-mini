<?php

namespace App\Services;

use App\Models\User;
use Hash;
use Illuminate\Support\Str;

class UserService
{
    public function insert(array $data): int
    {
        $user = new User([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make(substr($data['document_number'], 0, 5)),
            'remember_token' => Str::random(10),
        ]);

        $user->save();

        return $user->id;
    }
}
