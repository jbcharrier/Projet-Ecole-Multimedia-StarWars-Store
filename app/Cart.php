<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

    protected $fillable =['id', 'product_id', 'user_id', 'token', 'price', 'quantity', 'status'];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function command_unf()
    {
        return $this->hasOne('App\Command_unf');
    }
}
