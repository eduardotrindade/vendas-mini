<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\State
 *
 * @property int $id
 * @property string $abbreviation
 * @property string $name
 * @property City[] $cities
 */
class State extends Model
{
    use HasFactory;

    public function cities()
    {
        return $this->hasMany(City::class)->orderBy('name');
    }
}
