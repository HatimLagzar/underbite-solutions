<?php

namespace App\Repositories\Notification;

use App\Repositories\AbstractEloquentRepository;
use App\Models\Notification;

class NotificationRepository extends AbstractEloquentRepository
{
    public function findById(string $id): ?Notification
    {
    }

    public function create(array $attributes): Notification
    {
    }

    protected function getModelClass(): string
    {
        return Notification::class;
    }
}
