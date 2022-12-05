<?php

namespace App\Http\Controllers\Disclaimer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Throwable;

class DisclaimerController extends Controller
{
    public function __invoke()
    {
        try {
            return view('client.disclaimer');
        } catch (Throwable $e) {
            Log::error('failed to show disclaimer page', [
                'error_message' => $e->getMessage()
            ]);

            return redirect()
                ->to('/');
        }
    }
}
