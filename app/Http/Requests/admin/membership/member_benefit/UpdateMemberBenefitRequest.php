<?php

namespace App\Http\Requests\admin\membership\member_benefit;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMemberBenefitRequest extends FormRequest
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
            'old_file' => ['nullable', 'string'],
            'file' => ['required_if:old_file,null', 'image', 'mimes:jpg,jpeg,gif,png', 'max:2048'],
            'content' => ['required'],
            'type' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'file.required_if' => 'The file field is required',
        ];
    }
}
