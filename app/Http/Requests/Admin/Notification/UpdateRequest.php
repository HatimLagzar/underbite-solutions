<?php

namespace App\Http\Requests\Admin\Notification;

use App\Models\Patient;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'         => ['required', 'string', 'min:1', 'max:255'],
            'gender'       => ['nullable', Rule::in(Patient::MALE_GENDER, Patient::FEMALE_GENDER)],
            'age'          => ['nullable', 'integer', 'min:1', 'max:150'],
            'height'       => ['nullable', 'integer', 'min:30', 'max:250'],
            'weight'       => ['nullable', 'integer', 'min:20', 'max:300'],
            'country_code' => ['nullable', 'string', 'size:2'],
        ];
    }
}
