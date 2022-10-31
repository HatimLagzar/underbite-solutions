<?php

namespace App\Http\Requests\Admin\Application;

use Illuminate\Foundation\Http\FormRequest;

class QualifyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'ids'     => ['required'],
            'ids.*'   => ['required', 'integer'],
        ];
    }
}
