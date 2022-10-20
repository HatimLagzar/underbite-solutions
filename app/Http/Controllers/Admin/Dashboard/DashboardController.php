<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class DashboardController extends Controller
{
    public function __invoke()
    {
        try {
            return view('admin.dashboard');
        } catch (Throwable $e) {
            Log::error('failed to show dashboard page', [
                'error_message' => $e->getMessage(),
            ]);

            return redirect('/')
                ->with('error', 'Error occurred, please retry later!');
        }
    }
}
