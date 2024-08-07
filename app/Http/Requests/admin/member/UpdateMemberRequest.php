<?php

namespace App\Http\Requests\admin\member;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMemberRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'membership_type' => ['required', 'exists:membership_types,id'],
            // 'email' => ['required', 'unique:users,email'],
            'contact' => ['nullable', 'integer'],
            'form_pdf' => ['nullable', 'mimes:pdf', 'max:2048'],
            'supported_files' => ['nullable'],
            'password' => ['nullable'],
            'status' => ['required', 'in:0,1'],
        ];
    }
}
