<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


use App\Category;
use App\Subcategory;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subs = Subcategory::paginate(10);

        return view('admin.subcategory.index' , compact('subs') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $categories = Category::pluck('name','id');
        return view('admin.subcategory.create' , compact('categories'));
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

        $category_id = $input['category_id'] ;
        $category = Category::findOrFail($category_id);

        $sub = $category->subcategories()->create($input);

        if($sub){
            Session::flash('createSub' , 'The Sub-Category Has Been Created Successfully');
        }

        return redirect()->route('sub.index');
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
        $categories = Category::pluck('name' , 'id');

        $sub = Subcategory::findOrFail($id);

        return view('admin.subcategory.edit' , compact('categories' , 'sub'));
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

        $input = $request->all();

        $sub = Subcategory::findOrFail($id);
        if( $sub->update($input) ){
            Session::flash('editSub' , 'The Sub-Category Has Been Updated Successfully');
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
        $sub = Subcategory::findOrFail($id);

        if( $sub->delete() ){
            Session::flash('deleteSub' , 'The Sub-Category Has Been Deleted Successfully' );
        }

        return redirect('admin/subcategories');
    }



    
}
