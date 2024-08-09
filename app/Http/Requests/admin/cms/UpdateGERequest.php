<?php

namespace App\Http\Requests\admin\cms;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGERequest extends FormRequest
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
            'id' => ['required', 'exists:guyana_economies,id'],
            'title' => ['required'],
            'old_images' => ['nullable', 'array'],
            'images' => ['nullable', 'array'],
            'images.*' => ['nullable', 'image', 'mimes:jpg,jpeg,gif,png'],
            'content' => ['required'],
            'status' => ['required', 'in:0,1'],
        ];
    }
}
