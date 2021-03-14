<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property int $people_id
 * @property int $product_id
 * @property int $status
 * @property string $payment_date
 * @property float $amount_paid
 * @property string $payment_code
 * @property string $payment_link
 * @property Product $product
 * @property People $people
 * @property string $conta_azul_code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Order extends Model
{
    protected $fillable = ['people_id', 'product_id', 'amount_paid'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function people()
    {
        return $this->belongsTo(People::class);
    }
}
