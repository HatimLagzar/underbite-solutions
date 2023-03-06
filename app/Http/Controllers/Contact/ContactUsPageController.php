<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Throwable;

class ContactUsPageController extends Controller
{
    public function __invoke()
    {
        try {
            return view('client.contact-us1');
        } catch (Throwable $e) {
            Log::error('failed to show contact us page', [
                'error_message' => $e->getMessage()
            ]);

            return redirect()
                ->to('/');
        }
    }
}
