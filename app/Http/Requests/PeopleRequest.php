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
            'email' => ['required', Rule::unique('people')->ignore($people)],
            'address' => 'required',
            'number' => 'required',
            'complement' => 'nullable',
            'neighborhood' => 'nullable',
            'zip_code' => 'required',
            'city_id' => 'required',
            'resume' => 'required',
            'terms_accepted' => 'required',
            'indicated_by' => 'nullable',
            'profile_id' => 'nullable',
        ];
    }
}
