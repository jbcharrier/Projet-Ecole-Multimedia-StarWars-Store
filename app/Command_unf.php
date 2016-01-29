<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Command_unf extends Model
{

    protected $fillable =['id', 'product_id', 'user_id', 'cart_id', 'token', 'price', 'quantity', 'status'];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function cart()
    {
        return $this->belongsTo('App\Cart');
    }

}
