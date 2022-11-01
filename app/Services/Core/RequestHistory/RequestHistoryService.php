<?php

namespace App\Services\Core\RequestHistory;

use App\Models\RequestHistory;
use App\Repositories\Country\CountryRepository;
use App\Repositories\RequestHistory\RequestHistoryRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class RequestHistoryService
{
    private RequestHistoryRepository $requestHistoryRepository;
    private CountryRepository $countryRepository;

    public function __construct(RequestHistoryRepository $requestHistoryRepository, CountryRepository $countryRepository)
    {
        $this->requestHistoryRepository = $requestHistoryRepository;
        $this->countryRepository = $countryRepository;
    }

    public function countVisits(?Carbon $startDate, ?Carbon $endDate): int
    {
        return $this->requestHistoryRepository->countVisits($startDate, $endDate);
    }

    public function getSubmits(?Carbon $startDate, ?Carbon $endDate): int
    {
        return $this->requestHistoryRepository->getSubmits($startDate, $endDate);
    }

    public function getConversion(?Carbon $startDate, ?Carbon $endDate): float
    {
        $visits = $this->requestHistoryRepository->getVisitorsByPage(route('pages.home'), $startDate, $endDate);
        $submits = $this->requestHistoryRepository->getSubmitsByPage(route('apply'), $startDate, $endDate);

        if ($visits === 0) {
            return 0;
        }

        return round(($submits * 100) / $visits, 2);
    }

    public function create(array $attributes): RequestHistory
    {
        return $this->requestHistoryRepository->create($attributes);
    }

    public function getVisitorsByCountry(?Carbon $startDate, ?Carbon $endDate): array
    {
        $associativeArray = $this->requestHistoryRepository->getVisitorsByCountry($startDate, $endDate)
            ->transform(fn ($item) =>  $item->count())
            ->toArray();

        $result = [];

        foreach (array_keys($associativeArray) as $key => $countryCode) {
            $result[] = [$countryCode, array_values($associativeArray)[$key]];
        }

        return $result;

    }

    public function getSubmitsByCountry(?Carbon $startDate, ?Carbon $endDate): array
    {
        $associativeArray = $this->requestHistoryRepository->getSubmitsByCountry($startDate, $endDate)
            ->transform(fn ($item) =>  $item->count())
            ->toArray();

        $result = [];

        foreach (array_keys($associativeArray) as $key => $countryCode) {
            $result[] = [$countryCode, array_values($associativeArray)[$key]];
        }

        return $result;
    }

    public function getTopTenCountriesWithVisits(?Carbon $startDate, ?Carbon $endDate): array
    {
        $associativeArray = $this->requestHistoryRepository->getVisitorsByCountry($startDate, $endDate)
            ->transform(fn ($item) =>  $item->count())
            ->sort()
            ->reverse()
            ->toArray();

        $result = [];

        foreach (array_keys($associativeArray) as $key => $countryCode) {
            $country = $this->countryRepository->findByISO3($countryCode);
            $result[$country ? $country->getName() : 'Unknown'] = array_values($associativeArray)[$key];
        }

        return $result;

    }

    public function getTopTenCountriesWithSubmits(?Carbon $startDate, ?Carbon $endDate): array
    {
        $associativeArray = $this->requestHistoryRepository->getSubmitsByCountry($startDate, $endDate)
            ->transform(fn ($item) =>  $item->count())
            ->sort()
            ->reverse()
            ->toArray();

        $result = [];

        foreach (array_keys($associativeArray) as $key => $countryCode) {
            $country = $this->countryRepository->findByISO3($countryCode);
            $result[$country ? $country->getName() : 'Unknown'] = array_values($associativeArray)[$key];
        }

        return $result;
    }

    public function countDektopRequests(): int
    {
        return $this->requestHistoryRepository->countDektopRequests();
    }

    public function countMobileRequests(): int
    {
        return $this->requestHistoryRepository->countMobileRequests();
    }

    public function countTabletRequests(): int
    {
        return $this->requestHistoryRepository->countTabletRequests();
    }

    public function getTopUrlsFromUrl(string $url): Collection
    {
        return $this->requestHistoryRepository->getTopUrlsFromUrl($url);
    }

    public function getBounceRate(?Carbon $startDate, ?Carbon $endDate): float
    {
        $uniqueVisitorsVisits = $this->requestHistoryRepository->getTotalUniqueVisitors($startDate, $endDate);
        $oneActionsVisitors = $uniqueVisitorsVisits->countBy(function ($item) {
            return $item->actions === 1;
        });

        if ($oneActionsVisitors->count() !== 2) {
            return 0;
        }

        $oneActionsVisitors = $oneActionsVisitors[1];

        return round($oneActionsVisitors * 100 / $uniqueVisitorsVisits->count(), 2);
    }

    public function getConversionOfTopCountry(?Carbon $startDate, ?Carbon $endDate)
    {
        $submits = $this->requestHistoryRepository->getSubmitsByPageOfTopCountry(route('apply'), $startDate, $endDate);
        if ($submits ===  null) {
            return 0;
        }

        if ($submits->counter === 0) {
            return 0;
        }

        $visits = $this->requestHistoryRepository->getVisitorsByPageByCountryCode(route('pages.home'), $startDate, $endDate, $submits->country_code);
        if ($visits ===  null) {
            return 0;
        }

        if ($visits->counter === 0) {
            return 0;
        }

        return number_format(round(($submits->counter * 100) / $visits->counter, 2), 2) . '% From ' . $submits->country_code;
    }

    public function getVisitsGroupedByCountry(?Carbon $startDate, ?Carbon $endDate)
    {
        return $this->requestHistoryRepository->getVisitsGroupedByCountry($startDate, $endDate)
            ->transform(function ($request) {
                $request->country = $this->countryRepository->findByISO3($request->country_code);

                return $request;
            });
    }

    public function getVisitsBetween(Carbon $endDate, Carbon $startDate)
    {
        return $this->requestHistoryRepository->getVisitsBetween($endDate, $startDate);
    }
}
