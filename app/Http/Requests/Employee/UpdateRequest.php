<?php

namespace App\Http\Requests\Employee;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class UpdateEmployeeRequest extends FormRequest
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
            'firstname' => 'sometimes|string|max:30',
            'lastname' => 'sometimes|string|max:30',
            'email' => 'sometimes|string|email|max:75|unique:employees,email,' . $this->route('employee'),
            'phone' => 'nullable|string|max:20',
            'position' => 'nullable|string|max:100',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'firstname.string' => 'First name must be a string',
            'firstname.max' => 'First name must not be greater than :max characters',
            'lastname.string' => 'Last name must be a string',
            'lastname.max' => 'Last name must not be greater than :max characters',
            'email.string' => 'Email must be a string',
            'email.email' => 'Email must be a valid email address',
            'email.max' => 'Email must not be greater than :max characters',
            'email.unique' => 'Email already exists',
            'phone.string' => 'Phone must be a string',
            'phone.max' => 'Phone must not be greater than :max characters',
            'position.string' => 'Position must be a string',
            'position.max' => 'Position must not be greater than :max characters',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'firstname' => 'first name',
            'lastname' => 'last name',
            'email' => 'email',
            'phone' => 'phone',
            'position' => 'position',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @throws ValidationException
     */
    public function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'status' => 'error',
            'message' => $validator->errors()->first(),
        ], 422);

        throw new ValidationException($validator, $response);
    }
}
