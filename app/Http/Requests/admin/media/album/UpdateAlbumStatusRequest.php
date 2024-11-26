<?php

namespace App\Http\Requests\admin\media\album;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAlbumStatusRequest extends FormRequest
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
            'lid' => ['required', 'exists:albums,id'],
            'lstatus' => ['required', 'in:0,1'],
        ];
    }
}
