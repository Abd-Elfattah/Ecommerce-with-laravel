<?php
use App\User;
use App\Subcategory;
use App\Brand;
use App\Category;
use App\Product;
use Illuminate\Support\Facades\Session;

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



Route::get('test' , function(){
	Session::flush('cart_id');
	Session::flush('cart');
	// return Session::get('cart_id');
	// return Session::get('cart');
	
});


// Important
Route::get('admin' , function(){
	return view('admin.index');
})->name('admin');

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
Route::get('admin/sub/{id}/brands' , 'BrandController@subBrands')->name('sub.brands');

Route::get('ajaxSub' , 'BrandController@ajaxSub');
Route::get('ajaxBrand' , 'BrandController@ajaxBrand');


// Admin Products 
Route::resource('admin/products' , 'ProductController');
Route::post('admin/products2/{id}' , 'ProductController@secondStore');
Route::post('admin/products3/{id}/{color_id}' , 'ProductController@thirdStore');
Route::get('admin/product/details/{id}' , 'ProductController@adminProductDetails');
Route::get('admin/product/{id}/add-color' , 'ProductController@createColor');




// Front-End Controller
Route::get('Eco-home' , 'FrontController@home');
Route::get('Eco-home/sub-category/{id}' , 'FrontController@subProducts');
Route::get('Eco-home/product/{id}','FrontController@displyProduct');
Route::get('addToCartAjax' , 'FrontController@addToCartAjax');
Route::get('removeFromCartAjax' , 'FrontController@removeFromCartAjax');
Route::get('Eco-home/cart' , 'FrontController@displayCart');
Route::get('Eco-home/special-offers', 'FrontController@offers');
// Route::group(['middleware' => 'auth']  , function(){
	
// });


Route::get('/deleteFromCart/{id}', 'FrontController@deleteFromCart');
Auth::routes();

//Route::get('/home', 'HomeController@index');
Route::get('/logout', function(){
	Auth::logout();
	return redirect()->back();
});

Route::get('/login',function(){
	return view('auth.login');
});
Route::get('/register',function(){
	return view('auth.register');
});

// define cats for all views
View::composer('*', function($view)
{
	$cats = Category::all();
    $view->with('cats',$cats);
});
