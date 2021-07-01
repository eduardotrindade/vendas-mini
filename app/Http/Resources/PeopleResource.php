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
            'birth_date' => $this->resource->birth_date,
            'education' => $this->resource->education,
            'number' => $this->resource->number,
            'complement' => $this->resource->complement,
            'neighborhood' => $this->resource->neighborhood,
            'zip_code' => $this->resource->zip_code,
            'resume' => $this->resource->resume,
            'terms_accepted' => $this->resource->terms_accepted,
            'is_active' => $this->resource->is_active,
            'city' => CityResource::make($this->resource->city),
            'profile' => ProfileResource::make($this->resource->profile),
            'indicated_by' => $this->resource->people->name ?? null,
            'referral_link' => $this->resource->getReferralLink(),
            'created_at' => $this->resource->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
