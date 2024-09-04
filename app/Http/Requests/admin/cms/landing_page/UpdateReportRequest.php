<?php

namespace App\Http\Requests\admin\cms\landing_page;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReportRequest extends FormRequest
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
            'link' => ['nullable'],
            'old_file' => ['nullable', 'string'],
            'file' => ['required_if:old_file,null', 'image', 'mimes:jpg,jpeg,gif,png', 'max:2048'],
            'old_icon' => ['nullable', 'string'],
            'icon' => ['nullable', 'image', 'mimes:jpg,jpeg,gif,png', 'max:2048'],
            'content' => ['required'],
            'type' => ['required'],
        ];
    }
}
