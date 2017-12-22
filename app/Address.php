<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public $fillable = [
    	'user_id',
    	'city',
    	'area',
    	'location_type',
    	'mobile'
    ];


    public function user(){
    	return $this->belongsTo('App\User');
    }
}
