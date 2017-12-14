<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    	'brand_id',
    	'name',
    	'price',
    	'offer_price',
    	'description',
    	'val1',
    	'val2',
    	'val3',
    	'val4',
    	'val5'
    ];


     public function brand(){
        return $this->belongsTo('App\Brand');
    }


    public function colors(){
    	return $this->belongsToMany('App\Color')->withPivot('quantity')->withTimestamps();
    }


    public function photos(){
    	return $this->hasMany('App\Photo');
    }


   

    public function setNameAttribute($value){
        $this->attributes['name'] = ucwords($value);
    }


    // public function getOfferPriceAttribute($value){
    //     return number_format($value,2);
    // }


    // public function getPriceAttribute($value){
    //     return number_format($value,2);
    // }


}
