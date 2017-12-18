<?php

namespace App\Http\Controllers;
use App\Product;
use App\Color;
use App\Cart;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class CartController extends Controller
{


	public function show(){
    	$cart = Session::get('cart');
		return view('front.cart' , compact('cart'));
    }


    public function addToCart($product_id,$color_id){

    	$oldCart = Session::has('cart') ? Session::get('cart') : null;
    	$cart = new Cart($oldCart);
    	$cart->add($product_id,$color_id);

    	Session::put('cart' , $cart);
    	return redirect()->back();
    }

    public function removeFromCart($product_id,$color_id){
    	$oldCart = Session::get('cart');
    	$cart = new Cart($oldCart);
    	$cart->remove($product_id ,$color_id);
    	Session::put('cart',$cart);
    	return redirect()->back();
    }


    public function changeQuantity($product_id,$color_id,$count){
    	$oldCart = Session::get('cart');
    	$cart = new Cart($oldCart);
    	$cart->addCount($product_id ,$color_id,$count);
    	Session::put('cart',$cart);
    	return redirect()->back();
    }
}
