<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class ShowLoginPageController extends Controller
{
    public function __invoke()
    {
        try {
            return view('admin.auth.login');
        } catch (Throwable $e) {
            Log::error('failed to show login page', [
                'error_message' => $e->getMessage(),
            ]);

            return redirect('/')
                ->with('error', 'Error occurred, please retry later!');
        }
    }
}
