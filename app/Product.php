<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Product extends Model
{
//    protected $dates = ['published_at'];

    protected $fillable =['id','name', 'slug', 'abstract', 'content', 'category_id', 'price', 'quantity', 'status', 'published_at'];
    protected $dates = ['published_at'];


    public function picture()
    {
        return $this->hasOne('App\Picture');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function hasTag($tagId)
    {
        foreach($this->tags as $tag)
        {
            if($tag->id==$tagId) return true;
        }
        return false;
    }

    public function carts()
    {
        return $this->hasMany('App\Cart');
    }

    public function history_details()
    {
        return $this->hasMany('App\History_detail');
    }

    public function command_unfs()
    {
        return $this->hasMany('App\Commmand_unf');
    }



    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function setPublishedAtAttribute ($value)
    {
        $this->attributes['published_at'] = (empty($value)) ? '0000-00-00 00:00:00' : Carbon::now('Europe/Paris');
    }

    public function scopeOnline($query)
    {
        return $query->where('status', '=', 'opened');
    }
}
