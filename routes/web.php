<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){
	Route::get('/home', 'HomeController@index')->name('home');

	Route::get('/post/index',[
		'uses' => 'PostsController@index',
		'as' => 'posts'
	]);

	Route::get('/post/create',[
		'uses' => 'PostsController@create',
		'as' => 'post.create'
	]);

	Route::post('/post/store/{id?}',[
		'uses' => 'PostsController@store',
		'as' => 'post.store'
	]);

	Route::get('/post/edit/{id}',[
		'uses' => 'PostsController@edit',
		'as' => 'post.edit'
	]);

	Route::get('/post/delete/{id}',[
		'uses' => 'PostsController@destroy',
		'as' => 'post.delete'
	]);

	Route::get('/post/trashed',[
		'uses' => 'PostsController@trashed',
		'as' => 'posts.trashed'
	]);

	Route::get('/post/remove/{id}',[
		'uses' => 'PostsController@perdelete',
		'as' => 'post.remove'
	]);
	
	Route::get('/post/restore/{id}',[
		'uses' => 'PostsController@restore',
		'as' => 'post.restore'
	]);

	Route::get('/category/index',[
		'uses' => 'CategoriesController@index',
		'as' => 'categories'
	]);

	Route::get('/category/create',[
		'uses' => 'CategoriesController@create',
		'as' => 'category.create'
	]);

	Route::post('/category/store',[
		'uses' => 'CategoriesController@store',
		'as' => 'category.store'
	]);

	Route::get('/category/edit/{id}',[
		'uses' => 'CategoriesController@edit',
		'as' => 'category.edit'
	]);

	Route::post('/category/update/{id}',[
		'uses' => 'CategoriesController@update',
		'as' => 'category.update'
	]);

	Route::get('/category/delete/{id}',[
		'uses' => 'CategoriesController@destroy',
		'as' => 'category.delete'
	]);

	Route::get('/tags',[
		'uses' => 'TagsController@index',
		'as' => 'tags'
	]);

	Route::get('/tags/create',[
		'uses' => 'TagsController@create',
		'as' => 'tag.create'
	]);

	Route::get('/tag/delete/{id}',[
		'uses' => 'TagsController@destroy',
		'as' => 'tag.delete'
	]);
	Route::get('/tag/edit/{id}',[
		'uses' => 'TagsController@edit',
		'as' => 'tag.edit'
	]);
	Route::post('/tag/update/{id}',[
		'uses' => 'TagsController@update',
		'as' => 'tag.update'
	]);
	Route::post('/tag/store',[
		'uses' => 'TagsController@store',
		'as' => 'tag.store'
	]);

	Route::get('/users',[
		'uses' => 'UsersController@index',
		'as' => 'users'
	]);

	Route::get('/users/manage',[
		'uses' => 'UsersController@manage',
		'as' => 'users.manage'
	]);

	Route::post('/user/store',[
		'uses' => 'UsersController@store',
		'as' => 'user.store'
	]);

});	