<?php

namespace App\Http\Requests\admin\cms\landing_page;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStatusRequest extends FormRequest
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
            'lid' => ['required', 'exists:landing_page,id'],
            'lstatus' => ['required', 'in:0,1'],
            // 'ltype' => ['required', 'in:header'],
        ];
    }
}
