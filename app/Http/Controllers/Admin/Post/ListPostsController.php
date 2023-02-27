<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Services\Core\Post\PostService;
use Illuminate\Support\Facades\Log;
use Throwable;

class ListPostsController extends Controller
{
    private PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function __invoke()
    {
        try {
            $posts = $this->postService->getAll();

            return view('admin.posts.index')
                ->with('posts', $posts);
        } catch (Throwable $e) {
            Log::error('failed to list posts page', [
                'error_message' => $e->getMessage()
            ]);

            return redirect()
                ->route('admin.home')
                ->with('error', 'Error occurred, please retry later!');
        }
    }
}
