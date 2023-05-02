<?php

namespace App\Http\Requests\Admin\Platform;

use Illuminate\Foundation\Http\FormRequest;

class SaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'      => 'required|unique:platform,name',
            'parent_id' => 'required_if:sub_platform,1',
            'platform_image' => 'required|image',
            'ein_required' => 'required|IN:0,1',
            'business_type' => 'required|IN:1,2,3'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'parent_id.required_if' => "Parent Platform is required"
        ];
    }
}
