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
            'name' => ['required', 'string'],
            'profile_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif'],
            'background_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif'],
            'old_profile_image' => ['nullable', 'string'],
            'old_background_image' => ['nullable', 'string'],
            'mobile_number' => ['nullable'],
            'date_of_birth' => ['nullable', 'date'],
            'gender' => ['nullable', 'in:male,female'],
            'connect_url' => ['nullable', 'url'],
            'connect_fb' => ['nullable', 'url'],
            'connect_twitter' => ['nullable', 'url'],
            'connect_linkedin' => ['nullable', 'url'],
            'address' => ['nullable', 'string'],
            'location' => ['nullable', 'string'],
            'about_me' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'connect_url.nullable' => 'The website url field is nullable',
            'connect_url.url' => 'The website url field must be a valid URL.',
            'connect_fb.nullable' => 'The facebook url field is nullable',
            'connect_fb.url' => 'The facebook url field must be a valid URL.',
            'connect_twitter.nullable' => 'The twitter url field is nullable',
            'connect_twitter.url' => 'The twitter url field must be a valid URL.',
            'connect_linkedin.nullable' => 'The linkedin url field is nullable',
            'connect_linkedin.url' => 'The linkedin url field must be a valid URL.',
        ];
    }
}
