<?php

namespace App\Services\User;

use App\Models\User;
use App\Services\AbstractClasses\BaseFactory;
use Illuminate\Database\Eloquent\Model;

class UserFactory extends BaseFactory
{
    /**
     * Saves a new user record to database with specified params,
     * and returns its instance
     *
     * @param array $data
     * @return Model
     */
    public function createFromRequest($data): Model
    {
        return User::query()->create($data);
    }
}
