<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockDetailsRequest extends FormRequest
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
        $rules = [
            'work_order_no'  => ['required', 'string'],
            'catagories_id'  => ['required', 'string'],
            'product_id' => ['required', 'string'],
            'brand'   => ['required', 'string'],
            'model'   => ['required', 'string'],
            'unit_id'  => ['required', 'string'],
            'warranty_dt' => ['required', 'date_format:Y-m-d'],
            'quantity'   => ['required', 'int', 'min:1'],
        ];

        // dd($rules);
        return $rules;
    }

    public function messages()
    {
        return [
            'work_order_no.required'=>"Work Order Number is required.",
            'catagories_id.required'=> "Please Select Category Name.",
            'product_id.required'=> "Please Select Product Name.",
            'brand.required'=> "Brand Name field can not be empty.",
            'model.required'=> "Model Name field can not be empty.",
            'unit_id.required'=> "Please Select Unit.",
            'warranty_dt.required'=> "Warranty Date field can  not be empty.",
            'quantity.required'=> "Quantity field can not be empty.",
            'quantity.min'=> "The Quantity field must be at least 1.",
        ];
    }
}
