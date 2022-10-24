<?php

namespace App\Http\Controllers\Admin\Notification;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class DeleteNotificationController extends Controller
{
    public function __invoke(Notification $notification): RedirectResponse
    {
        try {
            $notification->delete();

            return redirect()
                ->back()
                ->with('success', 'Notification deleted successfully!');
        } catch (Throwable $e) {
            Log::error('failed to delete notification', [
                'error_message' => $e->getMessage(),
            ]);

            return redirect()
                ->back()
                ->with('error', 'Error occured, please retry later!');
        }
    }
}