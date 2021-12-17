<?php

namespace App\Repositories;

use App\Models\Department;
use Illuminate\Pagination\LengthAwarePaginator;

class DepartmentRepository
{

    /**
     * Select all users and returns collection with pagination
     *
     * @return LengthAwarePaginator
     */
    public function getAllPaginatedWithUsers(): LengthAwarePaginator
    {
        return Department::query()
            ->with('users')
            ->paginate(5)
            ->withQueryString();
    }

    /**
     * Searches a department with id
     *
     * @param int $id
     * @return Department|null
     */
    public function findById(int $id): ?Department
    {
        return Department::query()->find($id);
    }
}
