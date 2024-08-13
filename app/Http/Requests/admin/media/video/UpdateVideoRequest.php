<?php

namespace App\Http\Requests\admin\media\video;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVideoRequest extends FormRequest
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
            'id' => ['nullable', 'exists:videos,id'],
            'old_video' => ['nullable', 'string'],
            'video' => ['nullable', 'file', 'mimes:mp4,avi,mov,mkv', 'max:10000'],
            'link' => ['nullable', 'string', 'url'],
            'type' => ['required', 'string'],
            'status' => ['required', 'in:0,1'],
        ];
    }

    public function messages(): array
    {
        return [
            // 'video.required_unless' => 'The video file is required when video type is internal',
            // 'link.required_unless' => 'The video link is required when video type is external',
            // 'link.url' => 'The video link must be a valid URL',
        ];
    }
}
