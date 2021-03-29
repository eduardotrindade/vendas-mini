<?php

namespace App\Http\Resources;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{
    /**
     * @var City
     */
    public $resource;

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'is_capital' => $this->resource->is_capital,
            'state' => StateResource::make($this->resource->state)
        ];
    }
}
