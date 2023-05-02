<?php

namespace App\Http\Requests\Admin\Coupon\List;

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
            'name' => 'required',
            'charge_type' => 'required',
            'max_discount' => 'required',
            'amount' => 'exclude_if:charge_type,free|required',
            'per_user_limit' => 'required',
            'per_day_limit' => 'required',
            'description' => 'required',
        ];
    }

}
