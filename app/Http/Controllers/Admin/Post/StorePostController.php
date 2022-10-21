<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\CreatePostRequest;
use App\Services\Domain\Post\CreatePostService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class StorePostController extends Controller
{
    private CreatePostService $createPostService;

    public function __construct(CreatePostService $createPostService)
    {
        $this->createPostService = $createPostService;
    }

    public function __invoke(CreatePostRequest $request): RedirectResponse
    {
        try {
            $this->createPostService->create(
                $request->get('title'),
                $request->get('description'),
                $request->get('author_name'),
                $request->get('lang'),
                $request->file('thumbnail')
            );

            return redirect()
                ->route('admin.posts.index')
                ->with('success', 'Post has been added successfully.');
        } catch (Throwable $e) {
            Log::error('failed to create post', [
                'error_message' => $e->getMessage()
            ]);

            return redirect()
                ->back()
                ->with('error', 'Error occurred, please retry later!');
        }
    }
}
