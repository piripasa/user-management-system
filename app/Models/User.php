<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "name",
        "email",
        "password"
    ];

    protected $hidden = [
        'remember_token',
    ];

    public function setPasswordAttribute($password)
    {
        if (app('hash')->needsRehash($password)) {
            $password = app('hash')->make($password);
        }

        $this->attributes['password'] = $password;
    }

}
