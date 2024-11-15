<?php

namespace App\Http\Requests\Vehicle;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreRequest extends FormRequest
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
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'plate' => 'required|string|max:15|unique:vehicles,plate',
            'color' => 'required|string|max:50',
            'year' => 'nullable|integer|digits:4|min:1900|max:' . date('Y'),
            'km' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
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
            'brand.required' => 'Brand is required',
            'brand.string' => 'Brand must be a string',
            'brand.max' => 'Brand must not be greater than :max characters',
            'model.required' => 'Model is required',
            'model.string' => 'Model must be a string',
            'model.max' => 'Model must not be greater than :max characters',
            'plate.required' => 'Plate is required',
            'plate.string' => 'Plate must be a string',
            'plate.max' => 'Plate must not be greater than :max characters',
            'plate.unique' => 'Plate already exists',
            'color.required' => 'Color is required',
            'color.string' => 'Color must be a string',
            'color.max' => 'Color must not be greater than :max characters',
            'year.integer' => 'Year must be an integer',
            'year.digits' => 'Year must be :digits digits',
            'year.min' => 'Year must not be less than :min',
            'year.max' => 'Year must not be greater than :max',
            'km.integer' => 'Km must be an integer',
            'km.min' => 'Km must not be less than :min',
            'is_active.boolean' => 'Is active must be a boolean'
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
            'brand' => 'brand',
            'model' => 'model',
            'plate' => 'plate',
            'color' => 'color',
            'year' => 'year',
            'km' => 'km',
            'is_active' => 'is active'
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

        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
