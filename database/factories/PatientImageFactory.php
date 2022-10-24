<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\PatientImage;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            PatientImage::PATIENT_ID_COLUMN => Patient::factory(),
            PatientImage::POSITION_COLUMN   => $this->faker->randomElement([
                PatientImage::RIGHT_VIEW,
                PatientImage::LEFT_VIEW,
                PatientImage::FRONT_VIEW
            ]),
            PatientImage::FILE_NAME_COLUMN  => $this->faker->randomElement([
                '0hJ45iMliC0Lu9zXcjJ4E6qcskrbUP2JqLjJs99d.png',
                '4MlGRoZh5BB6iyxNPcgGLNfC4jzlREMPczDapgCY.png',
                '6bBS19sKQrcCkHOanmr9bZk8PftePSkGdRHPCAaA.jpg',
                '6JzMuHLQGaAoTOLZVkBIGgoDRczEAmjsbWG6DR9n.png',
                'AcLMLgbTDhnL4mXYnlHEV3YKeTMU5HqD86eqNhjq.jpg',
            ])
        ];
    }
}
