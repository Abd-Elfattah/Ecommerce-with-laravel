<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [

    	'subcategory_id',
    	'name'

    ];



    public function subcategory(){
    	return $this->belongsTo('App\Subcategory');
    }

    
    public function products(){
        return $this->hasMany('App\Product');
    }    



    public function setNameAttribute($value){
    	$this->attributes['name'] = ucwords($value);
    }

}
