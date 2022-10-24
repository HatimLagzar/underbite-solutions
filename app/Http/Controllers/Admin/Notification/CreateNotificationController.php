<?php

namespace App\Http\Controllers\Admin\Notification;

use App\Http\Controllers\Controller;
use App\Services\Core\Notification\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class CreateNotificationController extends Controller
{
    public function __invoke()
    {
        try {
            return view('admin.notifications.create');
        } catch (Throwable $e) {
            Log::error('failed to create notification', [
                'error_message' => $e->getMessage()
            ]);

            return redirect()
                ->route('admin.home')
                ->with('error', 'Error occurred, please retry later!');
        }
    }
}
