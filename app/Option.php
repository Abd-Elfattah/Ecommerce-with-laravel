<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = [
    	'subcategory_id',
    	'name'
    ];

    public function subcategory(){
    	return $this->belongsTo('App\Subcategory');
    }

    public function values(){
    	return $this->hasMany('App\Value');
    }

    public function setNameAttribute($option){
    	$this->attributes['name'] = ucwords($option); 
    }

}
