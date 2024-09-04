<?php

namespace App\Http\Requests\admin\cms\landing_page;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'source_id' => ['required', 'exists:landing_page,id'],
            'title' => ['required'],
            'old_file' => ['nullable', 'string'],
            'file' => ['nullable', 'image', 'mimes:jpg,jpeg,gif,png', 'max:2048'],
            'content' => ['required'],
            'type' => ['required'],
            'status' => ['required', 'in:0,1'],
        ];
    }
}
