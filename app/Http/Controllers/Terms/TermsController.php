<?php

namespace App\Http\Controllers\Terms;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Throwable;

class TermsController extends Controller
{
    public function __invoke()
    {
        try {
            return view('client.terms');
        } catch (Throwable $e) {
            Log::error('failed to show terms and conditions page', [
                'error_message' => $e->getMessage()
            ]);

            return redirect()
                ->to('/');
        }
    }
}
