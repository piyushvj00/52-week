<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'password' => 'required|string|min:8',
            'otp' => 'required|string|min:4|max:6',

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

        'otp.required' => 'OTP is required.',
        'otp.string' => 'OTP must be a valid string.',
        'otp.min' => 'OTP must be at least 4 digits.',
        'otp.max' => 'OTP cannot be more than 6 digits.',

        'password.required' => 'Password is required.',
        'password.string' => 'Password must be a valid string.',
        'password.min' => 'Password must be at least 8 characters long.',
        'password.confirmed' => 'Password confirmation does not match.',
    ];
}
}
