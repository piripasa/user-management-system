<?php

namespace App\Repositories;

use App\Models\Group;

class GroupRepository extends Repository
{
    /**
     * @return mixed|string
     */
    public function model()
    {
        return Group::class;
    }
}