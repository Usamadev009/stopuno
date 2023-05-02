<?php

namespace App\Http\Requests\Admin\Delivery;

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
            'id' => 'required|exists:delivery,id',
            'platform_ids' => 'required',
            'pay_by' => 'required',
            // 'base_pay' => 'required',
            // 'min_pay' => 'required',
            'distance' => 'required',
        ];
    }
}
