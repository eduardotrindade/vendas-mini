<?php

namespace App\Http\Resources;

use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StateResource extends JsonResource
{
    /**
     * @var State
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
            'name' => $this->resource->name
        ];
    }
}
