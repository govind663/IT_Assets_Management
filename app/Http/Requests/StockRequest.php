<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockRequest extends FormRequest
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
            'vendor_id' => ['required', 'integer'],
            'inward_dt' => ['required', 'date_format:Y-m-d',  'before_or_equal:today'],
            'work_order_no' => ['required',  'max:255', 'regex:/^[a-zA-Z0-9 -]+$/'],
            'voucher_no' => ['required',  'max:255', 'regex:/^[a-zA-Z0-9 -]+$/'],
        ];

        // dd($rules);
        return $rules;
    }

    public function messages()
    {
        return [
            'vendor_id.required' => __('Vendor name field cannot be empty'),
            'vendor_id.integer' => __('Invalid Vendor name selection'),
            'inward_dt.required' => __('Inward date field cannot be empty '),
            'inward_dt.date_format' => __('Please provide a valid in ward date format (YYYY-MM-DD)'),
            'inward_dt.before_or_equal' => __("Inward Date  can not be greater than today's date"),
            'work_order_no.required' => __('Work Order No. field cannot be empty'),
            'work_order_no.regex' => __('Only alphanumeric and dash  characters are allowed in Work Order No. field'),
            'voucher_no.required' => __('Voucher No. field cannot be empty'),
            'voucher_no.regex' => __('Only alphanumeric and dash  characters are allowed in Voucher No. field'),

        ];
    }
}
