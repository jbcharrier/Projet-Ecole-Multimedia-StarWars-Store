<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class history_detail extends Model
{
    protected $fillable =['history_id', 'product_id', 'quantity'];

    public function history()
    {
        return $this->belongsto('App\History');
    }

    public function product()
    {
        return $this->belongsto('App\Product');
    }
}
