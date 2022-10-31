<?php

namespace App\Repositories\Post;

use App\Models\Post;
use App\Repositories\AbstractEloquentRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PostRepository extends AbstractEloquentRepository
{
    public function findById(string $id): ?Post
    {
        return $this->getQueryBuilder()
                    ->where(Post::ID_COLUMN, $id)
                    ->first();
    }

    public function create(array $attributes): Post
    {
        return $this->getQueryBuilder()
                    ->create($attributes);
    }

    /**
     * @return Post[]|Collection
     */
    public function getAll(): Collection
    {
        return $this->getQueryBuilder()
                    ->orderBy(Post::CREATED_AT_COLUMN, 'DESC')
                    ->get();
    }

    public function destroy(int $id): bool
    {
        return $this->getQueryBuilder()
                    ->where(Post::ID_COLUMN, $id)
                    ->delete() > 0;
    }

    public function update(int $id, array $attributes): bool
    {
        return $this->getQueryBuilder()
                    ->where(Post::ID_COLUMN, $id)
                    ->update($attributes) > 0;
    }

    /**
     * @param string $lang
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|Post[]
     */
    public function getAllByLang(string $lang): LengthAwarePaginator
    {
        return $this->getQueryBuilder()
            ->where(Post::LANG_COLUMN, $lang)
            ->orderBy(Post::CREATED_AT_COLUMN, 'DESC')
            ->paginate(3);
    }

    protected function getModelClass(): string
    {
        return Post::class;
    }
}
