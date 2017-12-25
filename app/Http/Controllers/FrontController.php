<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;
use App\Category;
use App\Subcategory;
use App\Product;
use App\Photo;
use App\User;


class FrontController extends Controller
{
    public function home(){
    	$products = Product::paginate(9);

    	return view('front.home',compact('products'));
    }



    public function subProducts($sub_id){
    	$sub = Subcategory::findOrFail($sub_id);
    	$products = $sub->products()->paginate(9);
        $count = Product::countIfOutOfStock($sub->products);
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



    // Email Verification
    public function sendEmailDone($email , $verifyToken){
        $user =User::where(['email'=>$email , 'verifyToken'=>$verifyToken ])->first();
        if($user){
          $user->update(['verifyToken'=>NULL , 'status'=>1]);
          Session::flash('email_activate' , 'Your Email Activated Successfully');
          return redirect()->route('homePage');
        }

    }




    //  -------  Sort By -----------

    public function sortByDiscount($sub_id){
        $sub = Subcategory::findOrFail($sub_id);
        $products = $sub->products()->where('offer_price', '!=' , 0)->paginate(9);
        $count = Product::countIfOutOfStock($products);
        return view('front.sub-category', compact('sub','products','count'));

    }

    public function sortByBrand($sub_id,$brand_id){
        $sub = Subcategory::findOrFail($sub_id);
        $products = $sub->products()->where('brand_id', $brand_id)->paginate(9);
        $count = Product::countIfOutOfStock($products);
        return view('front.sub-category', compact('sub','products','count'));

    }

    public function sortByPriceLowest($sub_id){
        $sub = Subcategory::findOrFail($sub_id);
        $list = [];
        foreach ($sub->products as $product) {
            if( $product->offer_price == 0 ){
                $price = $product->price;
            }else{
                $price = $product->offer_price;
            }

            $list[$product->id] = $price;
        }


        asort($list);

        $products = [];
        foreach ($list as $key => $value) {
            $product = Product::findOrFail($key);
            $products[] = $product;
        }
        $count = count( $products );

        return view('front.sub-category', compact('sub','products','count'));
    }



    public function sortByPriceHighest($sub_id){
        $sub = Subcategory::findOrFail($sub_id);
        $list = [];
        foreach ($sub->products as $product) {
            if( $product->offer_price == 0 ){
                $price = $product->price;
            }else{
                $price = $product->offer_price;
            }

            $list[$product->id] = $price;
        }


        arsort($list);

        $products = [];
        foreach ($list as $key => $value) {
            $product = Product::findOrFail($key);
            $products[] = $product;
        }
        $count = count( $products );

        return view('front.sub-category', compact('sub','products','count'));
    }
    //  -------  End --- Sort By -----------


    
}
