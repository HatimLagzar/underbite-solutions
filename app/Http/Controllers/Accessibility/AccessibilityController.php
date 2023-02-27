<?php

namespace App\Http\Controllers\Accessibility;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Throwable;

class AccessibilityController extends Controller
{
    public function __invoke()
    {
        try {
            return view('client.accessibility');
        } catch (Throwable $e) {
            Log::error('failed to show accessibility page', [
                'error_message' => $e->getMessage()
            ]);

            return redirect()
                ->to('/');
        }
    }
}
