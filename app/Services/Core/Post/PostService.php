<?php

namespace App\Services\Core\Post;

use App\Models\Post;
use App\Repositories\Country\CountryRepository;
use App\Repositories\Post\PostRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class PostService
{
    private PostRepository $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository    = $postRepository;
    }

    public function findById(string $id): ?Post
    {
        $post = $this->postRepository->findById($id);
        if ( ! $post instanceof Post) {
            return null;
        }

        return $this->hydrate($post);
    }

    public function create(array $attributes): Post
    {
        return $this->postRepository->create($attributes);
    }

    public function getAll()
    {
        return $this->postRepository->getAll();
    }

    public function destroy(Post $post): bool
    {
        return $this->postRepository->destroy($post->getId());
    }

    public function update(Post $post, array $attributes): bool
    {
        return $this->postRepository->update($post->getId(), $attributes);
    }

    /**
     * @param  int  $countryId
     *
     * @return Post[]|Collection
     */
    public function getAllByCountry(int $countryId): Collection
    {
        $posts = $this->postRepository->getAllByCountry($countryId);

        return $posts->transform(function (Post $post) {
            return $this->hydrate($post);
        });
    }

    private function hydrate(Post $post): Post
    {
        return $post;
    }
}
