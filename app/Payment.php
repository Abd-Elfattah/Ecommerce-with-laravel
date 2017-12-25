<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
    	'user_id',
    	'address_id',
    	'totall_before_discount',
        'totall_discount',
    	'totall_price',
    	'is_delivered'
    ];


    public function orders(){
    	return $this->hasMany('App\Order');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
