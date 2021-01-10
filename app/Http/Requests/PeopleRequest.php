<?php

namespace App\Http\Requests;

use App\Models\People;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        /** @var People $people */
        $people = $this->route('people');

        return [
            'name' => 'required',
            'document_number' => ['required', Rule::unique('people')->ignore($people)],
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
            'is_active' => 'nullable',
            'profile_id' => 'nullable'
        ];
    }
}
