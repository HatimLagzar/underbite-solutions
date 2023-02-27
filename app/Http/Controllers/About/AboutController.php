<?php

namespace App\Http\Controllers\About;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Throwable;

class AboutController extends Controller
{
    public function __invoke()
    {
        try {
            return view('client.about');
        } catch (Throwable $e) {
            Log::error('failed to show about page', [
                'error_message' => $e->getMessage()
            ]);

            return redirect()
                ->to('/');
        }
    }
}
