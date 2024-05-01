<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'userType' => 'required|in:user,admin',
            'password' => 'nullable|string|min:8', // Change to nullable if you don't want password to be required
            'phone' => 'nullable|string|min:10|max:15',
            'location' => 'nullable|string|max:255',
            'about_me' => 'nullable|string',
        ]; 
    }
}