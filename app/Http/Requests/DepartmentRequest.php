<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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
                'dept_name' => 'required|max:255',
                'dep_code' => 'required|max:255',

            ];
        }else{
            $rule = [
                'dept_name' => 'required|max:255|unique:departments',
                'dep_code' => 'required|max:255|unique:departments,deleted_at,NULL',
            ];
        }
        return $rule;
    }

    public function messages()
    {
        return [
            'dept_name.required' => __('Department Name is required'),
            'dept_name.max' => __('The length of department name should not exceed 255 characters'),
            'dept_name.unique' => __('This department already exists'),
            'dep_code.required' => __('Department Code is required'),
            'dep_code.max' => __('The length of department code should not exceed  255 characters'),
            'dep_code.unique' => __('This department code has been used'),
        ];
    }
}
