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
            'first_name'              => ['required', 'string', 'max:255'],
            'last_name'               => ['required', 'string', 'max:255'],
            'email'                   => ['required', 'email', 'max:255'],
            'gender'                  => ['required', Rule::in([Patient::MALE_GENDER, Patient::FEMALE_GENDER])],
            'age'                     => ['required', 'integer', 'max:150'],
            'weight'                  => ['required', 'integer', 'max:500'],
            'height'                  => ['required', 'integer', 'max:300'],
            'phone_number'            => ['required', 'regex:/^[\+\(\s.\-\/\d\)]{5,30}$/', 'max:30'],
            'hearing_about_us_source' => ['required', 'string', 'max:255'],
            'country_id'              => ['required', 'string', 'size:2'],
            'front_side'              => ['required', 'image', 'max:20000'],
            'front_closed'            => ['required', 'image', 'max:20000'],
            'right_side'              => ['required', 'image', 'max:20000'],
            'right_closed'            => ['required', 'image', 'max:20000'],
        ];
    }
}
