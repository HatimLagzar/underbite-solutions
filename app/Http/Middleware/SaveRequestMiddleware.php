<?php

namespace App\Http\Middleware;

use App\Models\RequestHistory;
use App\Services\Core\Country\CountryService;
use App\Services\Core\RequestHistory\RequestHistoryService;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Stevebauman\Location\Facades\Location;

class SaveRequestMiddleware
{
    private RequestHistoryService $requestHistoryService;
    private CountryService $countryService;

    public function __construct(RequestHistoryService $requestHistoryService, CountryService $countryService)
    {
        $this->requestHistoryService = $requestHistoryService;
        $this->countryService = $countryService;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $iso3 = 'UNKNOWN';
        if (Location::get(request()->ip())) {
            $countryCode = Location::get(request()->ip())->countryCode;
            $country = $this->countryService->findByCountryCode($countryCode);
            $iso3 = $country->getIso3();
        }

        $device = $this->getDevice(request()->userAgent());

        $this->requestHistoryService->create([
            RequestHistory::SESSION_ID_COLUMN   => session()->getId(),
            RequestHistory::BROWSER_COLUMN      => request()->userAgent(),
            RequestHistory::DEVICE_COLUMN       => $device,
            RequestHistory::IP_COLUMN           => request()->ip(),
            RequestHistory::COUNTRY_CODE_COLUMN => $iso3,
            RequestHistory::FROM_COLUMN         => url()->previous(),
            RequestHistory::TO_COLUMN           => url()->current(),
            RequestHistory::METHOD_COLUMN       => request()->method(),
            RequestHistory::TIMESTAMP_COLUMN    => Carbon::now()->timestamp,
        ]);

        return $next($request);
    }

    private function getDevice(?string $userAgent): string
    {
        if (!$userAgent) {
            return 'Desktop';
        }

        $isMob = is_numeric(strpos(strtolower($userAgent), "mobile"));
        $isTab = is_numeric(strpos(strtolower($userAgent), "tablet"));

        if ($isMob && $isTab) {
            return RequestHistory::TABLET_DEVICE;
        }

        if ($isMob) {
            return RequestHistory::MOBILE_DEVICE;
        }

        return RequestHistory::DESKTOP_DEVICE;
    }
}
