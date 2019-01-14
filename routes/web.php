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

// Route::get('/', function () {
//     return view('blog.index');
// });
 
// Route::get('/blog/show', function(){
//   return view('blog.show');
// });

Route::get('/',[
	'uses' => 'BlogController@index',
	'as' => 'blog',
]);

Route::get('/blog/{posts}',[
	'uses' => 'BlogController@show',
	'as' => 'blog.show',
]);

Route::get('/category/{category}',[
	'uses' => 'BlogController@category',
	'as' => 'category'
]);

Route::get('/author/{author}',[
	'uses' => 'BlogController@author',
	'as' => 'author'
]);
Auth::routes();

Route::get('/home', 'Backend\HomeController@index')->name('home');

// routes untuk Backend\BlogController
Route::resource('/backend/blog', 'Backend\BlogController',['as'=>'backend']);

//routes untuk mengembalikan file yang sudah ada ditempat sampah
Route::put('/backend/blog/restore/{blog}',[
	'uses' 	=> 'Backend\BlogController@restore',
	'as' 	=> 'backend.blog.restore',
]);

//routes untuk destroy
Route::delete('/backend/blog/force-destroy/{blog}',[
	'uses' 	=> 'Backend\BlogController@forceDestroy',
	'as' 	=> 'backend.blog.force-destroy',
]);

// route untu category
Route::resource('/backend/category', 'Backend\CategoryController',['as'=>'backend']);