<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    protected $fillable = [
    	'product_id',
    	'option_id',
    	'name'
    ];

    public function product(){
    	return $this->belongsTo('App\Product');
    }

    public function option(){
        return $this->belongsTo('App\Option');
    }
    
    public function setNameAttribute($value){
    	$this->attributes['name'] = ucwords($value); 
    }


}
