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

use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Console\Input\Input;


Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//Admin
Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('pending', 'DashboardController@pending')->name('pending');
    Route::get('newRegistration', 'DashboardController@newRegistration')->name('newRegistration');
    Route::get('newRegistration/approve/{id}', 'DashboardController@registrationApprove')->name('registration.approve');
    Route::get('newRegistration/delete/{id}', 'DashboardController@registrationDelete')->name('registration.delete');

    //category access for admin
    Route::get('category/index', 'CategoryController@index')->name('category.index');
    Route::get('category/create', 'CategoryController@create')->name('category.create');
    Route::post('category/store', 'CategoryController@store')->name('category.store');
    Route::get('category/edit/{id}', 'CategoryController@edit')->name('category.edit');
    Route::post('category/update/{id}', 'CategoryController@update')->name('category.update');
    Route::get('category/delete/{id}', 'CategoryController@delete')->name('category.delete');
});

//Author
Route::group(['as' => 'author.', 'prefix' => 'author', 'namespace' => 'Author', 'middleware' => ['auth', 'author']], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
});

//post
Route::get('/', 'PostController@show')->name('fronthome');
Route::get('post/single/view/{id}', 'PostController@singleView')->name('post.single.view');
Route::post('post/comment/{id}', 'PostController@commentStore')->name('post.comment');
Route::get('post/sameCatPost/{id}', 'PostController@sameCatPost')->name('post.sameCat');

Route::group(['as' => 'post.', 'prefix' => 'post', 'middleware' => 'auth'], function () {
    Route::get('index', 'PostController@index')->name('index');
    Route::get('create', 'PostController@create')->name('create');
    Route::post('store', 'PostController@store')->name('store');
    Route::get('edit/{id}', 'PostController@edit')->name('edit');
    Route::post('update/{id}', 'PostController@update')->name('update');
    Route::get('delete/{id}', 'PostController@delete')->name('delete');
    Route::get('approve/{id}', 'PostController@approve')->name('approve');

    //post soft delete
    Route::get('rejected/list', 'PostController@rejected')->name('rejected');
    Route::get('rejected/view/{id}', 'PostController@rejectedPostView')->name('rejectedView');
    Route::get('rejected/edit/{id}', 'PostController@rejectedPostEdit')->name('rejectedEdit');
    Route::post('rejected/update/{id}', 'PostController@rejectedPostUpdate')->name('rejectedUpdate');
    Route::get('rejected/delete/{id}', 'PostController@rejectedPostDelete')->name('rejectedDelete');

    //single post view for authenticated user
    Route::get('auth/view/{id}', 'PostController@authPostView')->name('authView');

});

//search
Route::post('search', 'PostController@search')->name('search');




