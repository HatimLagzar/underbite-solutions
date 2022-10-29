<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Services\Core\Country\CountryService;
use Stevebauman\Location\Facades\Location;

class HomeController extends Controller
{
    public function __invoke()
    {
        $countryCode = null;
        if (Location::get(request()->ip())) {
            $countryCode = Location::get(request()->ip())->countryCode;
        }

        return view('client.home')
            ->with('countryCode', $countryCode);
    }
}
