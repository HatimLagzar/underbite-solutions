<?php

namespace App\Http\Controllers\PrivacyPolicy;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Throwable;

class PrivacyPolicyController extends Controller
{
    public function __invoke()
    {
        try {
            return view('client.privacy-policy');
        } catch (Throwable $e) {
            Log::error('failed to show terms and privacy policy page', [
                'error_message' => $e->getMessage()
            ]);

            return redirect()
                ->to('/');
        }
    }
}
