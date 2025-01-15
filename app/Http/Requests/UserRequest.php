<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        // Get the user ID from the route parameter (or wherever it's passed)
        $userId = $this->route('id'); // Assuming the route has {id}

        return [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $userId,
            'contact_number' => 'required',
            'gender' => 'required',
            'postcode' => 'required|string|max:10',
            'password' => $userId ? 'nullable|min:6' : 'required|min:6', // Password required only on create
            'state_id' => 'required',
            'city_id' => 'required',
            'role' => 'required|array|min:1',
            'hobbie' => 'required|array|min:1',
            'image' => 'nullable|array',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
