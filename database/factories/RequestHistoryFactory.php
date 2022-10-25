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
            RequestHistory::BROWSER_COLUMN    => $this->faker->userAgent,
            RequestHistory::DEVICE_COLUMN     => $this->faker->randomElement(['Mobile', 'Desktop']),
            RequestHistory::URL_COLUMN        => $this->faker->randomElement([
                route('pages.home', [], false),
                route('pages.faq', [], false),
                route('pages.contact-us', [], false),
                route('pages.blog', [], false),
                route('pages.about', [], false),
            ]),
            RequestHistory::IP_COLUMN         => $this->faker->ipv4,
            RequestHistory::METHOD_COLUMN     => 'GET',
            RequestHistory::TIMESTAMP_COLUMN  => $this->faker->dateTimeBetween('-1 years', 'now')->getTimestamp(),
        ];
    }
}
