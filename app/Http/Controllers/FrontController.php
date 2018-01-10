<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Category;
use App\Subcategory;
use App\Product;
use App\Photo;
use App\User;
use App\Pagination;


class FrontController extends Controller
{
     // API
    public function apiHome(){
        $latest_products = Product::where('offer_price',0)->orWhere('offer_price',null)->orderBy('id','DESC')->take(6)->get();
        $latest_products = Product::productsIfOutOfStock($latest_products);
        $latest = [];
        foreach($latest_products as $product){
            $array['id'] = $product->id;
            $array['name'] = $product->name;
            $array['color'] = $product->colors()->first()->name;
            $array['brand'] = $product->brand->name;
            $array['description'] = $product->description;
            $array['price'] = $product->price;
            
            $array['offer_price'] = 0;
            $array['discount'] = 0;
            $array['quantity'] = $product->colors()->first()->pivot->quantity;
            $color_id = $product->colors()->first()->id;
            $photo = Photo::where(['product_id'=>$product->id,'color_id'=>$color_id])->first()->path;
            $array['photo'] = public_path().$photo;
            $latest[] = $array;

        }
        $products = Product::where('offer_price', '!=' , 0)->get();
        $offer_products = Product::productsIfOutOfStock($products);
        $offers=[];
        foreach($offer_products as $product){
            $array['id'] = $product->id;
            $array['name'] = $product->name;
            $array['color'] = $product->colors()->first()->name;
            $array['brand'] = $product->brand->name;
            $array['description'] = $product->description;
            $array['price'] = $product->price;
            
            $array['offer_price'] = $product->offer_price;
            $array['discount'] = floor(100-(($product->offer_price/$product->price)*100))."%";
            $array['quantity'] = $product->colors()->first()->pivot->quantity;
            $color_id = $product->colors()->first()->id;
            $photo = Photo::where(['product_id'=>$product->id,'color_id'=>$color_id])->first()->path;
            $array['photo'] = public_path().$photo;
            $offers[] = $array;

        }

        // $data = ['offer_products'=>$offer_products,'latest_products'=>$latest_products];
        $data = ['offerProducts'=>$offers,'latestProducts'=>$latest];
        return json_encode($data);
    }   
    


    public function home(){
    	$latest_products = Product::where('offer_price',0)->orWhere('offer_price',null)->orderBy('id','DESC')->take(6)->get();
        $latest_products = Product::productsIfOutOfStock($latest_products);
        
        $products = Product::where('offer_price', '!=' , 0)->get();
        $offer_products = Product::productsIfOutOfStock($products);
    	return view('front.home',compact('latest_products','offer_products'));

    }   



    public function subProducts($sub_id , $current_page){
    	$sub = Subcategory::findOrFail($sub_id);
        $products = $sub->products()->orderBy('id','ASC')->get();
        $count = Product::countIfOutOfStock($sub->products);
        $products = Product::productsIfOutOfStock($products);
        $sort_type = null;
        if($products){
            $page = new Pagination($products,9,$current_page);
            $products = $page->productsPerPage($products);
            if(!$products){
                return redirect()->route('error404');
            }
        }else{
            $page = 0;
            $products = 0;
        }
        
        
        
    	return view('front.sub-category', compact('sub','products','count','sort_type','page'));
    }

    

    public function offers(){
        $products = Product::where('offer_price' , '>' , 0)->paginate(9);
        $count = Product::countIfOutOfStock(Product::where('offer_price','!=',0)->get());
        return view('front.special-offers',compact('products','count') );
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
        }else{
            return redirect()->route('error404');
        }

    }


    // ----------- SEARCH -----------
    public function search(Request $request){
        $name = $request->search;
        $products = Product::where('name' , 'LIKE' , "%$name%")->get();
        $count = Product::countIfOutOfStock($products);
        return view('front.search', compact('products','count'));
    }


    // Ajax Real-Time
    public function autoComplete(Request $request){
        $name = $request->search_word;
        $data = []; 
        $products = Product::where('name' , 'LIKE' , "%$name%")->get();
        if(count($products)){
            $data[] = 'success';

            $items=[];
            foreach ($products as $product) {
                $path = Photo::where('product_id',$product->id)->first()->path;
                $path = asset($path);
                $link = route('Eco-home.product' , $product->id);
                $items[] = ['link'=>$link,'name'=>$product->name,'path'=>$path];
            }

            $data[] = $items; 
        }else{
            $data[] = 'failed';
        }


        return response()->json($data);
    }

    



    //  -------  Sort By -----------

    public function sortByDiscount($sub_id,$current_page){
        $sub = Subcategory::findOrFail($sub_id);
        $products = $sub->products()->where('offer_price', '!=' , 0)->get();
        $count = Product::countIfOutOfStock($products);

        $products = Product::productsIfOutOfStock($products);
        if($products){
            $page = new Pagination($products,9,$current_page);
            $products = $page->productsPerPage($products);
            if(!$products){
                return redirect()->route('error404');
            }
        }else{
            $page = 0;
            $products = 0;
        }

        $sort_type = 'disc';
        return view('front.sub-category', compact('sub','products','count','sort_type','page'));

    }

    public function sortByBrand($sub_id,$brand_id,$current_page){
        $sub = Subcategory::findOrFail($sub_id);
        $products = $sub->products()->where('brand_id', $brand_id)->paginate(9);
        $count = Product::countIfOutOfStock($products);

        $products = Product::productsIfOutOfStock($products);
        
        if($products){
            $page = new Pagination($products,9,$current_page);
            $products = $page->productsPerPage($products);
            if(!$products){
                return redirect()->route('error404');
            }
        }else{
            $page = 0;
            $products = 0;
        }


        $sort_type = 'brand';
        return view('front.sub-category', compact('sub','products','count','brand_id','sort_type','page'));

    }

    public function sortByPriceLowest($sub_id,$current_page){
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

        $products = Product::productsIfOutOfStock($products);
        
        if($products){
            $page = new Pagination($products,9,$current_page);
            $products = $page->productsPerPage($products);
            if(!$products){
                return redirect()->route('error404');
            }
        }else{
            $page = 0;
            $products = 0;
        }

        $sort_type = 'low';
        return view('front.sub-category', compact('sub','products','count','sort_type','page'));
    }



    public function sortByPriceHighest($sub_id,$current_page){
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

        $products = Product::productsIfOutOfStock($products);
        
        if($products){
            $page = new Pagination($products,9,$current_page);
            $products = $page->productsPerPage($products);
            if(!$products){
                return redirect()->route('error404');
            }
        }else{
            $page = 0;
            $products = 0;
        }

        $sort_type = 'high';
        return view('front.sub-category', compact('sub','products','count','sort_type','page'));
    }


    
    //  -------  End --- Sort By -----------


    
    //  ----------- test -------
    public function cats(){
        

        return view('test');
    }

    public function ajaxCats(){
        $data = Category::all();
        return response()->json($data);
    }

    public function newCat(Request $request){
        $cat = Category::create(['name'=>$request->name]);
        // return response()->json();
    }
}
