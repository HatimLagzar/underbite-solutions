<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\Core\Patient\PatientService;
use App\Services\Core\RequestHistory\RequestHistoryService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Throwable;

class VisitsDashboardController extends Controller
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

            $visitors = $this->requestHistoryService->getVisitors($startDate, $endDate);
            $visitorsRelative = $this->requestHistoryService->getVisitors($endDate, $relativeDate);
            $bounceRate = $this->requestHistoryService->getBounceRate($startDate, $endDate);
            $visitorsByCountry = $this->requestHistoryService->getVisitorsByCountry($startDate, $endDate);
            $visitsGroupedByCountryCode = $this->requestHistoryService->getVisitsGroupedByCountry($startDate, $endDate);
            $topTenCountriesWithVisits = array_slice(
                $this->requestHistoryService->getTopTenCountriesWithVisits($startDate, $endDate),
                0,
                7
            );

            $conversion = $this->requestHistoryService->getConversion($startDate, $endDate);
            $conversionRelative = $this->requestHistoryService->getConversion($endDate, $relativeDate);
            $conversionFromTopCountry = $this->requestHistoryService->getConversionOfTopCountry($startDate, $endDate);

            $desktop = $this->requestHistoryService->countDektopRequests();
            $tablet = $this->requestHistoryService->countTabletRequests();
            $mobile = $this->requestHistoryService->countMobileRequests();

            $topUrls = $this->requestHistoryService->getTopUrlsFromUrl($request->get('from_url') ?: route('pages.home'));

            return view('admin.dashboard.visits')
                ->with('topUrls', $topUrls)
                ->with('visitsGroupedByCountryCode', $visitsGroupedByCountryCode)
                ->with('conversionFromTopCountry', $conversionFromTopCountry)
                ->with('bounceRate', $bounceRate)
                ->with('visitorsByCountry', $visitorsByCountry)
                ->with('topTenCountriesWithVisits', $topTenCountriesWithVisits)
                ->with('desktop', $desktop)
                ->with('mobile', $mobile)
                ->with('tablet', $tablet)
                ->with('conversion', $conversion)
                ->with('conversionRelative', $conversionRelative)
                ->with('visitorsRelative', $visitorsRelative)
                ->with('visitors', $visitors);
        } catch (Throwable $e) {
            dd($e);
            Log::error('failed to show dashboard page', [
                'error_message' => $e->getMessage(),
            ]);

            return redirect('/')
                ->with('error', 'Error occurred, please retry later!');
        }
    }
}
