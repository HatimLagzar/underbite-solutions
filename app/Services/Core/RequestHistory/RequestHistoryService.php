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
        $submits = $this->requestHistoryRepository->getSubmitsByPage(route('pages.home', [], false));

        return ($submits * 100) / $visits;
    }
}
