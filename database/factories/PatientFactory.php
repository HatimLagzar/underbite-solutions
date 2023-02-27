<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            Patient::FIRST_NAME_COLUMN              => $this->faker->firstName,
            Patient::LAST_NAME_COLUMN               => $this->faker->lastName,
            Patient::EMAIL_COLUMN                   => $this->faker->email,
            Patient::GENDER_COLUMN                  => $this->faker->numberBetween(Patient::MALE_GENDER,
                Patient::FEMALE_GENDER),
            Patient::HEIGHT_COLUMN                  => $this->faker->numberBetween(50, 250),
            Patient::WEIGHT_COLUMN                  => $this->faker->numberBetween(30, 300),
            Patient::COUNTRY_CODE_COLUMN            => Country::all()->random()->getCode(),
            Patient::PHONE_NUMBER_COLUMN            => $this->faker->phoneNumber,
            Patient::PHONE_CODE_COLUMN              => $this->faker->countryCode,
            Patient::AGE_COLUMN                     => $this->faker->numberBetween(5, 130),
            Patient::HEARING_ABOUT_US_SOURCE_COLUMN => $this->faker->randomElement([
                'SEARCH_ENGINE',
                'FACEBOOK',
                'INSTAGRAM',
                'YOUTUBE',
                'TIKTOK',
                'BLOG_POST',
                'CONFERENCE',
                'FRIEND',
            ]),
            Patient::PATIENT_NUMBER_COLUMN          => rand(10000000, 99999999),
        ];
    }
}
