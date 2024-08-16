<?php

namespace App\Http\Requests\admin\membership\business_directory;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBusinessDirectoryRequest extends FormRequest
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
            'sub_name' => ['nullable', 'string'],
            'status' => ['required', 'in:0,1'],
        ];
    }
}
