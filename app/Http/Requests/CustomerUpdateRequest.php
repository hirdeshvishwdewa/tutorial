<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdateRequest extends FormRequest
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
            'name'      => 'required|max:156|min:3',
            'email'     => 'required|string|email|max:255|unique:customers,id,'.$this->id,
            'password'  => 'required|confirmed|min:8|max:16',
            'phone'     => 'required|max:10|min:10',
            'gender'    => 'required|in:male,female,others',
            'class'     => 'nullable|integer|min:5|max:12',
            'school'    => 'nullable|min:3|max:256',
        ];


    }
}
