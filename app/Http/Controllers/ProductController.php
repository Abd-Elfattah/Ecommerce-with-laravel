<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Subcategory;
use App\Brand;
use App\Product;
use App\Color;
use App\Photo;
use App\Option;
use App\Value;

class ProductController extends Controller
{


    public function index()
    {   
        $products = Product::paginate(10);
        return view('admin.product.index',compact('products'));
    }

    
   
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create' , compact('categories'));
    }


    public function store(Request $request)
    {
        
        $input = $request->all();

        unset($input['subcategory_id']);

        $product = Product::create($input);

        $colors = color::pluck('name','id');
        
        $sub = Subcategory::findOrFail($request['subcategory_id']);


        return view('admin.product.create2' ,compact('product','colors','sub'));

    }


    public function secondStore(Request $request , $product_id , $sub_id){

        $product = Product::findOrFail($product_id);
        $product->colors()->attach($request->color_id , ['quantity'=>$request->quantity]);
        $color_id = $request->color_id;
        $input = $request->all();
        unset($input['color_id']);
        unset($input['quantity']);
        unset($input['_token']);

        $sub = Subcategory::findOrFail($sub_id);
        foreach($sub->options as $option){
            foreach ($input as $key => $value) {
                $option->values()->create(['product_id'=>$product_id , 'name'=>$value]);
                unset($input[$key]);
                break;
            }
        }

        return view('admin.product.create3', compact('product','color_id'));

    }


     public function thirdStore(Request $request , $product_id , $color_id){

        $photo = $request->file('file');

        $name = time() . $photo->getClientOriginalName();

        $photo->move('images' , $name);

        Photo::create(['product_id'=>$product_id , 'color_id'=>$color_id , 'path'=>$name]);

     }



     
    public function show($id)
    {
        //
    }

    
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
        $product = Product::findOrFail($id);
        $photos = $product->photos;
        foreach ($photos as $photo) {
            unlink(public_path() . $photo->path);
        }

        $product->delete();


        $products = Product::paginate(10);
        return view('admin.product.index',compact('products'));
    }


    public function adminProductDetails($id){
        $product = Product::findOrFail($id);
        $sub = $product->brand->subcategory;
        return view('admin.product.productDetails',compact('product'));
    }



    public function addDiscount(Request $request ,$id){
        $product = Product::findOrFail($id);
        $product->update(['offer_price' => $request->offer_price ]);
        return redirect()->back();
    }

    public function deleteDiscount($id){
        $product = Product::findOrFail($id);
        $product->update(['offer_price'=>0]);
        return redirect()->back();
    }

}
