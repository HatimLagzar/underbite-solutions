<?php

namespace App\Http\Requests\Patient;

use App\Models\Patient;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ApplyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name'          => ['required', 'string', 'max:255'],
            'last_name'           => ['required', 'string', 'max:255'],
            'email'               => ['required', 'email', 'max:255'],
            'gender'              => ['required', Rule::in([Patient::MALE_GENDER, Patient::FEMALE_GENDER])],
            'age'                 => ['required', 'integer', 'max:150'],
            'weight'              => ['required', 'integer', 'max:500'],
            'height'              => ['required', 'integer', 'max:300'],
            'phone_number'        => ['required', 'string', 'max:30'],
            'social_network_note' => ['nullable', 'string', 'max:255'],
            'country_id'          => ['required', 'string', 'size:2'],
        ];
    }
}
