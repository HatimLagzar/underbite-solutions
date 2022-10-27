<?php

namespace App\Repositories\RequestHistory;

use App\Repositories\AbstractEloquentRepository;
use App\Models\RequestHistory;
use Illuminate\Database\Eloquent\Collection;

class RequestHistoryRepository extends AbstractEloquentRepository
{
    public function getVisitors(): int
    {
        return $this->getQueryBuilder()
            ->where(RequestHistory::METHOD_COLUMN, 'GET')
            ->count();
    }

    public function getSubmits(): int
    {
        return $this->getQueryBuilder()
            ->where(RequestHistory::METHOD_COLUMN, 'POST')
            ->count();
    }

    public function getVisitorsByPage(string $url): int
    {
        return $this->getQueryBuilder()
            ->where(RequestHistory::METHOD_COLUMN, 'GET')
            ->where(RequestHistory::TO_COLUMN, $url)
            ->count();
    }

    public function getSubmitsByPage(string $url): int
    {
        return $this->getQueryBuilder()
            ->where(RequestHistory::METHOD_COLUMN, 'POST')
            ->where(RequestHistory::TO_COLUMN, $url)
            ->count();
    }

    public function create(array $attributes): RequestHistory
    {
        return $this->getQueryBuilder()
            ->create($attributes);
    }

    public function getVisitorsByCountry(): Collection
    {
        return $this->getQueryBuilder()
            ->where(RequestHistory::METHOD_COLUMN, 'GET')
            ->get()
            ->groupBy(RequestHistory::COUNTRY_CODE_COLUMN);
    }

    public function countDektopRequests(): int
    {
        return $this->getQueryBuilder()
            ->where(RequestHistory::METHOD_COLUMN, 'GET')
            ->where(RequestHistory::DEVICE_COLUMN, RequestHistory::DESKTOP_DEVICE)
            ->count();
    }

    public function countTabletRequests(): int
    {
        return $this->getQueryBuilder()
            ->where(RequestHistory::METHOD_COLUMN, 'GET')
            ->where(RequestHistory::DEVICE_COLUMN, RequestHistory::TABLET_DEVICE)
            ->count();
    }

    public function countMobileRequests(): int
    {
        return $this->getQueryBuilder()
            ->where(RequestHistory::METHOD_COLUMN, 'GET')
            ->where(RequestHistory::DEVICE_COLUMN, RequestHistory::MOBILE_DEVICE)
            ->count();
    }

    protected function getModelClass(): string
    {
        return RequestHistory::class;
    }
}
