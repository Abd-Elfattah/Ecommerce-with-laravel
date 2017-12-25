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
| by your application. Just tell Laravel theU RIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Route::get('/test' , function(){
	
	//  // $cart = Session::get('cart');
	//  // return $cart->totPrice;	
	// Session::flush('cart');

	// $products = Subcategory::find(1)->products;
	// return $products->where('subcategory_id' , 1);

	// $array = ['1'=>13 , '2'=>67 , '3'=>50];
	// asort( $array );
	// foreach ($array as $value) {
	// 	echo $value . "   ";
	// }
	$sub = Subcategory::findOrFail(1);
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

        return $products;

});


// Display All Categories
View::composer('*', function($view)
{
	$cats = Category::all();
    $view->with('cats',$cats);
});



Route::get('/error404' , function(){
	return view('errors.404');
})->name('error404');


// Important Admin Middleware Group
Route::group(['middleware'=> ['admin']] , function(){
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
	Route::get('admin/product/details/{id}' , 'ProductController@adminProductDetails')->name('product.details');
	Route::post('admin/product/{id}/addDiscount' , 'ProductController@addDiscount');
	Route::get('admin/product/{id}/deleteDiscount' , 'ProductController@deleteDiscount')->name('delete.discount');


	// Admin Color Controller
	Route::get('admin/product/{id}/add-color' , 'ColorController@createColor1')->name('product.create-color-1');
	Route::post('admin/product/{id}/storecolor' , 'ColorController@storeColor');
	Route::delete('admin/product/{pro_id}/color/{color_id}/delete' , 'ColorController@deleteColor');
	Route::post('admin/product/{id}/storecolorimages/{color_id}' , 'ColorController@storeColorImages');
	Route::post('admin/product/{product_id}/color/{id}/addQuantity' ,'ColorController@addQuantity');
	Route::get('admin/product/{product_id}/color/{color_id}/images' , 'ColorController@colorImages')->name('color.images');
	Route::get('admin/product/{product_id}/color/{color_id}/addImages' , 'ColorController@addImagesForColor')->name('color.add.images');
	Route::get('admin/product/{{product_id}}/color/{color_id}/storeImages' , 'ColorController@storeNewColorImages');
	Route::get('admin/product/color/images/{id}/delete' , 'ColorController@deleteImage')->name('color.images.delete');
});





// Front-End Controller
Route::get('Eco-home' , 'FrontController@home')->name('homePage');
Route::get('Eco-home/sub-category/{id}' , 'FrontController@subProducts')->name('sub-category.show');
Route::get('Eco-home/product/{id}','FrontController@displyProduct')->name('Eco-home.product');

Route::get('Eco-home/special-offers', 'FrontController@offers');
Route::get('Eco-home/product/{product_id}/color/{color_id}' , 'FrontController@productColor')->name('product.color');

// Sort By
Route::get('/Eco-home/sub-category/{sub_id}/sortBy/discountOnly' , 'FrontController@sortByDiscount')->name('sortBy.discount');
Route::get('/Eco-home/sub-category/{sub_id}/sortBy/brand/{brand_id}' , 'FrontController@sortByBrand')->name('sortBy.brand');
Route::get('/Eco-home/sub-category/{sub_id}/sortBy/Price_lowest_first' , 'FrontController@sortByPriceLowest')->name('sortBy.priceLowestFirst');
Route::get('/Eco-home/sub-category/{sub_id}/sortBy/Price_highest_first' , 'FrontController@sortByPriceHighest')->name('sortBy.priceHighestFirst');




// Cart Controller
Route::get('Eco-home/cart' , 'CartController@show')->name('cart.show');
Route::get('Eco-home/product/{product_id}/color/{color_id}/addToCart' , 'CartController@addToCart')->name('product.addToCart');
Route::get('Eco-home/product/{product_id}/color/{color_id}/removeFromCart' , 'CartController@removeFromCart')->name('product.removeFromCart');
Route::get('Eco-home/product/{product_id}/color/{color_id}/changeQuantity/{count}' , 'CartController@changeQuantity')->name('product.changeQuantity');
Route::post('Eco-home/cart/checkout' , 'CartController@checkOut');

// Email Verification
Route::get('verifyEmail/{email}/{verifyToken}' , 'FrontController@sendEmailDone')->name('sendEmailDone');



// Profile Controller
Route::get('Eco-home/user/{user_id}/addresses' , 'ProfileController@userAddress')->name('user.address');
Route::get('Eco-home/user/{user_id}/createAddresses' , 'ProfileController@createAddress')->name('user.create.address');
Route::post('user/{user_id}/storeAddress' , 'ProfileController@storeAddress');
Route::get('Eco-home/user/{id}/orders' , 'ProfileController@showOrders')->name('user.orders');




// Users LogOut 
Route::get('/Eco-home/logout' , function(){
	Auth::logout();
	return redirect()->route('homePage');
})->name('logout')->middleware('auth');



// Auth::routes();
Route::auth();


