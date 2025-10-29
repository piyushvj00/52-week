<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserUpdateRequest extends FormRequest
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
            'email' => 'required|string|email|max:255',
            'phone_number' => 'required|string|max:15',
            'gender' => 'required|in:male,female,other',
            'merital_status' => 'required|in:single,married,divorced,widowed',
            'dob' => 'required|date|before:today',
            'language' => 'required|string|max:50',
            'bio' => 'required|string|min:3|max:1000',
            'wallet' => 'nullable|numeric|min:0',
        ];


    }
}
