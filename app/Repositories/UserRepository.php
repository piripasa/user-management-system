<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends Repository
{
    /**
     * @return mixed|string
     */
    public function model()
    {
        return User::class;
    }
}