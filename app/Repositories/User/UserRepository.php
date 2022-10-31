<?php

namespace App\Repositories\User;

use App\Repositories\AbstractEloquentRepository;
use App\Models\User;

class UserRepository extends AbstractEloquentRepository
{
    public function findById(string $id): ?User
    {
    }

    public function create(array $attributes): User
    {
    }

    public function update(int $id, array $attributes): bool
    {
        return $this->getQueryBuilder()
                ->where(User::ID_COLUMN, $id)
                ->update($attributes) > 0;
    }

    protected function getModelClass(): string
    {
        return User::class;
    }
}
