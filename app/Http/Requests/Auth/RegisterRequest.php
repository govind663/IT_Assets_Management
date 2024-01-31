<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
        $rule = [
            'name' => 'required|string|min:4|max:255',
            'email' => 'required|string|email|max:255|unique:users|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->mixedCase()->letters()->numbers()->symbols()->uncompromised()
            ],
            'password_confirmation' => 'required',
        ];

        return $rule;
    }

    public function messages()
    {
        return [
            'name.required' => __('Username field cannot be empty'),
            'name.string' => __('Invalid name format'),
            'name.min' => __('The length of name must be at least 4 characters'),
            'name.max' => __('The length of name can not exceed 255 characters'),

            'email.required' => __('Email Id is required'),
            'email.unique' => __('This email has already been registered'),
            'email.email' => __('Please enter a valid Email address'),

            'password.required' => __('Password is required'),
            'password.confirmed' => __('Passwords do not match'),
            'password_confirmation.required' => __('Confirm Password is required'),
        ];
    }
}
