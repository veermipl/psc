<?php

namespace App\Http\Requests\admin\data\caricom_cet;

use Illuminate\Foundation\Http\FormRequest;

class DeleteCaricomCETHowItWorksRequest extends FormRequest
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
            'lid' => ['required', 'exists:caricom_cet,id'],
            'ltype' => ['required', 'in:how_it_works'],
        ];
    }
}
