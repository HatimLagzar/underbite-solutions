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

class SubmitsDashboardController extends Controller
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
            $submitsByCountry = $this->requestHistoryService->getSubmitsByCountry($startDate, $endDate);
            $topTenCountriesWithSubmits = array_slice($this->requestHistoryService->getTopTenCountriesWithSubmits($startDate, $endDate), 0,
                7);

            $males = $this->patientService->getMalesCount($startDate, $endDate);
            $females = $this->patientService->getFemalesCount($startDate, $endDate);

            $maleSubmitsGroupedByCountries = $this->patientService->getSubmitsGroupedByCountryAndGender(Patient::MALE_GENDER);
            $femaleSubmitsGroupedByCountries = $this->patientService->getSubmitsGroupedByCountryAndGender(Patient::FEMALE_GENDER);

            $below25 = $this->patientService->countAgeBelow(25);
            $below30 = $this->patientService->countAgeBelow(30);
            $below40 = $this->patientService->countAgeBelow(40);
            $below50 = $this->patientService->countAgeBelow(50);
            $below60 = $this->patientService->countAgeBelow(60);
            $above60 = $this->patientService->countAgeAbove(60);

            //$submits = $this->requestHistoryService->getSubmits($startDate, $endDate);
            $submits = $females + $males;
            $submitsFromTopCountry = $this->patientService->getTopCountryPatients($startDate, $endDate);

            $conversion = $this->requestHistoryService->getConversion($startDate, $endDate);
            $conversionRelative = $this->requestHistoryService->getConversion($endDate, $relativeDate);
            $conversionFromTopCountry = $this->requestHistoryService->getConversionOfTopCountry($startDate, $endDate);

            $recentApplications = $this->patientService->getRecentApplications(6);

            $topUrls = $this->requestHistoryService->getTopUrlsFromUrl($request->get('from_url') ?: route('pages.home'));

            return view('admin.dashboard.submits')
                ->with('below25', $below25)
                ->with('below30', $below30)
                ->with('below40', $below40)
                ->with('below50', $below50)
                ->with('below60', $below60)
                ->with('above60', $above60)
                ->with('topUrls', $topUrls)
                ->with('submitsFromTopCountry', $submitsFromTopCountry)
                ->with('conversionFromTopCountry', $conversionFromTopCountry)
                ->with('bounceRate', $bounceRate)
                ->with('submitsByCountry', $submitsByCountry)
                ->with('maleSubmitsGroupedByCountries', $maleSubmitsGroupedByCountries)
                ->with('femaleSubmitsGroupedByCountries', $femaleSubmitsGroupedByCountries)
                ->with('recentApplications', $recentApplications)
                ->with('topTenCountriesWithSubmits', $topTenCountriesWithSubmits)
                ->with('males', $males)
                ->with('females', $females)
                ->with('conversion', $conversion)
                ->with('conversionRelative', $conversionRelative)
                ->with('submits', $submits)
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
