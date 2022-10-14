<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Throwable;

class BlogController extends Controller
{
    public function __invoke()
    {
        try {
            return view('client.blog');
        } catch (Throwable $e) {
            Log::error('failed to show about page', [
                'error_message' => $e->getMessage()
            ]);

            return redirect()
                ->to('/');
        }
    }
}
