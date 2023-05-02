<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'id' => 'exists:category,id,status,' . ACTIVE,
            'name'      => 'required|unique:category,name,' . request('id'),
            'parent_id' => 'required_if:sub_category,1',
            'platform_id' => 'required',
            'category_image' => 'image'
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
            'platform_id.required' => "Platform is required",
            'parent_id.required_if' => "Parent category is required"
        ];
    }
}
