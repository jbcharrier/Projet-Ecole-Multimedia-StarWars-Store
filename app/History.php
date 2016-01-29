<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable =['id', 'customer_id', 'token', 'total_price'];

    public function customer()
    {
        return $this->belongsto('App\Customer');
    }

    public function history_details()
    {
        return $this->hasMany('App\History_detail');
    }
}
