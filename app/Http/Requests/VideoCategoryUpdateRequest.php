<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoCategoryUpdateRequest extends FormRequest
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
            'category_name' => 'required|max:255|min:3|unique:video_categories,category_name,'.$this->id,
            'parent_id'     => 'nullable|integer',
            'status'        => 'nullable|integer',
            'image'         => 'nullable|file|mimes:jpeg,jpg,png|dimensions:min_width=100,min_height=100',
        ];
    }
}
