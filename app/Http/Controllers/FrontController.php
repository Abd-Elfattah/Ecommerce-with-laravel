<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;
use App\Category;
use App\Subcategory;
use App\Product;
use App\Photo;


class FrontController extends Controller
{
    public function home(){
    	$products = Product::paginate(9);

    	return view('front.home',compact('products'));
    }



    public function subProducts($sub_id){
    	
    	$sub = Subcategory::findOrFail($sub_id);
    	
    	$products = $sub->products()->paginate(9);
    	$count = $sub->products()->count();
    	return view('front.sub-category', compact('sub','products','count'));
    }

    public function offers(){
        $products = Product::where('offer_price' , '>' , 0)->paginate(9);
        return view('front.special-offers',compact('products'));
    }


    // Disply default product Color
    public function displyProduct($id){
    	$product = Product::findOrFail($id);
        $count = $product->colors()->count();
        $skip = 1;
        $limit = $count - $skip; // the limit
        $other_colors = $product->colors()->skip($skip)->take($limit)->get();

        $color = $product->colors()->first();
        $photos = Photo::where(['product_id'=>$id , 'color_id'=>$color->id])->get();

        $color_product = $product->colors()->where('color_id' , $color->id)->withPivot('id')->first()->pivot;
    	return view('front.product-details',compact('product','other_colors','color','photos','color_product'));
    }


    // Disply Selected product Color
    public function productColor($product_id , $color_id){
        $product = Product::findOrFail($product_id);
        
        $other_colors = $product->colors()->where('color_id' , '!=' , $color_id)->get();

        $color = $product->colors()->where('color_id',$color_id)->first();
        $photos = Photo::where(['product_id'=>$product_id , 'color_id'=>$color_id])->get();

        $color_product = $product->colors()->where('color_id' , $color->id)->withPivot('id')->first()->pivot;
        return view('front.product-details',compact('product','other_colors','color','photos','color_product'));
    }



    




  //   public function deleteFromCart($id){
  //       $product = Product::findOrFail($id);

  //       $cart = Session::get('cart');
  //       $key = array_search($product, $cart);
  //       unset($cart[$key]);
  //       Session::set('cart',$cart);

  //       $cart_id = Session::get('cart_id');
  //       $key_id = array_search($product->id, Session::get('cart_id'));
  //       unset($cart_id[$key_id]);
  //       Session::set('cart_id',$cart_id);

  //       $totall_without_discount = Session::get('totall_without_discount');
  //       $totall_without_discount = $totall_without_discount - $product->price;
  //       Session::set('totall_without_discount',$totall_without_discount);

  //       $totall_price = Session::get('totall_price');
  //       $totall_discount = Session::get('totall_discount');
  //       if($product->offer_price == 0){
  //               $totall_price = $totall_price - $product->price;
  //       }else{
  //           $totall_price = $totall_price - $product->offer_price ;
  //           $totall_discount = $totall_discount - ($product->price - $product->offer_price); 
  //       }
  //       Session::set('totall_price',$totall_price);
  //       Session::set('totall_discount',$totall_discount);

  //       return redirect()->back();
  //   }



  //   // Cart AJAX
  //   public function addToCartAjax(Request $request){
  //   	if(!Session::has('cart')){
  //   		$cart = [];
  //   	}

  //   	if(!Session::has('cart_id')){
  //   		$cart_id = [];
  //   	}
    	
    	
  //   	$product = Product::findOrFail($request->id);
  //   	Session::push('cart',$product);
  //   	Session::push('cart_id',$request->id);
  //   	$cart = Session::get('cart');  

  //       if(Session::has('totall_price')){
  //           $totall_price = Session::get('totall_price');
  //       }else{
  //           $totall_price = 0;
  //       }

  //       if(Session::has('totall_discount')){
  //           $totall_discount = Session::get('totall_discount');
  //       }else{
  //           $totall_discount = 0;
  //       }

  //       if(Session::has('totall_without_discount')){
  //           $totall_without_discount = Session::get('totall_without_discount');
  //       }else{
  //           $totall_without_discount = 0;
  //       }

  //       $totall_without_discount = $totall_without_discount + $product->price;
		
  //       if($product->offer_price == 0){
		// 	$totall_price = $product->price + $totall_price;
		// }else{
		// 	$totall_price = $product->offer_price + $totall_price;
  //           $totall_discount = $product->price - $product->offer_price;
		// }

  //   	Session::put('totall_price',$totall_price);
  //       Session::put('totall_discount',$totall_discount);
  //       Session::put('totall_without_discount',$totall_without_discount);
        
    	
  //   	$cart_count = count($cart);
  //   	return response()->json($cart_count);
  //   }


  //   public function removeFromCartAjax(Request $request){

  //   	$product = Product::findOrFail($request->id);

  //   	$cart = Session::get('cart');
  //   	$cart_id = Session::get('cart_id');

  //   	$key = array_search($product, $cart);
  //   	unset($cart[$key]);

  //   	$key = array_search($product->id, $cart_id);
  //   	unset($cart_id[$key]);

  //   	Session::set('cart' , $cart);
  //   	Session::set('cart_id' , $cart_id);


  //   	$totall_price = Session::get('totall_price');
  //       $totall_discount = Session::get('totall_discount');
  //       $totall_without_discount = Session::get('totall_without_discount');
  //       $totall_without_discount = $totall_without_discount - $product->price;
        
  //   	if($product->offer_price == 0){
  //   			$totall_price = $totall_price - $product->price;
		// }else{
		// 	$totall_price = $totall_price - $product->offer_price ;
  //           $totall_discount = $totall_discount - ($product->price - $product->offer_price); 
		// }

		// Session::set('totall_price',$totall_price);
  //       Session::set('totall_discount',$totall_discount);
  //       Session::set('totall_without_discount',$totall_without_discount);

		// $cart_count = count($cart);
		// return response()->json($cart_count);
  //   }



}
