<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Services\Core\Country\CountryService;
use Stevebauman\Location\Facades\Location;

class HomeController extends Controller
{
    private CountryService $countryService;

    public function __construct(CountryService $countryService)
    {
        $this->countryService = $countryService;
    }

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
