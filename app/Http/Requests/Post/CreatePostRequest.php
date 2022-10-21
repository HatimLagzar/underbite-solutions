<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreatePostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title'       => ['required', 'string', 'min:1', 'max:255'],
            'author_name' => ['required', 'string', 'min:1', 'max:255'],
            'description' => ['required', 'string'],
            'thumbnail'   => ['required', 'image', 'max:10000'],
            'lang'        => ['required', Rule::in(['en', 'fr', 'ar'])],
        ];
    }
}
