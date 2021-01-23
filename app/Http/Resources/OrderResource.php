<?php

namespace App\Http\Resources;

use App\Models\Order;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * @var Order
     */
    public $resource;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'status' => $this->resource->status,
            'payment_date' => $this->resource->payment_date,
            'amount_paid' => $this->resource->amount_paid,
            'product' => ProductResource::make($this->resource->product),
            'people' => PeopleResource::make($this->resource->people),
            'created_at' => $this->resource->created_at
        ];
    }
}
