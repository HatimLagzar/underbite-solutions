<?php

namespace App\Http\Controllers\Admin\Application;

use App\Http\Controllers\Controller;
use App\Services\Core\Patient\PatientService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class ListApplicationsController extends Controller
{
    private PatientService $patientService;

    public function __construct(PatientService $patientService)
    {
        $this->patientService = $patientService;
    }

    public function __invoke()
    {
        try {
            $applications = $this->patientService->getAll();

            return view('admin.applications.index')
                ->with('applications', $applications);
        } catch (Throwable $e) {
            Log::error('failed to list applications', [
                'error_message' => $e->getMessage()
            ]);

            return redirect()
                ->route('admin.home')
                ->with('error', 'Error occurred, please retry later!');
        }
    }
}
