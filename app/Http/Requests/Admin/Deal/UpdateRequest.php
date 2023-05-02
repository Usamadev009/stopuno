<?php

namespace App\Http\Requests\Admin\Deal;

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
            'id' => 'exists:deal,id,status,' . ACTIVE,
            'name'      => 'required|unique:deal,name,' . request('id'),
            'coupon' => 'required',
            'service' => 'required',
            'deal_image' => 'image'
        ];
    }
}
