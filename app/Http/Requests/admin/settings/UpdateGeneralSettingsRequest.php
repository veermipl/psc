<?php

namespace App\Http\Requests\admin\settings;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGeneralSettingsRequest extends FormRequest
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
            'app_name' => ['required', 'string'],
            'app_logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif'],
            'admin_mail' => ['required', 'email'],
        ];
    }

    public function messages(): array
    {
        return [
            'app_name.required' => 'The application name field is required.',
            'app_logo.required' => 'The application logo field is required.',
        ];
    }
}
