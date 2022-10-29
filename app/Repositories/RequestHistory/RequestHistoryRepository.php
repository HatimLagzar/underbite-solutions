<?php

namespace App\Repositories\RequestHistory;

use App\Repositories\AbstractEloquentRepository;
use App\Models\RequestHistory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class RequestHistoryRepository extends AbstractEloquentRepository
{
    public function getVisitors(?Carbon $startDate, ?Carbon $endDate): int
    {
        if ($startDate === null && $endDate === null) {
            return $this->getQueryBuilder()
                ->where(RequestHistory::METHOD_COLUMN, 'GET')
                ->count();
        }

        return $this->getQueryBuilder()
            ->where(RequestHistory::METHOD_COLUMN, 'GET')
            ->where(RequestHistory::TIMESTAMP_COLUMN, '<', $startDate->getTimestamp())
            ->where(RequestHistory::TIMESTAMP_COLUMN, '>', $endDate->getTimestamp())
            ->count();
    }

    public function getSubmits(?Carbon $startDate, ?Carbon $endDate): int
    {
        if ($startDate === null && $endDate === null) {
            return $this->getQueryBuilder()
                ->where(RequestHistory::METHOD_COLUMN, 'POST')
                ->count();
        }

        return $this->getQueryBuilder()
            ->where(RequestHistory::METHOD_COLUMN, 'POST')
            ->where(RequestHistory::TIMESTAMP_COLUMN, '>', $endDate->getTimestamp())
            ->count();
    }

    public function getVisitorsByPage(string $url, ?Carbon $startDate, ?Carbon $endDate): int
    {
        if ($startDate === null && $endDate === null) {
            return $this->getQueryBuilder()
                ->where(RequestHistory::METHOD_COLUMN, 'GET')
                ->where(RequestHistory::TO_COLUMN, $url)
                ->count();
        }

        return $this->getQueryBuilder()
            ->where(RequestHistory::METHOD_COLUMN, 'GET')
            ->where(RequestHistory::TO_COLUMN, $url)
            ->where(RequestHistory::TIMESTAMP_COLUMN, '>', $endDate->getTimestamp())
            ->count();
    }

    public function getSubmitsByPage(string $url, ?Carbon $startDate, ?Carbon $endDate): int
    {
        if ($startDate === null && $endDate === null) {
            return $this->getQueryBuilder()
                ->where(RequestHistory::METHOD_COLUMN, 'POST')
                ->where(RequestHistory::TO_COLUMN, $url)
                ->count();
        }

        return $this->getQueryBuilder()
            ->where(RequestHistory::METHOD_COLUMN, 'POST')
            ->where(RequestHistory::TO_COLUMN, $url)
            ->where(RequestHistory::TIMESTAMP_COLUMN, '>', $endDate->getTimestamp())
            ->count();
    }

    public function create(array $attributes): RequestHistory
    {
        return $this->getQueryBuilder()
            ->create($attributes);
    }

    public function getVisitorsByCountry(?Carbon $startDate, ?Carbon $endDate): Collection
    {
        if ($startDate === null && $endDate === null) {
            return $this->getQueryBuilder()
                ->where(RequestHistory::METHOD_COLUMN, 'GET')
                ->get()
                ->groupBy(RequestHistory::COUNTRY_CODE_COLUMN);
        }

        return $this->getQueryBuilder()
            ->where(RequestHistory::METHOD_COLUMN, 'GET')
            ->where(RequestHistory::TIMESTAMP_COLUMN, '>', $endDate->getTimestamp())
            ->get()
            ->groupBy(RequestHistory::COUNTRY_CODE_COLUMN);
    }

    public function getSubmitsByCountry(?Carbon $startDate, ?Carbon $endDate): Collection
    {
        if ($startDate === null && $endDate === null) {
            return $this->getQueryBuilder()
                ->where(RequestHistory::METHOD_COLUMN, RequestHistory::POST_METHOD)
                ->get()
                ->groupBy(RequestHistory::COUNTRY_CODE_COLUMN);
        }

        return $this->getQueryBuilder()
            ->where(RequestHistory::METHOD_COLUMN, RequestHistory::POST_METHOD)
            ->where(RequestHistory::TIMESTAMP_COLUMN, '>', $endDate->getTimestamp())
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

    /**
     * @param string $url
     * @return Collection
     */
    public function getTopUrlsFromUrl(string $url): Collection
    {
        return $this->getQueryBuilder()
            ->select([
                RequestHistory::FROM_COLUMN,
                RequestHistory::TO_COLUMN,
                DB::raw(sprintf('count(`%s`) as visits', RequestHistory::TO_COLUMN))
            ])
            ->where(RequestHistory::METHOD_COLUMN, RequestHistory::GET_METHOD)
            ->where(RequestHistory::FROM_COLUMN, $url)
            ->where(RequestHistory::TO_COLUMN, '!=', $url)
            ->groupBy(RequestHistory::TO_COLUMN)
            ->orderBy('visits', 'DESC')
            ->get();
    }

    /**
     * @param Carbon|null $startDate
     * @param Carbon|null $endDate
     * @return Collection
     */
    public function getTotalUniqueVisitors(?Carbon $startDate, ?Carbon $endDate): Collection
    {
        if ($startDate === null && $endDate === null) {
            return $this->getQueryBuilder()
                ->select([
                    RequestHistory::SESSION_ID_COLUMN,
                    DB::raw('count(`' . RequestHistory::SESSION_ID_COLUMN . '`) as actions'),
                ])
                ->groupBy(RequestHistory::SESSION_ID_COLUMN)
                ->get();
        }

        return $this->getQueryBuilder()
            ->select([
                RequestHistory::SESSION_ID_COLUMN,
                DB::raw('count(`' . RequestHistory::SESSION_ID_COLUMN . '`) as actions'),
            ])
            ->groupBy(RequestHistory::SESSION_ID_COLUMN)
            ->where(RequestHistory::TIMESTAMP_COLUMN, '>', $endDate->getTimestamp())
            ->get();
    }

    public function getSubmitsByPageOfTopCountry(string $url, ?Carbon $startDate, ?Carbon $endDate)
    {
        if ($startDate === null && $endDate === null) {
            return $this->getQueryBuilder()
                ->select([
                    RequestHistory::COUNTRY_CODE_COLUMN,
                    RequestHistory::METHOD_COLUMN,
                    DB::raw(sprintf('count(`%s`) as counter', RequestHistory::COUNTRY_CODE_COLUMN))
                ])
                ->where(RequestHistory::METHOD_COLUMN, 'POST')
                ->where(RequestHistory::TO_COLUMN, $url)
                ->groupBy(RequestHistory::COUNTRY_CODE_COLUMN)
                ->orderBy('counter', 'desc')
                ->first();
        }

        return $this->getQueryBuilder()
            ->select([
                RequestHistory::COUNTRY_CODE_COLUMN,
                RequestHistory::METHOD_COLUMN,
                DB::raw(sprintf('count(`%s`) as counter', RequestHistory::COUNTRY_CODE_COLUMN))
            ])
            ->where(RequestHistory::METHOD_COLUMN, 'POST')
            ->where(RequestHistory::TO_COLUMN, $url)
            ->where(RequestHistory::TIMESTAMP_COLUMN, '>', $endDate->getTimestamp())
            ->groupBy(RequestHistory::COUNTRY_CODE_COLUMN)
            ->orderBy('counter', 'desc')
            ->first();

    }

    public function getVisitorsByPageByCountryCode(string $url, ?Carbon $startDate, ?Carbon $endDate, string $countryCode)
    {
        if ($startDate === null && $endDate === null) {
            return $this->getQueryBuilder()
                ->select([
                    RequestHistory::COUNTRY_CODE_COLUMN,
                    RequestHistory::METHOD_COLUMN,
                    DB::raw(sprintf('count(`%s`) as counter', RequestHistory::COUNTRY_CODE_COLUMN))
                ])
                ->where(RequestHistory::METHOD_COLUMN, 'GET')
                ->where(RequestHistory::TO_COLUMN, $url)
                ->where(RequestHistory::COUNTRY_CODE_COLUMN, $countryCode)
                ->orderBy('counter', 'desc')
                ->first();
        }

        return $this->getQueryBuilder()
            ->select([
                RequestHistory::COUNTRY_CODE_COLUMN,
                RequestHistory::METHOD_COLUMN,
                DB::raw(sprintf('count(`%s`) as counter', RequestHistory::COUNTRY_CODE_COLUMN))
            ])
            ->where(RequestHistory::METHOD_COLUMN, 'GET')
            ->where(RequestHistory::TO_COLUMN, $url)
            ->where(RequestHistory::COUNTRY_CODE_COLUMN, $countryCode)
            ->where(RequestHistory::TIMESTAMP_COLUMN, '>', $endDate->getTimestamp())
            ->orderBy('counter', 'desc')
            ->first();

    }

    protected function getModelClass(): string
    {
        return RequestHistory::class;
    }
}
