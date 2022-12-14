<?php

namespace App\Repositories\NotificationPatient;

use App\Repositories\AbstractEloquentRepository;
use App\Models\NotificationPatient;

class NotificationPatientRepository extends AbstractEloquentRepository
{
    public function findById(string $id): ?NotificationPatient
    {
    }

    public function create(array $attributes): NotificationPatient
    {
        return $this->getQueryBuilder()
            ->create($attributes);
    }

    protected function getModelClass(): string
    {
        return NotificationPatient::class;
    }
}
