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

Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');

Route::group(['prefix' => '/admin', 'middleware' => 'auth'],function () {
    Route::get('/', 'Backend\DefaultController@index');
    Route::get('/dashboard', 'Backend\DefaultController@dashboard');
    Route::post('/uploadFileCKEditor', 'Backend\DefaultController@uploadFileCKEditor');
    Route::post('/deleteFileCKEditor', 'Backend\DefaultController@deleteFileCKEditor');

    Route::group(['prefix' => '/carousel'],function () {
        Route::get('/', 'Backend\CarouselController@index');
        Route::post('/table', 'Backend\CarouselController@table');
        Route::get('/create', 'Backend\CarouselController@create');
        Route::post('/add', 'Backend\CarouselController@add')->middleware(['api.token']);
        Route::get('/edit/{id}', 'Backend\CarouselController@edit');
        Route::post('/update/', 'Backend\CarouselController@update')->middleware(['api.token']);
        Route::post('/delete/{id}', 'Backend\CarouselController@delete');
        Route::get('/show/{id}', 'Backend\CarouselController@show');
    });

    Route::group(['prefix' => '/news'],function () {
        Route::get('/', 'Backend\NewsController@index');
        Route::post('/table', 'Backend\NewsController@table');
        Route::get('/create', 'Backend\NewsController@create');
        Route::post('/add', 'Backend\NewsController@add')->middleware(['api.token', 'api.slug']);
        Route::get('/edit/{id}', 'Backend\NewsController@edit');
        Route::post('/update/', 'Backend\NewsController@update')->middleware(['api.token']);
        Route::post('/delete/{id}', 'Backend\NewsController@delete');
        Route::get('/show/{id}', 'Backend\NewsController@show');
    });

    Route::group(['prefix' => '/user'],function () {
        Route::get('/', 'Backend\UserController@index');
        Route::post('/table', 'Backend\UserController@table');
        Route::get('/create', 'Backend\UserController@create');
        Route::post('/add', 'Backend\UserController@add')->middleware(['api.token', 'api.password']);
        Route::get('/edit/{id}', 'Backend\UserController@edit');
        Route::post('/update/', 'Backend\UserController@update')->middleware(['api.token', 'api.password']);
        Route::post('/delete/{id}', 'Backend\UserController@delete');
        Route::get('/show/{id}', 'Backend\UserController@show');
        Route::get('/profile/show', 'Backend\UserController@showProfile');
        Route::get('/profile/edit', 'Backend\UserController@editProfile');
    });

    Route::group(['prefix' => '/tag'],function () {
        Route::get('/', 'Backend\TagController@index');
        Route::post('/table', 'Backend\TagController@table');
        Route::get('/create', 'Backend\TagController@create');
        Route::post('/add', 'Backend\TagController@add')->middleware(['api.token', 'api.slug']);
        Route::get('/edit/{id}', 'Backend\TagController@edit');
        Route::post('/update/', 'Backend\TagController@update')->middleware(['api.token', 'api.slug']);
        Route::post('/delete/{id}', 'Backend\TagController@delete');
        Route::get('/show/{id}', 'Backend\TagController@show');
    });

    Route::group(['prefix' => '/page'],function () {
        Route::get('/', 'Backend\PageController@index');
        Route::post('/table', 'Backend\PageController@table');
        Route::get('/create', 'Backend\PageController@create');
        Route::post('/add', 'Backend\PageController@add')->middleware(['api.token', 'api.slug']);
        Route::get('/edit/{id}', 'Backend\PageController@edit');
        Route::post('/update/', 'Backend\PageController@update')->middleware(['api.token']);
        Route::post('/delete/{id}', 'Backend\PageController@delete');
        Route::get('/show/{id}', 'Backend\PageController@show');
    });

    Route::group(['prefix' => '/category'],function () {
        Route::get('/', 'Backend\CategoryController@index');
        Route::post('/table', 'Backend\CategoryController@table');
        Route::get('/create', 'Backend\CategoryController@create');
        Route::post('/add', 'Backend\CategoryController@add')->middleware(['api.token', 'api.slug']);
        Route::get('/edit/{id}', 'Backend\CategoryController@edit');
        Route::post('/update/', 'Backend\CategoryController@update')->middleware(['api.token', 'api.slug']);
        Route::post('/delete/{id}', 'Backend\CategoryController@delete');
        Route::get('/show/{id}', 'Backend\CategoryController@show');
    });

    Route::group(['prefix' => '/gallery'],function () {
        Route::get('/', 'Backend\GalleryController@index');
        Route::post('/table', 'Backend\GalleryController@table');
        Route::get('/create', 'Backend\GalleryController@create');
        Route::post('/add', 'Backend\GalleryController@add')->middleware(['api.token', 'api.slug']);
        Route::get('/edit/{id}', 'Backend\GalleryController@edit');
        Route::post('/update/', 'Backend\GalleryController@update')->middleware(['api.token', 'api.slug']);
        Route::post('/delete/{id}', 'Backend\GalleryController@delete');
        Route::get('/show/{id}', 'Backend\GalleryController@show');
    });
});

Route::group(['prefix' => '/{locale?}', 'middleware' => 'api.locale'], function () {
    Route::get('/', 'Frontend\DefaultController@index');
});
