<?php

namespace App\Http\Requests\GeneralRecords;

use Illuminate\Foundation\Http\FormRequest;

class FormGeneralRecordsRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'value' => ['required','string'],
            'parent_general_records_ids' => ['nullable','array'],
            'parent_general_records_ids.*' => ['exists:general_records,id'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'value.required' => 'Запис є обов`язковим',
            'value.string' => 'Запис має бути текстовим',
        ];
    }
}
