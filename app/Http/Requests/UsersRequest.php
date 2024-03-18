<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
                'f_name' => 'required|string',
                'm_name' => 'required|string',
                'l_name' => 'required|string',
                'role_id' =>  'required',
                'department_id' =>  'required',
                'email' => "required|string",
                'phone_number' => "required|min:10",
            ];
        }else{
            $rule = [
                'f_name' => 'required|string',
                'm_name' => 'required|string',
                'l_name' => 'required|string',
                'role_id' =>  'required|integer|exists:roles,id',
                'department_id' =>  'required|integer|exists:departments,id',
                'email' => 'required|string|unique:users,deleted_at,NULL',
                'phone_number' => "required|min:10|unique:users,deleted_at,NULL",
                'password' => 'required|string|min:8|confirmed',
                'password_confirmation' => 'required',
            ];
        }

        // dd($rule);
        return $rule;
    }

    public function messages()
    {
        return [
            'f_name.required' => __('First Name is required'),
            'm_name.required' => __('Middle Name is required'),
            'l_name.required' => __('Last Name is required'),

            'role_id.required' => __('Please select a Degination'),
            'department_id.required' => __('Please select a Department'),

            'email.required' => __('Email Id is required'),
            'email.string' => __('The Email must be a  string.'),
            'email.unique' => __('This Email has already been taken. Please try another one!'),

            'phone_number.required' => __('Phone number is required'),
            'phone_number.unique' => __('This Phone number has already been taken. Please try another one!') ,

            'password.required' => __('Password is required'),
            'password.min' => __('The password must be at least 8 digits long'),
            'password.confirmed' => __('Passwords do not match'),

            'password_confirmation.required' => __('Confirm Password is required'),
        ];
    }
}
