<?php

namespace App\Http\Requests\admin\authorization\role;

use Illuminate\Foundation\Http\FormRequest;

class CreateRoleRequest extends FormRequest
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
            'name' => ['required', 'string', 'unique:roles,name'],
            'permissions' => ['required', 'array'],
            // 'permissions.*' => ['required', 'exists:permissions,name_key'],
        ];
    }

    public function messages(): array
    {
        return [
            'permissions.required' => 'Select at least 1 permission for this role'
        ];
    }
}
