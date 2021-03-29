<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Profile
 *
 * @property int $id
 * @property string $name
 * @property Product[] $products
 */
class Profile extends Model
{
    public const DIRETOR = 1;
    public const MASTER = 2;
    public const AFILIADO = 3;

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
