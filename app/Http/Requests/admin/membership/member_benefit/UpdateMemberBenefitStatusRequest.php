<?php

namespace App\Http\Requests\admin\membership\member_benefit;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMemberBenefitStatusRequest extends FormRequest
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
            'lid' => ['required', 'exists:member_benefits,id'],
            'lstatus' => ['required'],
        ];
    }
}
