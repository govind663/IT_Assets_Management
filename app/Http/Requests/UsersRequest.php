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
                'f_name' => 'required|string',
                'm_name' => 'required|string',
                'l_name' => 'required|string',
                'role_id' =>  'required|integer|exists:roles,id',
                'department_id' =>  'required|integer|exists:departments,id',
                'email' => "required|string|email:filter|unique:users,email,$this->id",
                'phone_number' => "required|min:10",
            ];
        }else{
            $rule = [
                'f_name' => 'required|string',
                'm_name' => 'required|string',
                'l_name' => 'required|string',
                'role_id' =>  'required|integer|exists:roles,id',
                'department_id' =>  'required|integer|exists:departments,id',
                'email' => 'required|string|email:filter|unique:users',
                'phone_number' => "required|min:10",
                'password' => 'required|string|min:8|confirmed',
                'password_confirmation' => 'required',
            ];
        }

        // dd($this->id);
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
            'phone_number.required' => __('Phone number is required'),

            'password.required' => __('Password is required'),
            'password.min' => __('The password must be at least 8 digits long'),
            'password.confirmed' => __('Passwords do not match'),

            'password_confirmation.required' => __('Confirm Password is required'),
        ];
    }
}