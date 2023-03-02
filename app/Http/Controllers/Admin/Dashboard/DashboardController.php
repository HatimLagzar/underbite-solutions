<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Services\Core\Patient\PatientService;
use App\Services\Core\RequestHistory\RequestHistoryService;
use Carbon\Carbon;
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
            $startDate = null;
            $endDate = null;
            $relativeDate = null;
            $dateFilter = $request->get('date_filter');
            if ($dateFilter === 'today') {
                $startDate = Carbon::now();
                $endDate = Carbon::now()->subtract('1 days');
                $relativeDate = Carbon::now()->subtract('2 days');
            }

            if ($dateFilter === 'week') {
                $startDate = Carbon::now();
                $endDate = Carbon::now()->subtract('1 weeks');
                $relativeDate = Carbon::now()->subtract('2 weeks');
            }

            if ($dateFilter === 'month') {
                $startDate = Carbon::now();
                $endDate = Carbon::now()->subtract('1 months');
                $relativeDate = Carbon::now()->subtract('2 months');
            }

            if ($dateFilter === 'year') {
                $startDate = Carbon::now();
                $endDate = Carbon::now()->subtract('1 years');
                $relativeDate = Carbon::now()->subtract('2 years');
            }

            $visitors = $this->requestHistoryService->countVisits($startDate, $endDate);
            $visitorsRelative = $this->requestHistoryService->countVisits($endDate, $relativeDate);
            $bounceRate = $this->requestHistoryService->getBounceRate($startDate, $endDate);
            $visitorsByCountry = $this->requestHistoryService->getVisitorsByCountry($startDate, $endDate);
            $topTenCountriesWithVisits = array_slice(
                $this->requestHistoryService->getTopTenCountriesWithVisits($startDate, $endDate),
                0,
                7
            );

            $sources = $this->patientService->getPatientsGroupedBySource($startDate, $endDate);
            $sourcesNames = $sources->map(fn ($item) => isset(Patient::SOURCES[$item->getSource()]) ? Patient::SOURCES[$item->getSource()] : 'Unknown')->toArray();
            $sourcesNumbers = $sources->map(fn ($item) => $item->counter)->toArray();

            $males = $this->patientService->getMalesCount($startDate, $endDate);
            $females = $this->patientService->getFemalesCount($startDate, $endDate);

            //$submits = $this->requestHistoryService->getSubmits($startDate, $endDate);
            $submits = $females + $males;
            $submitsFromTopCountry = $this->patientService->getTopCountryPatients($startDate, $endDate);

            $conversion = $this->requestHistoryService->getConversion($startDate, $endDate);
            $conversionRelative = $this->requestHistoryService->getConversion($endDate, $relativeDate);
            $conversionFromTopCountry = $this->requestHistoryService->getConversionOfTopCountry($startDate, $endDate);

            $desktop = $this->requestHistoryService->countDektopRequests();
            $tablet = $this->requestHistoryService->countTabletRequests();
            $mobile = $this->requestHistoryService->countMobileRequests();

            $recentApplications = $this->patientService->getRecentApplications(6);

            $topUrls = $this->requestHistoryService->getTopUrlsFromUrl($request->get('from_url') ?: route('pages.home'));
            return view('admin.dashboard.dashboard')
                ->with('topUrls', $topUrls)
                ->with('submitsFromTopCountry', $submitsFromTopCountry)
                ->with('conversionFromTopCountry', $conversionFromTopCountry)
                ->with('bounceRate', $bounceRate)
                ->with('visitorsByCountry', $visitorsByCountry)
                ->with('recentApplications', $recentApplications)
                ->with('topTenCountriesWithVisits', $topTenCountriesWithVisits)
                ->with('desktop', $desktop)
                ->with('mobile', $mobile)
                ->with('tablet', $tablet)
                ->with('males', $males)
                ->with('females', $females)
                ->with('conversion', $conversion)
                ->with('conversionRelative', $conversionRelative)
                ->with('submits', $submits)
                ->with('visitorsRelative', $visitorsRelative)
                ->with('sourcesNames', $sourcesNames)
                ->with('sourcesNumbers', $sourcesNumbers)
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
