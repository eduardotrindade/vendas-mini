<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public const ADMINISTRATOR = 1;
    public const MASTER = 2;
    public const AFILIADO = 3;
}
