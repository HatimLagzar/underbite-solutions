<?php

namespace App\Http\Controllers\Admin\Application;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Application\UnqualifyRequest;
use App\Models\Patient;
use App\Services\Core\Patient\PatientService;
use App\Services\Domain\Patient\QualifyPatientService;
use App\Services\Domain\Patient\UnqualifyPatientService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class UnqualifyController extends Controller
{
    private PatientService $patientService;
    private UnqualifyPatientService $unqualifyPatientService;

    public function __construct(
        PatientService $patientService,
        UnqualifyPatientService $unqualifyPatientService
    ) {
        $this->patientService = $patientService;
        $this->unqualifyPatientService = $unqualifyPatientService;
    }

    public function __invoke(UnqualifyRequest $request): RedirectResponse
    {
        try {
            foreach ($request->get('ids') as $id) {
                $patient = $this->patientService->findById($id);
                if (!$patient instanceof Patient) {
                    return redirect()
                        ->back()
                        ->with('error', 'Patient not found!');
                }

                $this->unqualifyPatientService->unqualify($patient);
            }

            return redirect()
                ->back();
        } catch (Throwable $e) {
            Log::error('failed to unqualify', [
                'error_message' => $e->getMessage(),
            ]);

            return redirect()
                ->back()
                ->with('error', 'Error occured, please retry later!');
        }
    }
}
