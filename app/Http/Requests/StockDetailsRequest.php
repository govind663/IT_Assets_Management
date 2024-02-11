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
        return [
            'stock_id'      => ['nullable', 'numeric'],
            'product_code'  => ['required', 'alpha_num'],
            'catagories_id'  => ['required', 'numeric'],
            'product_id' => ['required', 'integer'],
            'brand'   => ['required', 'string'],
            'model'   => ['required', 'string'],
            'quantity'   => ['required', 'int', 'min:1'],
            'unit_id'  => ['required', 'numeric'],
            'warranty_dt' => ['required','date',]
        ];
    }
}
