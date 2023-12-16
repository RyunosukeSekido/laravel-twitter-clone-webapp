<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ログイン状態
Route::group(['middleware' => 'auth'], function() {

    // ユーザ関連
    Route::get('/users', 'App\Http\Controllers\UsersController@index')->name('users.index');
    Route::get('/users/{user}', 'App\Http\Controllers\UsersController@show')->name('users.show');
    Route::get('/users/{user}/edit', 'App\Http\Controllers\UsersController@edit')->name('users.edit');
    Route::put('/users/{user}', 'App\Http\Controllers\UsersController@update')->name('users.update');

    // フォロー/フォロー解除を追加
    Route::post('users/{user}/follow', 'UsersController@follow')->name('follow');
    Route::delete('users/{user}/unfollow', 'UsersController@unfollow')->name('unfollow');
    
});