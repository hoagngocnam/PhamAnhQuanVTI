<?php

use App\Http\Controllers\IndexController;
use App\Http\Requests\StoreCategoriesRequest;
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
Route::group(['prefix' => 'laravel-filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('/dashboard', 'DashboardController@show')->middleware(['auth', 'verified']);

Route::group(['prefix' => 'admin'], function () {
    Auth::routes(['verify' => true]);
    Route::middleware(['auth:admin', 'verified'])->group(function () {
        //Admin User
        Route::get('/', function () {
            return view('admin/dashboard');
        });
        Route::get('profile', 'AdminController@profile')->name('admin.profile');
        Route::get('list', 'AdminController@list')->name('admin.list');
        Route::get('add', 'AdminController@add')->name('admin.add');
        Route::post('store', 'AdminController@store')->name('admin.store');
        Route::get('delete/{id}', 'AdminController@delete')->name('admin.delete');
        Route::get('edit/{id}', 'AdminController@edit')->name('admin.edit');
        Route::post('update/{id}', 'AdminController@update')->name('admin.update');
        Route::get('user', 'AdminController@user')->name('admin.user');

        //Categories
        Route::get('categories/list/', 'AdminCategoriesController@list')->name('categories.list');
        Route::get('categories/add', 'AdminCategoriesController@add')->name('categories.add');
        Route::post('categories/store', 'AdminCategoriesController@store')->name('categories.store');
        Route::get('categories/delete/{id}', 'AdminCategoriesController@delete')->name('categories.delete');
        Route::get('categories/edit/{id}', 'AdminCategoriesController@edit')->name('categories.edit');
        Route::post('categories/update/{id}', 'AdminCategoriesController@update')->name('categories.update');
        Route::get('categories/show/($id)', 'AdminCategoriesController@show')->name('categories.show');

        //Posts
        Route::get('posts/list', 'AdminPostsController@list')->name('posts.list');
        Route::get('posts/add', 'AdminPostsController@add')->name('posts.add');
        Route::post('posts/store', 'AdminPostsController@store')->name('posts.store');
        Route::get('posts/edit/{id}', 'AdminPostsController@edit')->name('posts.edit');
        Route::get('posts/delete/{id}', 'AdminPostsController@delete')->name('posts.delete');
        Route::post('posts/update/{id}', 'AdminPostsController@update')->name('posts.update');
        Route::get('posts/details/{id}', 'AdminPostsController@details')->name('posts.details');

        //Comments
        Route::get('comments/list', 'AdminCommentsController@list')->name('comments.list');
        Route::get('comment/edit/{id}', 'AdminCommentsController@edit')->name('comment.edit');
        Route::get('comments/active', 'AdminCommentsController@active')->name('comments.active');
        Route::get('comment/details/{id}', 'AdminCommentsController@details')->name('comment.details');
        Route::get('comment/delete/{id}', 'AdminCommentsController@delete')->name('comment.delete');
    });
});
//User

Route::get('/', 'IndexController@show');
Route::get('dang-ky', 'UserController@register')->name('user.register');
Route::post('store', 'UserController@store')->name('user.store');
Route::get('dang-nhap', 'UserController@login')->name('user.login');
Route::post('storee', 'UserController@storee')->name('user.storee');
Route::get('quen-mat-khau', 'UserController@showForgetPasswordForm')->name('forget.password.get');
Route::post('forget-password', 'UserController@submitForgetPasswordForm')->name('forget.password.post');
Route::get('dat-lai-mat-khau/{token}', 'UserController@showResetPasswordForm')->name('reset.password.get');
Route::post('reset-password', 'UserController@submitResetPasswordForm')->name('reset.password.post');
Route::get('/chi-tiet-bai-viet/{slug}', 'IndexController@detailPost')->name('detail.post');
Route::post('/comment/add/{id}', 'CommentController@addComment')->name('comment.add');
Route::post('/comment/store/{id}', 'CommentController@storeComment')->name('comment.store');
Route::get('/danh-muc/{slug}', 'IndexController@detailCategories')->name('detail.categories');
Route::get('thong-tin-ca-nhan', 'IndexController@profile')->name('profile');