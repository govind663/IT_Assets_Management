<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReplaceOldMaterialRequest extends FormRequest
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
                'product_id' => 'required|exists:App\Models\Product,id',
                'serial_no_id' => 'required|string|max:255',
                'department_id' => 'required|exists:App\Models\Department,id',
                'order_dt' => 'required|date',
                'work_order_no' => 'required|string|max:255',
                'supply_dt' => 'required|date',
                'return_dt' => 'required|date',
                'reason' => 'required|string|max:255',
            ];
        }else{
            $rule = [
                'product_id' => 'required|exists:App\Models\Product,id',
                'serial_no_id' => 'required|string|max:255',
                'department_id' => 'required|exists:App\Models\Department,id',
                'order_dt' => 'required|date',
                'work_order_no' => 'required|string|max:255',
                'supply_dt' => 'required|date',
                'return_dt' => 'required|date',
                'reason' => 'required|string|max:255',
            ];
        }
        // dd($rule);
        return $rule;
    }

    public function messages()
    {
        return [
            'product_id.required' => __('Product Name is required'),
            'product_id.exists' => __("Invalid Product"),
            'serial_no_id.required' => __('Serial Number is required'),
            'serial_no_id.exists' => __("Invalid Serial Number"),
            'department_id.required ' => __('Department is required'),
            'department_id.exists' => __("Invalid Department"),
            'order_dt.required' => __('Product Order Date is required'),
            'order_dt.date' =>  __('Product Order Date must be a valid date'),
            'work_order_no.required' => __('Work Order No is required'),
            'work_order_no.string' => __('Work Order No should be string'),
            'work_order_no.max' => __('Max length of Work Order No is 255'),
            'supply_dt.required' => __('Product Supply Date is required'),
            'supply_dt.date' =>  __('Product Supply Date must be a valid date'),
            'return_dt.required' => __('Product Return Date is required'),
            'return_dt.date' =>  __('Product Return Date must be a valid date'),
            'reason.required' => __('Reason is required'),
            'reason.string' => __('Reason should be string'),
            'reason.max' => __('Max length of Reason is 255'),
        ];
    }
}
