<?php

namespace App\Http\Controllers;
use App\Product;
use App\Color;
use App\Cart;
use App\Payment;
use App\Order;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class CartController extends Controller
{


	public function show(){
    	
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        if($cart->totQty > 0){
            foreach ($cart->items as $product) {
                $product_id = $product['product_id'];
                $color_id = $product['color_id'];
                $color_product  = Product::find($product_id)->colors()->where('color_id' , $color_id)->withPivot('id')->first()->pivot;
                $product = Product::findOrFail($product_id);
                if( $product->offer_price == 0 ){
                    $price = $product->price;
                    $discount = 0;
                }else{
                    $price = $product->offer_price;
                    $discount = $price-$product->offer_price;
                }

                // Validation if out of stock, or reqiured quantity less than what exist already
                if($color_product->quantity == 0 && $product['quantity'] > 0){
                    $cart->remove($product_id,$color_id);
                    Session::flash('cartFailed' , '('.Product::find($product_id)->name . " - " . Color::find($color_id)->name .' Color), is out of stock now .');

                }elseif($product['quantity'] > $color_product->quantity){
                    $cart->addCount($product_id ,$color_id,1);
                    Session::flash('cartFailed' , 'Only ' . $color_product->quantity . ' Items Remind of (' . Product::find($product_id)->name . " - " . Color::find($color_id)->name .' Color) .');

                }

                // if( $product['price'] != $price){
                //     Session::flash('cartFailed' , 'Price has Changed From ' . $product['price'] . '(EGP) To ' . $price .'EGP');
                //     $quantity = $product['quantity'];
                //     $cart->remove($product_id,$color_id);
                //     $cart->add($product_id,$color_id);
                //     $cart->addCount($product_id ,$color_id,$quantity);
                // }
                

                
                
            }
        }
        Session::put('cart',$cart);
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

    public function outOfCart($color_product){
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $cart->addOutOfCart($product_id, $color_id);
        Session::put('cart',$cart);
        return redirect()->back();
    }


    // CheckOut and make Payments
    public function checkOut(){
        $cart = Session::get('cart');
        foreach($cart->items as $item){
            $product_id = $item['product_id'];
            $color_id = $item['color_id'];
            $color_product = Product::findOrFail($product_id)->colors()->where('color_id',$color_id)
                ->withPivot('id')->first()->pivot;

            if($color_product->quantity == 0 && $item['quantity'] > 0){
                $cart->remove($product_id,$color_id);
                Session::flash('cartFailed' , '('.Product::find($product_id)->name . " - " . Color::find($color_id)->name .' Color), is out of stock now .');
                return redirect()->back();
            }

            if( $item['quantity'] > $color_product->quantity){
                $cart->addCount($product_id ,$color_id,1);
                Session::flash('cartFailed' , 'Only ' . $color_product->quantity . ' Items Remind of (' . Product::find($product_id)->name . " - " . Color::find($color_id)->name .' Color) .');
                return redirect()->back();
            }
        }


        // If Validation is end and all successful
        //Create Payment
        $user    = Auth::user();
        $address = $user->addresses()->first();
        $payment = Payment::create([
            'user_id'=>$user->id, 
            'address_id'=>$address->id,
            'totall_before_discount'=>($cart->totPrice+$cart->totDisc),
            'totall_discount'=>$cart->totDisc,
            'totall_price'=>$cart->totPrice
        ]); 

        //Create Orders
        foreach($cart->items as $item){
            $product_id = $item['product_id'];
            $color_id = $item['color_id'];
            $color_product = Product::findOrFail($product_id)->colors()->where('color_id',$color_id)
                ->withPivot('id')->first()->pivot;
            $color_product->quantity-= $item['quantity'];
            Product::findOrFail($product_id)->colors()
                ->updateExistingPivot( $color_id , ['quantity' => $color_product->quantity]);

            Order::create([
                'payment_id'=>$payment->id,
                'product_id'=>$product_id,
                'color_id'=>$color_id,
                'quantity'=>$item['quantity'],
                'price_before_discount'=>($item['price']+$item['discount']),
                'discount'=>$item['discount'],
                'price'=>$item['price']
            ]);

            $cart->remove($product_id,$color_id);
            
        }

        Session::flash('cartSuccess' , 'Your Order has been sent, Check your orders .');
        return redirect()->back();
        
    }
}
