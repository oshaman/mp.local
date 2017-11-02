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

Route::get('/', 'MainController@main');

Route::match(['get', 'post'], 'main', 'MainController@index');

Route::get('preparat/{loc}/{medicine}/{act?}', 'MainController@medicine')
    ->name('medicine')
    ->where(['medicine' => '[\w-]+', 'loc' => 'ru|ua', 'act' => 'analogi|adaptinaya-instrukcija|chastye-voprosy']);
//Route::get('preparat/{loc}/{medicine}/analog', 'MainController@analog')->name('medicine_analog')->where(['medicine' => '[\w-]+', 'loc' => 'ru|ua']);
//Route::get('preparat/{loc}/{medicine}/adaptive', 'MainController@adaptive')->name('medicine_adaptive')->where(['medicine' => '[\w-]+', 'loc' => 'ru|ua']);
//Route::get('preparat/{loc}/{medicine}/faq', 'MainController@faqMed')->name('medicine_faq')->where(['medicine' => '[\w-]+', 'loc' => 'ru|ua']);




Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/', 'Admin\IndexController@show')->name('admin');

    /**
     *   Admin TAGS
     */
    Route::group(['prefix' => 'tags'], function () {
        Route::match(['get', 'post'], '/', ['uses' => 'Admin\TagsController@store', 'as' => 'tags_admin']);
        Route::match(['get', 'post'], 'edit/{tag}', ['uses' => 'Admin\TagsController@edit', 'as' => 'edit_tags'])->where('tag', '[0-9]+');
        Route::get('delete/{tag}', ['uses' => 'Admin\TagsController@destroy', 'as' => 'delete_tag'])->where('tag', '[0-9]+');
    });


    /**
     *   Admin USERS
     */
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', 'Admin\UsersController@show')->name('users_admin');
        Route::match(['get', 'post'], 'edit/{user}', ['uses' => 'Admin\UsersController@edit', 'as' => 'users_update'])->where('user', '[0-9]+');
        Route::match(['get', 'post'], 'create', 'Admin\UsersController@store')->name('users_create');
        Route::get('del/{user}', ['uses' => 'Admin\UsersController@destroy', 'as' => 'delete_user'])->where('user', '[0-9]+');
    });
});
//Auth
Route::get('login', 'Auth\AuthController@showLoginForm')->name('login');
Route::post('login', 'Auth\AuthController@login');
Route::post('logout', 'Auth\AuthController@logout')->name('logout');

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/reset', 'Auth\PasswordController@reset');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get(' password/reset/{token}', 'Auth\PasswordController@showResetForm')->name('password.reset');