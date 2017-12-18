<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Color;
use App\Photo;

class ColorController extends Controller
{
    

    public function createColor1($id){
        $product = Product::findOrFail($id);
        $colors = Color::all();
        return view('admin.product.createColor1' , compact('product','colors'));
    }



    public function deleteColor($product_id, $color_id){
        $color = Product::find($product_id)->colors()->where('color_id',$color_id)->first();
        $photos = $color->photos()->where('product_id' , $product_id)->get();
        foreach ($photos as $photo) {
            unlink(public_path() . $photo->path);
            Photo::find($photo->id)->where('product_id',$product_id)->first()->delete();
        }

        Product::find($product_id)->colors()->detach($color_id);

        return redirect()->route('product.details' , ['id'=>$product_id]);
    }



    public function storeColor(Request $request ,$id){
    	$product = Product::findOrFail($id);
    	$product->colors()->attach( $request->color_id , ['quantity'=>$request->quantity] );
    	$color_id = $request->color_id;
    	return view('admin.product.createColor2',compact('product','color_id'));
    }


    public function storeColorImages(Request $request , $product_id , $color_id){
    	$photo = $request->file('file');
    	$name  = time() . $photo->getClientOriginalName();
    	$photo->move('images',$name);
    	Photo::create(['product_id'=>$product_id ,'color_id'=>$color_id , 'path'=>$name ]);
    }


    public function addQuantity(Request $request , $product_id , $color_id){
        $product = Product::findOrFail($product_id);
        $color = $product->colors()->where(['product_id'=>$product_id , 'color_id'=>$color_id])->first();
        Product::find($product_id)->colors()->updateExistingPivot( $color_id, ['quantity'=>($color->pivot->quantity + $request->quantity)]);
        return redirect()->back();

    }

    // Create Images with color
    public function colorImages($product_id,$color_id){
        $product = Product::findOrFail($product_id);
        $color = Color::findOrFail($color_id);
        $photos = Photo::where(['product_id'=>$product_id , 'color_id'=>$color_id])->get();

        return view('admin.product.colorImages' , compact('product','color','photos'));
    }


    // Create Images after creating color
    public function addImagesForColor($product_id , $color_id){
        $product = Product::findOrFail($product_id);
        $color = Color::findOrFail($color_id);
        return view('admin.product.addImagesForColor' , compact('product','color'));
    }

    public function storeNewColorImages(Request $request , $product_id,$color_id){
        $photo = $request->file('file');
        $name  = time() . $photo->getClientOriginalName();
        $photo->move('images',$name);
        Photo::create(['product_id'=>$product_id ,'color_id'=>$color_id , 'path'=>$name ]);
    }



    public function deleteImage($id){
        $photo = Photo::findOrFail($id);
        unlink(public_path() . $photo->path );
        $photo->delete();
        return redirect()->back();
    }


}
