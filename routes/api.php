<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::namespace('Api')
        ->prefix('posts')
        ->group(function(){
            Route::get('/', 'PageController@index');
            Route::get('/dettaglio-post/{slug}', 'PageController@getPost');
            Route::get('/post-per-categoria/{slug}', 'PageController@getPostByCategory');
            Route::get('/post-per-tag/{slug}', 'PageController@getPostByTag');
        });
