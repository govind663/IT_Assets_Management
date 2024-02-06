<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnitRequest extends FormRequest
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
                'unit_name' => 'required|max:255',
            ];
        }else{
            $rule = [
                'unit_name' => 'required|max:255',
            ];
        }
        // dd($rule);
        return $rule;
    }

    public function messages()
    {
        return [
            'unit_name.required' => __('Unit Name is required'),
            'unit_name.max' => __('The length of unit name should not exceed 255 characters')
        ];
    }
}
