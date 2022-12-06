<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:100'],
            'hot_flag' => 'required',
            'categories_id' => 'required',
            'content' => 'required',
            'post_time' => 'required',
            'photo' => ['mimes:jpeg,jpg,png,gif', 'required', 'max:10000'],
        ];
    }
}