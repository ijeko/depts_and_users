<?php

namespace App\Services\AbstractClasses;

use Illuminate\Database\Eloquent\Model;

abstract class BaseFactory
{
    /**
     * @param array $data
     * @return Model
     */
    public abstract function createFromRequest(array $data): Model;
}
