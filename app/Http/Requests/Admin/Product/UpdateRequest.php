<?php

namespace App\Http\Requests\Admin\Product;

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
        $id = $this->route('id');

        return [
            'category_id' => 'required|integer|exists:categories,id',
            'name' => 'required|string|max:150',
            'description' => 'required|string|max:65535',
            'stock' => 'required|integer',
            'price' => 'required|decimal:0,2',
            'status' => 'required|boolean',
            'slug' => "required|string|max:150|unique:products,slug,{$id}",
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
            'category_id.required' => 'The category is required',
            'category_id.integer' => 'The category must be an integer',
            'category_id.exists' => 'The selected category is invalid',

            'name.required' => 'The name is required',
            'name.string' => 'The name must be a string',
            'name.max' => 'The name may not be greater than 150 characters',

            'description.required' => 'The description is required',
            'description.string' => 'The description must be a string',
            'description.max' => 'The description may not be greater than 65535 characters',

            'stock.required' => 'The stock is required',
            'stock.integer' => 'The stock must be an integer',

            'price.required' => 'The price is required',
            'price.decimal' => 'The price must be a decimal',
            'price.max' => 'The price may not be greater than 15 characters',

            'status.required' => 'The status is required',
            'status.boolean' => 'The status must be a boolean',

            'slug.required' => 'The slug is required',
            'slug.string' => 'The slug must be a string',
            'slug.max' => 'The slug may not be greater than 150 characters',
            'slug.unique' => 'The slug has already been taken',
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
