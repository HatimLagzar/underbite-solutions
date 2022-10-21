<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Throwable;

class CreatePostController extends Controller
{
    public function __invoke()
    {
        try {
            return view('admin.posts.create');
        } catch (Throwable $e) {
            Log::error('failed to show create post page', [
                'error_message' => $e->getMessage()
            ]);

            return redirect()
                ->route('admin.home')
                ->with('error', 'Error occurred, please retry later!');
        }
    }
}
