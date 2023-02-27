<?php

namespace App\Http\Controllers\Admin\Application;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Application\QualifyRequest;
use App\Models\Patient;
use App\Services\Core\Patient\PatientService;
use App\Services\Domain\Patient\QualifyPatientService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class QualifyController extends Controller
{
    private PatientService $patientService;
    private QualifyPatientService $qualifyPatientService;

    public function __construct(
        PatientService $patientService,
        QualifyPatientService $qualifyPatientService
    ) {
        $this->patientService = $patientService;
        $this->qualifyPatientService = $qualifyPatientService;
    }

    public function __invoke(QualifyRequest $request): RedirectResponse
    {
        try {
            foreach ($request->get('ids') as $id) {
                $patient = $this->patientService->findById($id);
                if (!$patient instanceof Patient) {
                    return redirect()
                        ->back()
                        ->with('error', 'Patient not found!');
                }

                $this->qualifyPatientService->qualify($patient);
            }

            return redirect()
                ->back();
        } catch (Throwable $e) {
            Log::error('failed to qualify', [
                'error_message' => $e->getMessage(),
            ]);

            return redirect()
                ->back()
                ->with('error', 'Error occured, please retry later!');
        }
    }
}
