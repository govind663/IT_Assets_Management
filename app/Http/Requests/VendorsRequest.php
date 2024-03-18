<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorsRequest extends FormRequest
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
                'company_name' => 'required|string|max:255',
                'company_add' => 'required|string',
                'company_phone_no' => 'required|string|numeric',
                'person_name' =>  'required|string|max:100',
                'phone' => 'required|string|numeric',
                'email' => 'required|string|max:255|email:filter',
                'gst_no' => 'required|string|max:255',
                // 'description' => 'required|string|max:255',
            ];
        }else{
            $rule = [
                'company_name' => 'required|string|max:255|unique:vendors,deleted_at,NULL',
                'company_add' => 'required|string',
                'company_phone_no' => 'required|string|numeric',
                'person_name' =>  'required|string|max:100',
                'phone' => 'required|string|numeric|unique:vendors,deleted_at,NULL',
                'email' => 'required|string|max:255|email:filter|unique:vendors',
                'gst_no' => 'required|string|max:255',
                // 'description' => 'required|string|max:255',
            ];
        }
        // dd($rule);
        return $rule;
    }

    public function messages()
    {
        return [
            'company_name.required' => __('Company Name is required'),
            'company_name.unique'   => __('This Company name has already been taken'),

            'company_add.required' => __('Company Address is required'),
            'company_phone_no.required' => __('Company Mobile no is required'),

            'person_name.required' =>  __('Person Name is required'),
            'person_name.max' =>  __('Maximum 100 characters are allowed in Person Name Field'),

            'phone.required' => __('Person Contact Number is required'),
            'phone.unique'  => __('This Person Contact Number has already been taken'),

            'email.required' => __('Email Id is required'),
            'email.unique' => __('This Email address has already been taken'),
            'gst_no.required' => __('GST Number is required'),
            // 'description.required' => __('Description is required'),
        ];
    }
}
