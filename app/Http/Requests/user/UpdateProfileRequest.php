<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
     * @return array<string => ['nullable'], \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'profile_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif'],
            'background_image' => ['nullable', 'string'],
            // 'email' => ['nullable', 'url'],
            'mobile_number' => ['nullable'],
            'connect_url' => ['nullable', 'url'],
            'connect_fb' => ['nullable', 'url'],
            'connect_twitter' => ['nullable', 'url'],
            'connect_linkedin' => ['nullable', 'url'],
            'about_me' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'location' => ['nullable', 'string'],
            'gender' => ['nullable', 'in:male,female'],
        ];
    }
}
