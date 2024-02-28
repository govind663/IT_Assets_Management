<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RemarksRequest extends FormRequest
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
        //  If we are updating a remark then we need an auth role  of at least 'admin' or higher
        $authRole = optional(request()->user())->role_id ?? '';
        // dd($authRole);
        if($authRole ==  2) {
            $rules = [
                'rejection_reason_by_hod' => ['required', 'max:255', 'string'],
                ];
        } elseif ($authRole == 3){
            $rules = [
                'rejection_reason_by_clerk' => ['required', 'max:255', 'string'],
                ];
        }
        return $rules;
    }


    public function messages()
    {
        return [
            'rejection_reason_by_hod.required' => __('Rejection reason by the HOD is required'),
            'rejection_reason_by_hod.max' => __("The HOD  reason may not be greater than :max characters."),
            'rejection_reason_by_hod.string' =>__('The HOD  reason must be a string.') ,

            'rejection_reason_by_clerk.required' => __('Rejection reason by the clerk is required'),
            'rejection_reason_by_clerk.string' =>__('The Clerk reason must be a string.'),
            'rejection_reason_by_clerk.max' => __('The Clerk reason may not exceed :max  characters.'),
        ];
    }
}
