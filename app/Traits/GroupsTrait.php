<?php

namespace App\Traits;

use App\Models\Group;

trait GroupsTrait
{

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_user');
    }

    public function hasGroup(... $groups)
    {
        foreach ($groups as $group) {
            if ($this->groups->contains('slug', $group)) {
                return true;
            }
        }
        return false;
    }

}