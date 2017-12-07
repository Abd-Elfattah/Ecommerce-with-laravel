<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = [ 
    	'name' , 
    	'category_id' , 
    	'attr1' ,
    	'attr2',
    	'attr3', 
    	'attr4',
    	'attr5'
    ];


    // RELATIONSHIPS

    public function category(){
    	return $this->belongsTo('App\Category');
    }


    public function brands(){
        return $this->hasMany('App\Brand');
    }





    // Mutrators Model Manipulation

    public function setNameAttribute($value){
    	$this->attributes['name'] = ucwords($value);
    }

    public function setAttr1Attribute($value){
    	if( !$value == null ){
    		$this->attributes['attr1'] = ucwords($value);
    	}
    }

    public function setAttr2Attribute($value){
    	if( !$value == null ){
    		$this->attributes['attr2'] = ucwords($value);
    	}
    }

    public function setAttr3Attribute($value){
    	if( !$value == null ){
    		$this->attributes['attr3'] = ucwords($value);
    	}
    }

    public function setAttr4Attribute($value){
    	if( !$value == null ){
    		$this->attributes['attr4'] = ucwords($value);
    	}
    }

    public function setAttr5Attribute($value){
    	if( !$value == null ){
    		$this->attributes['attr5'] = ucwords($value);
    	}
    }


}
