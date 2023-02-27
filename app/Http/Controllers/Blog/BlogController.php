<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Services\Core\Post\PostService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Throwable;

class BlogController extends Controller
{
    private PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function __invoke()
    {
        try {
            $posts = $this->postService->getAllByLang(App::getLocale());

            return view('client.blog')
                ->with('posts', $posts);
        } catch (Throwable $e) {
            Log::error('failed to show about page', [
                'error_message' => $e->getMessage()
            ]);

            return redirect()
                ->to('/');
        }
    }
}
