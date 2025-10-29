<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLeaderRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'address' => 'required|string|max:500',
            'otp' => 'required|string|min:4|max:6',
            'idproof'=> 'required|file|mimes:jpg,jpeg,png,pdf|max:4096',
            'password' => 'required|string|min:6'
        ];
    }

    public function messages(): array
{
    return [
        'name.required' => 'Please enter your full name.',
        'name.string' => 'Name must be a valid string.',
        'name.max' => 'Name cannot exceed 255 characters.',

        'email.required' => 'Email address is required.',
        'email.string' => 'Email must be a valid string.',
        'email.email' => 'Please enter a valid email address.',
        'email.max' => 'Email cannot exceed 255 characters.',
        'email.unique' => 'This email is already registered.',

        // 'phone.required' => 'Mobile number is required.',
        // 'phone.string' => 'Mobile number must be valid.',
        // 'phone.max' => 'Mobile number cannot exceed 15 digits.',
        // 'phone.unique' => 'This mobile number is already registered.',

        'address.required' => 'Please enter your address.',
        'address.string' => 'Address must be valid text.',
        'address.max' => 'Address cannot exceed 500 characters.',

        'otp.required' => 'OTP is required.',
        'otp.string' => 'OTP must be a valid string.',
        'otp.min' => 'OTP must be at least 4 digits.',
        'otp.max' => 'OTP cannot be more than 6 digits.',

        'idproof.required' => 'Please upload your ID proof.',
        'idproof.file' => 'ID proof must be a file.',
        'idproof.mimes' => 'ID proof must be a file of type: jpg, jpeg, png, or pdf.',
        'idproof.max' => 'ID proof cannot be larger than 4MB.',

        'password.required' => 'Password is required.',
        'password.string' => 'Password must be a valid string.',
        'password.min' => 'Password must be at least 8 characters long.',
        'password.confirmed' => 'Password confirmation does not match.',
    ];
}

}
