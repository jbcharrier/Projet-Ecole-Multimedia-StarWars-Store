<?php

namespace App;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function customer()
    {
        return $this->hasOne('App\Customer');
    }

    public function carts()
    {
        return $this->hasMany('App\Cart');
    }

    public function command_unfs()
    {
        return $this->hasMany('App\Commmand_unf');
    }
}


