<?php

namespace App\Http\Controllers\FAQ;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Throwable;

class FAQController extends Controller
{
    public function __invoke()
    {
        try {
            return view('client.faq');
        } catch (Throwable $e) {
            Log::error('failed to show faq page', [
                'error_message' => $e->getMessage()
            ]);

            return redirect()
                ->to('/');
        }
    }
}
