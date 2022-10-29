<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Stevebauman\Location\Facades\Location;
use Throwable;

class HomeController extends Controller
{
    public function __invoke()
    {
        try {
            $countryCode = null;
            if (Location::get(request()->ip())) {
                $countryCode = Location::get(request()->ip())->countryCode;
            }

            return view('client.home')
                ->with('countryCode', $countryCode);

        } catch (Throwable $e) {
            Log::error('failed to show home page', [
                'error_message' => $e->getMessage(),
            ]);

            abort(500);
        }
    }
}
