<?php

namespace App\Services\Core\RequestHistory;

use App\Models\RequestHistory;
use App\Repositories\RequestHistory\RequestHistoryRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class RequestHistoryService
{
    private RequestHistoryRepository $requestHistoryRepository;

    public function __construct(RequestHistoryRepository $requestHistoryRepository)
    {
        $this->requestHistoryRepository = $requestHistoryRepository;
    }

    public function getVisitors(?Carbon $startDate, ?Carbon $endDate): int
    {
        return $this->requestHistoryRepository->getVisitors($startDate, $endDate);
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
        $allVisitors = $this->getVisitors(null, null);
        $tenth = $allVisitors / 10;

        return $this->requestHistoryRepository->getVisitorsByCountry($startDate, $endDate)
            ->transform(
                function ($item) use ($allVisitors, $tenth) {
                    $fillKey = 'LOW';
                    if ($item->count() > ($allVisitors / 2) - $tenth) {
                        $fillKey = 'MEDIUM';
                    }

                    if ($item->count() > ($allVisitors / 2) + $tenth) {
                        $fillKey = 'HIGH';
                    }

                    return [
                        'numberOfThings' => $item->count(),
                        'fillKey'        => $fillKey
                    ];
                }
            )
            ->toArray();
    }

    public function getTopTenCountriesWithVisits(?Carbon $startDate, ?Carbon $endDate): array
    {
        return $this->requestHistoryRepository->getVisitorsByCountry($startDate, $endDate)
            ->transform(
                function ($item) {
                    return $item->count();
                }
            )
            ->sort()
            ->reverse()
            ->toArray();
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
}
