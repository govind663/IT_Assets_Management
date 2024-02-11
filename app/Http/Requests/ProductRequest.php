<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
                'name' => 'nullable|string|max:255',
                'catagories_id' => 'nullable|exists:App\Models\Catagories,id',
                'unit_id' => 'nullable|exists:App\Models\Unit,id',
                'brand' => 'nullable|string|max:255',
                'model_no' => 'nullable|string|max:255',
                'description' => 'nullable|string|max:255',
            ];
        }else{
            $rule = [
                'name' => 'required|string|max:255',
                'catagories_id' => 'required|exists:App\Models\Catagories,id',
                'unit_id' => 'required|exists:App\Models\Unit,id',
                'brand' => 'required|string|max:255',
                'model_no' => 'required|string|max:255|unique:products',
                'description' => 'required|string|max:255',
            ];
        }
        // dd($rule);
        return $rule;
    }

    public function messages()
    {
        return [
            'name.required' => __('Product Name is required'),
            'name.max'      => __('Max length of Product Name must be 255 characters'),

            'catagories_id.required'=>__("Category is required"),
            'catagories_id.exists' => __('Invalid Category ID'),

            'unit_id.required' => __('Unit is required'),
            'unit_id.exists'   => __('Invalid Unit ID') ,

            'brand.required' => __('Brand is required'),
            'brand.max'      => __('Max length of Brand name must be 255 characters'),

            'model_no.required' => __('Mobile No is required'),
            'model_no.unique' => __('This Mobile number has already been taken'),

            'description.required' => __('Description is required'),
            'description.max'      => __('Max length of Description must be 255 characters'),
        ];
    }
}
