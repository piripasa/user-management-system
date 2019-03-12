<?php

namespace App\Repositories\Criteria;

use App\Repositories\RepositoryInterface as Repository;

/**
 * Class Criteria
 * @package App\Repositories\Criteria
 */
abstract class Criteria
{
    /**
     * @param $model
     * @param Repository $repository
     * @return mixed
     */
    public abstract function apply($model, Repository $repository);
}