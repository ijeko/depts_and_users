<?php

namespace App\Services\Department;

use App\Models\Department;
use Illuminate\Database\Eloquent\Model;

class DepartmentFactory extends \App\Services\AbstractClasses\BaseFactory
{

    /**
     * Saves a new Department record to database with specified params,
     * and returns its instance
     *
     * @param array $data
     * @return Model
     */
    public function createFromRequest(array $data): Model
    {
        return Department::query()->create($data);
    }
}
