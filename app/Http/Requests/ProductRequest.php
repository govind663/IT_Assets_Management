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
                'categories_id' => 'nullable|exists:App\Models\Category,id',
                'unit_id' => 'nullable| exists:App\Models\Unit,id',
                'brand' => 'nullable|string|max:255',
                'model_no' => 'nullable|string|max:255',
                'description' => 'nullable|string|max:255',
            ];
        }else{
            $rule = [
                'name' => 'required|string|max:255',
                'categories_id' => 'required|exists:App\Models\Category,id',
                'unit_id' => 'required| exists:App\Models\Unit,id',
                'brand' => 'required|string|max:255',
                'model_no' => 'required|string|max:255',
                'description' => 'required|string|max:255',
            ];
        }
        // dd($rule);
        return $rule;
    }
}
