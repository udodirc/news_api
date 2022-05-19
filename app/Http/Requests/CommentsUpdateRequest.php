<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class CommentsUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'content' => 'string|required'
        ];
    }
}
