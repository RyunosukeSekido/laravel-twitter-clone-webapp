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
    Route::post('users/{user}/follow', 'App\Http\Controllers\UsersController@follow')->name('follow');
    Route::delete('users/{user}/unfollow', 'App\Http\Controllers\UsersController@unfollow')->name('unfollow');
    
    // ツイート関連
    Route::get('/tweets', 'App\Http\Controllers\TweetsController@index')->name('tweets.index');
    Route::get('/tweets/create', 'App\Http\Controllers\TweetsController@create')->name('tweets.create');
    Route::post('/tweets', 'App\Http\Controllers\TweetsController@store')->name('tweets.store');
    Route::get('/tweets/{tweet}', 'App\Http\Controllers\TweetsController@show')->name('tweets.show');
    Route::get('/tweets/{tweet}/edit', 'App\Http\Controllers\TweetsController@edit')->name('tweets.edit');
    Route::put('/tweets/{tweet}', 'App\Http\Controllers\TweetsController@update')->name('tweets.update');
    Route::delete('/tweets/{tweet}', 'App\Http\Controllers\TweetsController@destroy')->name('tweets.destroy');

    // コメント関連
    Route::post('/tweets/{tweet}/comments', 'App\Http\Controllers\CommentsController@store')->name('comments.store');
});