<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required|max:255|min:3',
            'content' => 'required|min:10',
        ];
    }

    public function messages(){
        return[
            'title.required' => 'Il campo titolo è obbligatorio',
            'title.min' => 'Il campo titolo deve con tenere almeno :min caratteri',
            'title.max' => 'Il campo titolo può avere al massimo :max caratteri',
            'content.required' => 'Il campo content è obbligatorio',
            'content.min' => 'Il campo content deve contenere almeno :min caratteri',
        ];
    }
}
