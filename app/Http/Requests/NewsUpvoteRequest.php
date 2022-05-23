<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class NewsUpvoteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'type' => 'integer|required',
            'id' => 'integer|required',
        ];
    }
}
