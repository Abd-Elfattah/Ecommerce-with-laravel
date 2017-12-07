<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Category;
use App\Subcategory;
use App\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::paginate(10);

        return view('admin.brand.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.brand.create' , compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $brand = Brand::create($input);

        if($brand){
            Session::flash('createBrand' , 'The Brand Has Been created successfully');
        }

        return redirect('admin/brands');
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
        $brand = Brand::findOrFail($id);
        $cat = $brand->subcategory->category;
        $subs = $cat->subcategories;
        $categories = Category::all();        
        
        return view('admin.brand.edit',compact('categories','brand','subs'));
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
        $brand = Brand::findOrFail($id);

        $input = $request->all();

        $brand->update($input);

        if($brand){
            Session::flash('editBrand' , 'The Brand Has Been Updated successfully');
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);

        if($brand->delete()){
            Session::flash('deleteBrand' , 'The Brand Has Been Deleted successfully');
        }

        return redirect('admin/brands');
    }






    public function subBrands($id){
        $sub = Subcategory::findOrFail($id);
        $brands = Brand::whereSubcategoryId( $sub->id )->paginate(6);

        return view('admin.brand.index' , compact('brands'));
    }


    public function ajaxSub(Request $request){

        $data = Subcategory::select('id','name')->where('category_id',$request->id)->get();

        return response()->json($data);
    }
}
