<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class NewsUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => 'integer|required',
            'title' => 'string|required',
            'link' => 'string|required',
        ];
    }
}
