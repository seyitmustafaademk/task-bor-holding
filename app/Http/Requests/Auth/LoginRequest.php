<?php

namespace App\Http\Requests\Auth;

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
            'email' => ['required', 'email', 'max:75'],
            'password' => ['required', 'string', 'min:8', 'max:50'],
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
            'email.required' => 'E-posta alanı boş bırakılamaz',
            'email.email' => 'E-posta alanı geçerli bir e-posta adresi olmalıdır',
            'email.max' => 'E-posta alanı en fazla 75 karakter olabilir',
            'password.required' => 'Şifre alanı boş bırakılamaz',
            'password.string' => 'Şifre alanı metin tipinde olmalıdır',
            'password.min' => 'Şifre alanı en az 8 karakter olmalıdır',
            'password.max' => 'Şifre alanı en fazla 50 karakter olabilir',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'email' => 'E-posta',
            'password' => 'Şifre',
        ];
    }

    /**
     * Get the response that handle the request errors.
     *
     * @param array<mixed> $errors
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function response(array $errors)
    {
        if ($this->expectsJson()) {
            return response()->json([
                'status' => 'error',
                'message' => 'The given data was invalid',
                'errors' => $errors,
            ], 422);
        }

        return redirect()->back()
            ->withInput($this->input('email'))
            ->withErrors($errors);
    }
}
