<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\Core\Patient\PatientService;
use App\Services\Core\RequestHistory\RequestHistoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Throwable;

class DashboardController extends Controller
{
    private RequestHistoryService $requestHistoryService;
    private PatientService $patientService;

    public function __construct(
        RequestHistoryService $requestHistoryService,
        PatientService $patientService
    ) {
        $this->requestHistoryService = $requestHistoryService;
        $this->patientService = $patientService;
    }

    public function __invoke(Request $request)
    {
        try {
            $visitors = $this->requestHistoryService->getVisitors();
            $submits = $this->requestHistoryService->getSubmits();
            $conversion = $this->requestHistoryService->getConversion();
            $males = $this->patientService->getMalesCount();
            $females = $this->patientService->getFemalesCount();
            $desktop = $this->requestHistoryService->countDektopRequests();
            $tablet = $this->requestHistoryService->countTabletRequests();
            $mobile = $this->requestHistoryService->countMobileRequests();
            $visitorsByCountry = $this->requestHistoryService->getVisitorsByCountry();
            $recentApplications = $this->patientService->getRecentApplications(6);
            $topTenCountriesWithVisits = array_slice($this->requestHistoryService->getTopTenCountriesWithVisits(), 0,
                7);
            $topUrls = $this->requestHistoryService->getTopUrlsFromUrl($request->get('from_url') ?: route('pages.home'));

            return view('admin.dashboard')
                ->with('topUrls', $topUrls)
                ->with('visitorsByCountry', json_encode($visitorsByCountry))
                ->with('recentApplications', $recentApplications)
                ->with('topTenCountriesWithVisits', $topTenCountriesWithVisits)
                ->with('desktop', $desktop)
                ->with('mobile', $mobile)
                ->with('tablet', $tablet)
                ->with('males', $males)
                ->with('females', $females)
                ->with('conversion', $conversion)
                ->with('submits', $submits)
                ->with('visitors', $visitors);
        } catch (Throwable $e) {
            Log::error('failed to show dashboard page', [
                'error_message' => $e->getMessage(),
            ]);

            return redirect('/')
                ->with('error', 'Error occurred, please retry later!');
        }
    }
}
