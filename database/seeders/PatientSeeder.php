<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\PatientImage;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10 ; $i++) {
            /** @var Patient $patient */
            $patient = Patient::factory()->create();

            PatientImage::factory()->count(4)->create([
                PatientImage::PATIENT_ID_COLUMN => $patient->getId(),
            ]);
        }
    }
}
