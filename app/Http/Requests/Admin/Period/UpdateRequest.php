<?php

namespace App\Http\Requests\Admin\Period;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'started_at' => 'required|date:Y-m-d H:i:s',
            'ended_at' => 'required|date:Y-m-d H:i:s|after:started_at',
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
            'name.required' => 'Name is required',
            'name.string' => 'Name must be a string',
            'name.max' => 'Name must not be greater than 100 characters',

            'started_at.required' => 'Started at is required',
            'started_at.date' => 'Started at must be a date in Y-m-d H:i:s format',

            'ended_at.required' => 'Ended at is required',
            'ended_at.date' => 'Ended at must be a date in Y-m-d H:i:s format',
            'ended_at.after' => 'Ended at must be after started at',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'message' => 'The given data was invalid.',
            'errors' => $validator->errors(),
        ], 422);

        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
