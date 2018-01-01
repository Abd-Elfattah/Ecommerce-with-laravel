<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = [ 
    	'category_id',
        'name'
    ];


    // RELATIONSHIPS

    public function category(){
    	return $this->belongsTo('App\Category');
    }


    public function options(){
        return $this->hasMany('App\Option');
    }



    public function brands(){
        return $this->hasMany('App\Brand');
    }





    public function products(){
        return $this->hasManyThrough('App\Product' , 'App\Brand');
    }



}
