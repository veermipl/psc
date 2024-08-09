<?php

namespace App\Http\Requests\admin\member;

use Illuminate\Foundation\Http\FormRequest;

class DeleteMemberDocRequest extends FormRequest
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
            'id' => ['required', 'exists:users,id'],
            'doc_url' => ['required', 'string'],
            'doc_type' => ['required', 'string', 'in:form,supporting'],
        ];
    }
}
