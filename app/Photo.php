<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
	protected $path = '/images/';

    protected $fillable = [
    	'product_id',
    	'color_id',
    	'path'
    ];

    public function product(){
    	return $this->belongsTo('App\Product');
    }


    public function getPathAttribute($name){
    	return $this->path . $name;
    }
}
