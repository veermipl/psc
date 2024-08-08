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
            'content' => ['required', 'string'],
            'opening_hours' => ['required', 'string'],
            'phone' => ['required', 'integer'],
            'address' => ['required', 'string'],
            'email' => ['required', 'email'],
            'facebook' => ['required', 'url'],
            'twitter' => ['required', 'url'],
            'instagram' => ['required', 'url'],
            'youtube' => ['required', 'url'],
        ];
    }

    public function messages(){
        return [
            'facebook.required' => 'The facebook url is required.',
            'twitter.required' => 'The twitter url is required.',
            'instagram.required' => 'The instagram url is required.',
            'youtube.required' => 'The youtube url is required.',
        ];
    }
}
