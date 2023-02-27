<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Throwable;

class GetSettingsPageController extends Controller
{
    public function __invoke()
    {
        try {
            $user = auth()->user();

            return view('admin.settings.index')
                ->with('user', $user);
        } catch (Throwable $e) {
            Log::error('failed to show settings spage', [
                'error_message' => $e->getMessage(),
            ]);

            return redirect()
                ->route('admin.home')
                ->with('error', 'Error occurred, please retry later!');
        }
    }
}