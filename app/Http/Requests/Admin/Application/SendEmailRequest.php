<?php

namespace App\Http\Requests\Admin\Application;

use Illuminate\Foundation\Http\FormRequest;

class SendEmailRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'message'  => ['required', 'string'],
            'emails'   => ['required'],
            'emails.*' => ['required', 'email'],
        ];
    }
}