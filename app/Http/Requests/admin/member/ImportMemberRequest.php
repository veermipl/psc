<?php

namespace App\Http\Requests\admin\member;

use Illuminate\Foundation\Http\FormRequest;

class ImportMemberRequest extends FormRequest
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
            //  'excelDoc' => 'required|file|mimes:xls,xlsx,csv|max:5120',
             'excelDoc' => 'required|file|max:5120',
        ];
    }
}
