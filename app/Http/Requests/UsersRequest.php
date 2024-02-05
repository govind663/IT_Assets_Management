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
        if ($this->id){
            $rule = [
                'f_name' => 'string|min:4|max:255',
                'm_name' => 'string|min:4|max:255',
                'l_name' => 'string|min:4|max:255',
                'role_id' =>  'integer',
                'department_id' =>  'integer',
                'phone_number' => 'string',
                'email' => ' string|email:filter' . $this->id,
            ];
        }else{
            $rule = [
                'f_name' => 'required|string|min:4|max:255',
                'm_name' => 'required|string|min:4|max:255',
                'l_name' => 'required|string|min:4|max:255',
                'role_id' =>  'required|integer',
                'department_id' =>  'required|integer',
                'email' => 'required|string|email',
                'phone_number' =>  'required',
                'password' => 'required|string|min:8|confirmed',
                'password_confirmation' => 'required',
            ];
        }

        return $rule;
    }

    public function messages()
    {
        return [
            'f_name.required' => __('First Name is required'),
            'f_name.string' => __('Invalid name format'),
            'f_name.min' => __('The length of name must be at least 4 characters'),
            'f_name.max' => __('The length of name can not exceed 255 characters'),

            'm_name.required' => __('Middle Name is required'),
            'm_name.string' => __('Invalid name format'),
            'm_name.min' => __('The length of name must be at least 4 characters'),
            'm_name.max' => __('The length of name can not exceed 255 characters'),

            'l_name.required' => __('Last Name is required'),
            'l_name.string' => __('Invalid name format'),
            'l_name.min' => __('The length of name must be at least 4 characters'),
            'l_name.max' => __('The length of name can not exceed 255 characters'),

            'role_id.required' => __('Please select a Degination'),
            'role_id.integer' => __('Role id should be an integer'),

            'department_id.required' => __('Please select a Department'),
            'department_id.integer' => __('Department should be an integer') ,

            'email.required' => __('Email Id is required'),
            'email.unique' => __('This email has already been registered'),
            'email.email' => __('Please enter a valid Email address'),

            'phone_number.required' => __('Phone number is required'),
            'phone_number.regex' => __('Please enter a valid Phone number'),
            'phone_number.numeric' => __('Phone number should only contain numbers'),

            'password.required' => __('Password is required'),
            'password.min' => __('The password must be at least 8 digits long'),
            'password.confirmed' => __('Passwords do not match'),
            'password_confirmation.required' => __('Confirm Password is required'),
        ];
    }
}
