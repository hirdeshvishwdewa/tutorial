<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title'         => 'required|max:255|min:3',
            'description'   => 'nullable|min:3',
            'code'          => 'required|max:10|min:4|unique:coupons,code,'.$this->id,
            'percentage'    => 'nullable|integer|max:100|min:1',
            'status'        => 'nullable|integer',
        ];
    }
}
