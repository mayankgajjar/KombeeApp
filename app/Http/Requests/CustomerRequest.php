<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'contact_number' => 'required|digits:10',
            'address' => 'required',
            'state_id' => 'required|numeric',
            'city_id' => 'required|numeric'
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $errors = $validator->errors();
        $errorMessages = $errors->all();
        throw new \Illuminate\Http\Exceptions\HttpResponseException(response()->json([
            'status' => false,
            'message' => 'Validation Error',
            'errors' => $errors->messages(), // Field-wise errors
            'all_messages' => $errorMessages, // Combined error messages
        ], 422));
    }
}
