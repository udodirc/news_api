<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class CommentsCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'news_id' => 'integer|required',
            'user_id' => 'integer|required',
            'content' => 'string|required'
        ];
    }
}
