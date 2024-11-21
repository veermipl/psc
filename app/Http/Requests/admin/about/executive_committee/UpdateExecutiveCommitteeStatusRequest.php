<?php

namespace App\Http\Requests\admin\about\executive_committee;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExecutiveCommitteeStatusRequest extends FormRequest
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
            'lid' => ['required', 'exists:executive_committeess,id'],
            'lstatus' => ['required'],
        ];
    }
}
