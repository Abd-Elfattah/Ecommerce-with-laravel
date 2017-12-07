<?php
use App\User;
use App\Subcategory;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('admin' , ['as'=>'admin' , function(){
	return view('admin.index');
}]);


Route::get('test' , function(){
	$sub = Subcategory::findOrFail(1);
	// if($sub->attr4 == ''){
	// 	return "empty column";
	// }

	$sub->attr4 == null;
	$sub->save();

	// return $user;
});


// Admin Users Routes
Route::get('admin/users/adminstrators' , 'AdminUsersController@adminstrators')->name('users.adminstrators');
Route::get('admin/users/clients' , 'AdminUsersController@clients')->name('users.clients');

Route::resource('admin/users' , 'AdminUsersController');
Route::get('admin/users' , 'AdminUsersController@index')->name('admin.users.index');
Route::get('admin/users/create' , 'AdminUsersController@create')->name('admin.users.create');
Route::get('admin/users/{id}/edit' , 'AdminUsersController@edit')->name('admin.users.edit');



// Admin Category Controller
Route::get('admin/categories/{id}' , 'CategoryController@destroy')->name('category.delete');
Route::get('admin/categories/{id}/edit' , 'CategoryController@edit')->name('category.edit');
Route::resource('admin/categories' , 'CategoryController');
Route::get('admin/categories' , 'CategoryController@index')->name('admin.categories');




// Admin SubCategories
Route::resource('admin/subcategories' , 'SubCategoryController');
Route::get('admin/subcategories/create' , 'SubCategoryController@create')->name('sub.create');
Route::get('admin/subcategories/{id}/edit' , 'SubCategoryController@edit')->name('sub.edit');
Route::get('admin/subcategories' , 'SubCategoryController@index')->name('sub.index');




// Admin Brands
Route::get('admin/brands' , 'BrandController@index')->name('brand.index');
Route::get('admin/brands/create' , 'BrandController@create')->name('brand.create');
Route::post('admin/brands' , 'BrandController@store');
Route::get('admin/brands/{id}/edit' , 'BrandController@edit')->name('brand.edit');
Route::patch('admin/brands/{id}' , 'BrandController@update');
Route::get('admin/brands/{id}' , 'BrandController@destroy');

//Route::resource('admin/brands' , 'BrandController');

Route::get('admin/sub/{id}/brands' , 'BrandController@subBrands')->name('sub.brands');

Route::get('ajaxSub' , 'BrandController@ajaxSub');
