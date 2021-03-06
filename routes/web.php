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
})->name('home');

// guests routes
Route::resource('/articles', 'articlesController', ['only' => ['index', 'show']]);

// admin routes
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
    Route::resource('/articles', 'articlesController');
});

Auth::routes();
