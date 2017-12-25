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


    // Count Products
    public static function countIfOutOfStock($products){
        $count = 0;
        foreach( $products as $product ){
            foreach ($product->colors as $color ) {
                $color_product = $product->colors()->where('color_id',$color->id)->first()->pivot;
                if( $color_product->quantity > 0 ){
                    $count++;
                    break;
                }
            }
        }

        return $count;
    }


}
