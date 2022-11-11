<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('/dashboard','DashboardController@show')->middleware(['auth','verified']);

Route::group(['prefix' => 'admin'], function () {
    Auth::routes(['verify' => true]);
    Route::middleware(['auth','verified'])->group(function () {
        //Admin User
        Route::get('list','AdminController@list')->name('admin.list');
        Route::get('add','AdminController@add')->name('admin.add');
        Route::post('store','AdminController@store')->name('admin.store');
        Route::get('delete/{id}','AdminController@delete')->name('admin.delete');
        Route::get('edit/{id}','AdminController@edit')->name('admin.edit');
        Route::post('update/{id}','AdminController@update')->name('admin.update');
        
        //Categories
        Route::get('categories/list/','AdminCategoriesController@list')->name('categories.list');
        Route::get('categories/add','AdminCategoriesController@add')->name('categories.add');
        Route::post('categories/store','AdminCategoriesController@store')->name('categories.store');
        Route::get('categories/delete/{id}','AdminCategoriesController@delete')->name('categories.delete');
        Route::get('categories/edit/{id}','AdminCategoriesController@edit')->name('categories.edit');
        Route::post('categories/update/{id}','AdminCategoriesController@update')->name('categories.update');
    });

});