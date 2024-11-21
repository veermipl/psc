<?php

namespace App\Http\Requests\admin\about\executive_committee;

use Illuminate\Foundation\Http\FormRequest;

class StoreExecutiveCommitteeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'  => 'required',
            'designation'  => 'required',
            'terms_of_reference' => 'required', 'string',
            'facebook' => ['nullable', 'url'],
            'twitter' => ['nullable', 'url'],
            'instagram' => ['nullable', 'url'],
            'dribbble' => ['nullable', 'url'],
            'profile'  => ['required', 'image', 'mimes:jpeg,jpg,png'],
            'status' => ['required', 'in:0,1'],
        ];
    }
}
