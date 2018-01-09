<?php

namespace App;
use App\Product;
use App\Color;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class Cart 
{
    public $items = [];
    public $totPrice = 0;
    public $totDisc = 0;
    Public $totQty = 0;
    public $user_id =0;
    public $addres_id=0;

    public function __construct($oldCart){
    	if($oldCart){
    		$this->items = $oldCart->items;
    		$this->totPrice = $oldCart->totPrice;
    		$this->totQty = $oldCart->totQty;
    		$this->totDisc = $oldCart->totDisc;
    	}

        $this->user_id = Auth::user()->id;
    }

    public function address($user_id,$address_id){
        $this->user_id = $user_id;
        $this->address_id = $addres_id;
    }

    public function add($product_id,$color_id){
    	$color_product = Product::find($product_id)->colors()->where('color_id' , $color_id)->withPivot('id')->first()->pivot;
    	$product = Product::find($product_id);
    	if($product->offer_price == 0){
    		$item['price'] = $product->price;
    		$item['discount'] = 0;
    	}else{
    		$item['price'] = $product->offer_price;
    		$item['discount'] = $product->price - $product->offer_price;
    	}
    	$item['product_id'] = $product_id;
    	$item['color_id'] = $color_id;
    	$item['quantity'] = 1;
        // $item['color_product'] = $color_product;


    	// Items
        if(! array_key_exists($color_product->id, $this->items) ){
            $this->items[$color_product->id] = $item;
            $this->totPrice += $item['price'];
            $this->totDisc += $item['discount'];
            $this->totQty++;
        }
    	
    }

    public function remove($product_id ,$color_id){
    	$color_product = Product::find($product_id)->colors()->where('color_id' , $color_id)->withPivot('id')->first()->pivot;
    	$this->totPrice	-= ($this->items[$color_product->id]['price']*$this->items[$color_product->id]['quantity']);
    	$this->totDisc 	-= ($this->items[$color_product->id]['discount']*$this->items[$color_product->id]['quantity']);
    	$this->totQty--;
    	unset($this->items[$color_product->id]);

    }


    public function addCount($product_id ,$color_id,$count){
    	$color_product	= Product::find($product_id)->colors()->where('color_id' , $color_id)->withPivot('id')->first()->pivot;
        // if($this->items[$color_product->id]['quantity'] != 0){

        // }
    	$this->totPrice	-= ($this->items[$color_product->id]['price']*$this->items[$color_product->id]['quantity']);
    	$this->totDisc 	-= ($this->items[$color_product->id]['discount']*$this->items[$color_product->id]['quantity']);

    	$this->items[$color_product->id]['quantity'] = $count;
    	$this->totPrice += ($this->items[$color_product->id]['price']*$count);
    	$this->totDisc 	+= ($this->items[$color_product->id]['discount']*$count);
    }

    public function addOutOfCart($color_product)
    {
        $this->totPrice -= ($this->items[$color_product->id]['price']*$this->items[$color_product->id]['quantity']);
        $this->totDisc  -= ($this->items[$color_product->id]['discount']*$this->items[$color_product->id]['quantity']);

        $this->items[$color_product->id]['quantity'] = 0;
    }




}
