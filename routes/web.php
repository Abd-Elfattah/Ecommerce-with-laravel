<?php
use App\User;
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
	$user = User::findOrFail(7);
	$user->update(['is_admin'=>'mahmpdosk']);

	return $user;
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


