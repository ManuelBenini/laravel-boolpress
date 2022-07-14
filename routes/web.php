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

Auth::routes();

Route::middleware('auth')
    ->name('admin.')
    ->prefix('admin')
    ->namespace('admin')
    ->group(function(){
        Route::get('/', 'PageController@index')->name('index');
        Route::resource('posts', 'PostController');
    });
#

Route::get('{any?}', function () {
    return view('guests.home');
})->where('any', '.*')->name('home');

