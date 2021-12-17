<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class UserRepository
{
    /**
     * Select all users from database and returns paginated collection
     *
     * @return LengthAwarePaginator
     */
    public function getAllPaginated(): LengthAwarePaginator
    {
        return User::query()
            ->orderByDesc('updated_at')
            ->paginate(10)
            ->withQueryString();
    }

    /**
     * Returns all users collection
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return User::query()
            ->get();
    }

    /**
     * Searches a user by specified id
     *
     * @param int $id
     * @return User|null
     */
    public function findById(int $id): ?User
    {
        return User::query()->find($id);
    }

    /**
     * Searches a user by specified email
     *
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User
    {
        return User::query()
            ->whereEmail($email)
            ->first();
    }
}
