<?php

namespace App\Repositories\RequestHistory;

use App\Repositories\AbstractEloquentRepository;
use App\Models\RequestHistory;

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
            ->where(RequestHistory::URL_COLUMN, $url)
            ->count();
    }

    public function getSubmitsByPage(string $url): int
    {
        return $this->getQueryBuilder()
            ->where(RequestHistory::METHOD_COLUMN, 'POST')
            ->where(RequestHistory::URL_COLUMN, $url)
            ->count();
    }

    protected function getModelClass(): string
    {
        return RequestHistory::class;
    }
}
