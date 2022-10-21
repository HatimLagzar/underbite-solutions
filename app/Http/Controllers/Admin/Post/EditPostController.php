<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Log;
use Throwable;

class EditPostController extends Controller
{
    public function __invoke(Post $post)
    {
        try {
            return view('admin.posts.edit')
                ->with('post', $post);
        } catch (Throwable $e) {
            Log::error('failed to show edit post page', [
                'error_message' => $e->getMessage()
            ]);

            return redirect()
                ->route('admin.home')
                ->with('error', 'Error occurred, please retry later!');
        }
    }
}
