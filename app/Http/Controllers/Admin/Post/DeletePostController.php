<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Services\Core\Post\PostService;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class DeletePostController extends Controller
{
    private PostService $postService;
    private Filesystem $filesystem;

    public function __construct(PostService $postService, Filesystem $filesystem)
    {
        $this->postService = $postService;
        $this->filesystem = $filesystem;
    }

    public function __invoke(Post $post): RedirectResponse
    {
        try {
            $this->filesystem->delete('public/posts_thumbnails/' . $post->getThumbnailFileName());
            $this->postService->destroy($post);

            return redirect()
                ->route('admin.posts.index')
                ->with('success', 'Post has been removed successfully.');
        } catch (Throwable $e) {
            Log::error('failed to delete post', [
                'error_message' => $e->getMessage()
            ]);

            return redirect()
                ->route('admin.home')
                ->with('error', 'Error occurred, please retry later!');
        }
    }
}
