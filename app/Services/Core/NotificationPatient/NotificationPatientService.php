<?php

namespace App\Services\Core\NotificationPatient;

use App\Models\NotificationPatient;
use App\Repositories\NotificationPatient\NotificationPatientRepository;

class NotificationPatientService
{
    private NotificationPatientRepository $notificationPatientRepository;

    public function __construct(NotificationPatientRepository $notificationPatientRepository)
    {
        $this->notificationPatientRepository = $notificationPatientRepository;
    }

    public function findById(string $id): ?NotificationPatient
    {
    }

    public function create(array $attributes): NotificationPatient
    {
        return $this->notificationPatientRepository->create($attributes);
    }
}
