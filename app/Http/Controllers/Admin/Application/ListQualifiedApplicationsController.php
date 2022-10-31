<?php

namespace App\Http\Controllers\Admin\Application;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Services\Core\Patient\PatientService;
use App\Services\Domain\Patient\FilterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class ListQualifiedApplicationsController extends Controller
{
    private PatientService $patientService;
    private FilterService $filterService;

    public function __construct(PatientService $patientService, FilterService $filterService)
    {
        $this->patientService = $patientService;
        $this->filterService = $filterService;
    }

    public function __invoke()
    {
        try {
            $applications = $this->filterService->filter(
                $this->patientService->getQuery()->where(Patient::IS_QUALIFIED_COLUMN, true)
            );

            return view('admin.applications.qualified')
                ->with('applications', $applications);
        } catch (Throwable $e) {
            Log::error('failed to list qualified applications', [
                'error_message' => $e->getMessage()
            ]);

            return redirect()
                ->route('admin.home')
                ->with('error', 'Error occurred, please retry later!');
        }
    }
}
