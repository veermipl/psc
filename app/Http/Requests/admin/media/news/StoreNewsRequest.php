<?php

namespace App\Http\Requests\admin\media\news;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsRequest extends FormRequest
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
            'title' => ['required'],
            // 'files' => ['nullable', 'array'],
            'files' => ['required', 'file', 'mimes:jpg,jpeg,gif,png,pdf'],
            'content' => ['nullable'],
            'status' => ['required', 'in:0,1'],
        ];
    }
}
