<?php

namespace App\Services\Domain\Post;

use App\Models\Post;
use App\Services\Core\Post\PostService;
use Illuminate\Http\UploadedFile;

class CreatePostService
{
    private PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function create(
        string $title,
        string $description,
        string $authorName,
        string $lang,
        UploadedFile $thumbnail
    ): Post {
        $thumbnailFileName = $thumbnail->hashName();
        $thumbnail->storeAs(
            'public/posts_thumbnails',
            $thumbnailFileName
        );

        return $this->postService->create([
            Post::TITLE_COLUMN               => $title,
            Post::DESCRIPTION_COLUMN         => $description,
            Post::AUTHOR_NAME_COLUMN         => $authorName,
            Post::LANG_COLUMN                => $lang,
            Post::THUMBNAIL_FILE_NAME_COLUMN => $thumbnailFileName,
        ]);
    }
}