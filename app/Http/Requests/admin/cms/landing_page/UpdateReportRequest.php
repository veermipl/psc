<?php

namespace App\Http\Requests\admin\cms\landing_page;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateReportRequest extends FormRequest
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
            'title' => ['required'],
            'link' => ['nullable'],
            'old_file' => ['nullable', 'string'],
            'file' => ['required_if:old_file,null', 'image', 'mimes:jpg,jpeg,gif,png', 'max:2048'],
            'old_icon' => ['nullable', 'string'],
            'icon' => ['nullable', 'image', 'mimes:jpg,jpeg,gif,png', 'max:2048'],
            'old_additional_file' => ['nullable', 'string'],
            'additional_file' => ['nullable', 'file', 'mimes:pdf', 'max:2048'],
            'content' => ['required'],
            'type' => ['required'],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $type = request('type');
        $errors = $validator->errors();

        $redirect = redirect()->route('admin.cms.landing-page', ['tab' => $type])
            ->withErrors($errors)
            ->withInput();

        throw new HttpResponseException($redirect);
    }
}
