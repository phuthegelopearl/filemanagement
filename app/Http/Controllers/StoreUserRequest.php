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
        return true; // Set to true if authorization is required
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'userType' => 'required|in:user,admin', // Adjust values as needed
            'password' => 'required|string|min:8',
            'phone' => 'nullable|string|min:10|max:15',
            'location' => 'nullable|string|max:255',
            'about_me' => 'nullable|string',
        ];
    }
}
