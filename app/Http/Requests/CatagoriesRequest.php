<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CatagoriesRequest extends FormRequest
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
                'catagories_name' => 'required|max:255',
            ];
        }else{
            $rule = [
                'catagories_name' => 'required|max:255|unique:catagories,deleted_at,NULL',
            ];
        }
        // dd($rule);
        return $rule;
    }

    public function messages()
    {
        return [
            'catagories_name.required' => __('Category Name is required'),
            'catagories_name.max' => __('The length of Category name should not exceed 255 characters'),
            'catagories_name.unique' => __("This category already exists"),
        ];
    }
}
