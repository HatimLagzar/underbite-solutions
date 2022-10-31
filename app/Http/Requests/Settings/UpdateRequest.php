<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'             => ['required', 'string', 'max:255', 'min:1'],
            'password'         => ['required', 'string', 'confirmed', 'max:100'],
            'current_password' => ['required', 'string'],
        ];
    }
}
