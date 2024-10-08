<?php

namespace App\Http\Requests\admin\media\photo;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePhotoRequest extends FormRequest
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
            'old_image' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,gif,png'],
            'title' => ['required', 'string'],
            'status' => ['required', 'in:0,1'],
        ];
    }
}
