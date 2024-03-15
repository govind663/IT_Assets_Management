<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RolesRequest extends FormRequest
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
                'role_name' => 'required|max:255',
            ];
        }else{
            $rule = [
                'role_name' => 'required|max:255|unique:roles,role_name,deleted_at,NULL',
            ];
        }
        // dd($rule);
        return $rule;
    }

    public function messages()
    {
        return [
            'role_name.required' => __('Role Name is required'),
            'role_name.max'      => __('Max length of Role Name must be :size characters'),
            'role_name.unique'   => __('The same role name already exists'),
        ];
    }
}
