<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeopleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'document_number' => 'required|unique:people',
            'cellphone' => 'required',
            'email' => 'required',
            'address' => 'required',
            'number' => 'required',
            'complement' => 'nullable',
            'neighborhood' => 'nullable',
            'zip_code' => 'required',
            'city_id' => 'required',
            'indicated_by' => 'required',
            'resume' => 'required',
            'terms_accepted' => 'required',
        ];
    }
}
