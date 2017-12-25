<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
    	'payment_id',
    	'product_id',
    	'color_id',
    	'quantity',
    	'price_before_discount',
    	'discount',
        'price'
    ];


    public function payment(){
    	return $this->belongsTo('App\Payment');
    }
}
