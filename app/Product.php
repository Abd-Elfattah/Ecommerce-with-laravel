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
    	'description'
    ];


     public function brand(){
        return $this->belongsTo('App\Brand');
    }


    public function colors(){
    	return $this->belongsToMany('App\Color')->withPivot('quantity')->withTimestamps();
    }

    public function values(){
        return $this->hasMany('App\Value');
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

    // All Products with No out Of stock
    public static function productsIfOutOfStock($products){
        $all = [];
        foreach( $products as $product ){
            foreach ($product->colors as $color ) {
                $color_product = $product->colors()->where('color_id',$color->id)->first()->pivot;
                if( $color_product->quantity > 0 ){
                    $all[] = $product;
                    break;
                }
            }
        }

        return $all;
    }


}
