<?php

namespace App\Http\Controllers\Admin\Notification;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notification\UpdateRequest;
use App\Models\Notification;
use App\Services\Core\Notification\NotificationService;
use Illuminate\Support\Facades\Log;
use Throwable;

class UpdateNotificationController extends Controller
{
    private NotificationService $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function __invoke(UpdateRequest $request, Notification $notification)
    {
        try {
            $this->notificationService->update($notification, [
                Notification::NAME_COLUMN           => $request->get('name'),
                Notification::MIN_AGE_COLUMN        => $request->get('min_age'),
                Notification::MAX_AGE_COLUMN        => $request->get('max_age'),
                Notification::MIN_HEIGHT_COLUMN     => $request->get('min_height'),
                Notification::MAX_HEIGHT_COLUMN     => $request->get('max_height'),
                Notification::MIN_WEIGHT_COLUMN     => $request->get('min_weight'),
                Notification::MAX_WEIGHT_COLUMN     => $request->get('max_weight'),
                Notification::GENDER_COLUMN         => $request->get('gender'),
                Notification::COUNTRY_CODE_COLUMN   => implode(',', $request->get('country')),
                Notification::CONTINENT_CODE_COLUMN => $request->get('continent'),
            ]);

            return redirect()
                ->route('admin.notifications.index')
                ->with('success', 'Notification updated successfully.');
        } catch (Throwable $e) {
            Log::error('failed to update notification', [
                'error_message' => $e->getMessage(),
            ]);

            return redirect()
                ->back()
                ->with('error', 'Error occurred, please retry later!');
        }
    }
}