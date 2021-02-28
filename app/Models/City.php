<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\City
 *
 * @property int $id
 * @property string $name
 * @property int $is_capital
 * @property int $state_id
 * @property State $state
 */
class City extends Model
{
    use HasFactory;

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
