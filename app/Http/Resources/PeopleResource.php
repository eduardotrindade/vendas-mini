<?php

namespace App\Http\Resources;

use App\Models\People;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PeopleResource extends JsonResource
{
    /**
     * @var People
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
            'document_number' => $this->resource->document_number,
            'cellphone' => $this->resource->cellphone,
            'email' => $this->resource->email,
            'address' => $this->resource->address,
            'number' => $this->resource->number,
            'complement' => $this->resource->complement,
            'neighborhood' => $this->resource->neighborhood,
            'zip_code' => $this->resource->zip_code,
            'indicated_by' => $this->resource->indicated_by,
            'resume' => $this->resource->resume,
            'terms_accepted' => $this->resource->terms_accepted,
            'is_active' => $this->resource->is_active,
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
            'city' => CityResource::make($this->resource->city),
            'profile' => ProfileResource::make($this->resource->profile)
        ];
    }
}
