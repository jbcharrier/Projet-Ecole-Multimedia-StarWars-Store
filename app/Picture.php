<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{

    protected $fillable =['product_id', 'uri', 'size', 'type', 'title'];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
