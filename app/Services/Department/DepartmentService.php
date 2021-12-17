<?php

namespace App\Services\Department;

use App\Models\Department;
use Illuminate\Support\Collection;

class DepartmentService
{
    /**
     * Attaches only specified users to selected department
     *
     * @param Department $department
     * @param Collection $users
     */
    public function setUsersToDepartment(Department $department, Collection $users): void
    {
        $department->users()->sync($users->pluck('id'));
        $department->save();
    }
}
