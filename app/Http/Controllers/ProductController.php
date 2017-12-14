<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Subcategory;
use App\Brand;
use App\Product;
use App\Color;
use App\Photo;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $products = Product::paginate(10);
        return view('admin.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create' , compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(trim($request->offer_price) == ''){
            $input = $request->except('offer_price');
        }else{
            $input = $request->all();
        }

        unset($input['subcategory_id']);

        $product = Product::create($input);

        $colors = color::pluck('name','id');
        
        $sub = Subcategory::findOrFail($request['subcategory_id']);


        return view('admin.product.create2' ,compact('product','colors','sub'));

    }


    public function secondStore(Request $request , $id){

        $product = Product::findOrFail($id);
        $product->colors()->attach($request->color_id , ['quantity'=>$request->quantity]);
        $color_id = $request->color_id;
        //$input = $request->all;

        if( trim($request->val1) != ''){
            $product->update(['val1'=>$request->val1]);
        }

        if(trim($request->val2) != ''){
            $product->update(['val2'=>$request->val2]);
        }

        if(trim($request->val3) != ''){
            $product->update(['val3'=>$request->val3]);
        }

        if(trim($request->val4) != ''){
            $product->update(['val4'=>$request->val4]);
        }


        if(trim($request->val5) != ''){
            $product->update(['val5'=>$request->val5]);
        }


        return view('admin.product.create3', compact('product','color_id'));

    }


     public function thirdStore(Request $request , $product_id , $color_id){

        $photo = $request->file('file');

        $name = time() . $photo->getClientOriginalName();

        $photo->move('images' , $name);

        Photo::create(['product_id'=>$product_id , 'color_id'=>$color_id , 'path'=>$name]);

     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function adminProductDetails($id){
        $product = Product::findOrFail($id);


        return view('admin.product.productDetails',compact('product'));
    }

}
