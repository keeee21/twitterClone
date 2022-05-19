<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

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
