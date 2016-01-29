<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable =['id', 'user_id', 'address', 'number_card', 'number_products_commmanded'];

    public function user()
    {
        return $this->belongsto('App\User');
    }

    public function histories()
    {
        return $this->hasMany('App\History');
    }
}
