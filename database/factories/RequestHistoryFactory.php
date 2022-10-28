<?php

namespace Database\Factories;

use App\Models\RequestHistory;
use Illuminate\Database\Eloquent\Factories\Factory;

class RequestHistoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            RequestHistory::SESSION_ID_COLUMN => $this->faker->uuid,
            RequestHistory::BROWSER_COLUMN => $this->faker->userAgent,
            RequestHistory::DEVICE_COLUMN => $this->faker->randomElement([
                RequestHistory::DESKTOP_DEVICE,
                RequestHistory::MOBILE_DEVICE,
                RequestHistory::TABLET_DEVICE
            ]),
            RequestHistory::FROM_COLUMN => $this->faker->randomElement([
                route('pages.home'),
                route('pages.faq'),
                route('pages.contact-us'),
                route('pages.blog'),
                route('pages.about'),
            ]),
            RequestHistory::TO_COLUMN => $this->faker->randomElement([
                route('pages.home'),
                route('pages.faq'),
                route('pages.contact-us'),
                route('pages.blog'),
                route('pages.about'),
            ]),
            RequestHistory::IP_COLUMN => $this->faker->ipv4,
            RequestHistory::COUNTRY_CODE_COLUMN => $this->faker->randomElement([
                'USA',
                'FRA',
                'MAR',
                'ITA',
                'CAN',
                'MAL',
                'RUS',
                'UKR',
                'ARG'
            ]),
            RequestHistory::METHOD_COLUMN => 'GET',
            RequestHistory::TIMESTAMP_COLUMN => $this->faker->dateTimeBetween('-2 years')->getTimestamp(),
        ];
    }
}
