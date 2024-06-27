<?php

namespace App\Http\Requests\Front\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'firstname' => 'required|string|max:30',
            'lastname' => 'required|string|max:30',
            'birthday' => 'required|date',
            'username' => 'required|string|max:30|unique:users,username',
            'email' => 'required|email|max:75|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
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
            'firstname.required' => 'Ad alanı zorunludur.',
            'firstname.string' => 'Ad alanı metin tipinde olmalıdır.',
            'firstname.max' => 'Ad alanı en fazla 30 karakter olabilir.',
            'lastname.required' => 'Soyad alanı zorunludur.',
            'lastname.string' => 'Soyad alanı metin tipinde olmalıdır.',
            'lastname.max' => 'Soyad alanı en fazla 30 karakter olabilir.',
            'birthday.required' => 'Doğum tarihi alanı zorunludur.',
            'birthday.date' => 'Doğum tarihi alanı tarih tipinde olmalıdır.',
            'username.required' => 'Kullanıcı adı alanı zorunludur.',
            'username.string' => 'Kullanıcı adı alanı metin tipinde olmalıdır.',
            'username.max' => 'Kullanıcı adı alanı en fazla 30 karakter olabilir.',
            'username.unique' => 'Kullanıcı adı alanı benzersiz olmalıdır.',
            'email.required' => 'E-posta alanı zorunludur.',
            'email.email' => 'E-posta alanı geçerli bir e-posta adresi olmalıdır.',
            'email.max' => 'E-posta alanı en fazla 75 karakter olabilir.',
            'email.unique' => 'E-posta alanı benzersiz olmalıdır.',
            'password.required' => 'Şifre alanı zorunludur.',
            'password.string' => 'Şifre alanı metin tipinde olmalıdır.',
            'password.min' => 'Şifre alanı en az 8 karakter olabilir.',
            'password.confirmed' => 'Şifre alanı tekrarı ile eşleşmiyor.',
        ];
    }
}
