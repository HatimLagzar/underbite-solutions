<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Services\Core\Post\PostService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Throwable;

class ShowBlogPostController extends Controller
{
    private PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function __invoke(string $locale, int $id)
    {
        try {
            $post = $this->postService->findById($id);
            if (!$post instanceof Post) {
                return redirect()
                    ->route('pages.blog')
                    ->with('error', 'Post not found!');
            }

            return view('client.post')
                ->with('post', $post);
        } catch (Throwable $e) {
            Log::error('failed to show post page', [
                'error_message' => $e->getMessage()
            ]);

            return redirect()
                ->to('/')
                ->with('error', 'Error occurred, please retry later!');
        }
    }
}
