<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoUpdateRequest extends FormRequest
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
            'embed_url'     => 'required|active_url|min:3|unique:videos,embed_url,'.$this->id,
            'category_id'   => 'nullable|integer',
            'status'        => 'nullable|integer',
        ];
    }
}
