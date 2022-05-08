<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'reply' => 'required|string|max:140',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'リプを入力してください',
            'max' => 'リプは140文字以内で入力してください',
        ];
    }
}
