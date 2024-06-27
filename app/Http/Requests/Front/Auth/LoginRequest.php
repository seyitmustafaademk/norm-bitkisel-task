<?php

namespace App\Http\Requests\Front\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:75'],
            'password' => ['required', 'string'],
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
            'email.required' => 'E-posta alanı boş bırakılamaz.',
            'email.string' => 'E-posta alanı metin tipinde olmalıdır.',
            'email.email' => 'E-posta alanı geçerli bir e-posta adresi olmalıdır.',
            'email.max' => 'E-posta alanı en fazla 75 karakter olabilir.',

            'password.required' => 'Şifre alanı boş bırakılamaz.',
            'password.string' => 'Şifre alanı metin tipinde olmalıdır.',
        ];
    }
}
