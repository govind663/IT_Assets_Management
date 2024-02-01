<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Password;

class UsersRequest extends FormRequest
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
            'role_id' =>  'requied|integer|exists:roles,id',
            'department_id' =>  'requied|exists:departments,id',
            'email' => 'required|string|email|unique:users,email',
            'phone_number' =>  ['required', 'numeric', 'regex:/^1[3-9]\d{9}$/'],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->letters()->numbers(),
            ],
            'password_confirmation' => 'required',
        ];

        return $rule;
    }

    public function messages()
    {
        return [
            'name.required' => __('Username field is required'),
            'name.string' => __('Invalid name format'),
            'name.min' => __('The length of name must be at least 4 characters'),
            'name.max' => __('The length of name can not exceed 255 characters'),

            'role_id.required' => __('Please select a role for the employee'),
            'role_id.integer' => __('Role id should be an integer'),
            'role_id.exists' => __('Role does not exist'),

            'department_id.required' => __('Department field is required'),
            'department_id.exists' => __('Department does not exist') ,
            'department_id.exists' => __('Department does not exist'),

            'email.required' => __('Email Id is required'),
            'email.unique' => __('This email has already been registered'),
            'email.email' => __('Please enter a valid Email address'),

            'phone_number.required' => __('Phone number field is required'),
            'phone_number.regex' => __('Incorrect phone number format'),

            'password.required' => __('Password is required'),
            'password.min' => __('The password must be at least 8 digits long'),
            'password.letters' =>  __('The password must contain at least one letter'),
            'password.numeric' =>  __('The password must contain at least one number'),

            'password.confirmed' => __('Passwords do not match'),
            'password_confirmation.required' => __('Confirm Password is required'),
        ];
    }
}
