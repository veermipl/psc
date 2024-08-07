<?php

namespace App\Http\Requests\admin\settings;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactUsSettingsRequest extends FormRequest
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
            'opening_hours' => ['required'],
            'phone' => ['required'],
            'opening_hours' => ['required'],
            'opening_hours' => ['required'],
            'opening_hours' => ['required'],
            'opening_hours' => ['required'],
            'opening_hours' => ['required'],
            'opening_hours' => ['required'],
        ];
    }
}
