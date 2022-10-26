<?php

namespace App\Services\Core\RequestHistory;

use App\Models\RequestHistory;
use App\Repositories\RequestHistory\RequestHistoryRepository;

class RequestHistoryService
{
    private RequestHistoryRepository $requestHistoryRepository;

    public function __construct(RequestHistoryRepository $requestHistoryRepository)
    {
        $this->requestHistoryRepository = $requestHistoryRepository;
    }

    public function getVisitors(): int
    {
        return $this->requestHistoryRepository->getVisitors();
    }

    public function getSubmits(): int
    {
        return $this->requestHistoryRepository->getSubmits();
    }

    public function getConversion(): float
    {
        $visits = $this->requestHistoryRepository->getVisitorsByPage(route('pages.home', [], false));
        $submits = $this->requestHistoryRepository->getSubmitsByPage(route('apply', [], false));

        return round(($submits * 100) / $visits, 2);
    }

    public function create(array $attributes): RequestHistory
    {
        return $this->requestHistoryRepository->create($attributes);
    }

    public function getVisitorsByCountry(): array
    {
        $allVisitors = $this->getVisitors();
        $tenth = $allVisitors / 10;

        return $this->requestHistoryRepository->getVisitorsByCountry()
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

    public function getTopTenCountriesWithVisits(): array
    {
        return $this->requestHistoryRepository->getVisitorsByCountry()
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
}
