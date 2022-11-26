<?php

namespace App\Console\Commands\Patient;

use App\Models\Patient;
use App\Services\Core\Patient\PatientService;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class AddPatientNumberToOldPatientsCommand extends Command
{
    public const CHUNK_SIZE = 50;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'repair:patient-number';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add patient number to old patient';

    private PatientService $patientService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(PatientService $patientService)
    {
        parent::__construct();

        $this->patientService = $patientService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->patientService->getQuery()
            ->chunkById(self::CHUNK_SIZE, function (Collection $patients) {
                $patients->each(function (Patient $patient) {
                    if (!$patient->getPatientNumber()) {
                        $this->patientService->update($patient, [
                            Patient::PATIENT_NUMBER_COLUMN => Str::upper(Str::random())
                        ]);
                    }
                });
            });
    }
}
