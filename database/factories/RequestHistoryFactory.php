<?php

namespace Database\Factories;

use App\Models\RequestHistory;
use Illuminate\Database\Eloquent\Factories\Factory;

class RequestHistoryFactory extends Factory
{
    public function definition(): array
    {
        $ip = $this->faker->ipv4;

        return [
            RequestHistory::SESSION_ID_COLUMN   => $this->faker->uuid,
            RequestHistory::BROWSER_COLUMN      => $this->faker->userAgent,
            RequestHistory::DEVICE_COLUMN       => $this->faker->randomElement([RequestHistory::DESKTOP_DEVICE, RequestHistory::MOBILE_DEVICE, RequestHistory::TABLET_DEVICE]),
            RequestHistory::URL_COLUMN          => $this->faker->randomElement([
                route('pages.home', [], false),
                route('pages.faq', [], false),
                route('pages.contact-us', [], false),
                route('pages.blog', [], false),
                route('pages.about', [], false),
            ]),
            RequestHistory::IP_COLUMN           => $ip,
            RequestHistory::COUNTRY_CODE_COLUMN => $this->faker->randomElement(['USA', 'FRA', 'MAR', 'ITA', 'CAN', 'MAL', 'RUS', 'UKR', 'ARG']),
            RequestHistory::METHOD_COLUMN       => 'GET',
            RequestHistory::TIMESTAMP_COLUMN    => $this->faker->dateTimeBetween('-1 years', 'now')->getTimestamp(),
        ];
    }
}
