<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class LoginRequest extends FormRequest
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
            'email' => 'required|string|email|max:255|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'password' => ['required', 'min:8', 'max:16'],
        ];

        return $rule;
    }

    public function messages()
    {
        return [
            'email.required' => __('Email Id is required'),
            'email.email' => __('Please enter a valid Email address'),
            'password.required' => __('Password is required'),
            'password.min:8'  => __('Minimum length of password should be 8 characters'),
            'password.max:25' => __('Maximum length of password should be 16 characters'),
        ];
    }
}
