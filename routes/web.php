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

Route::get('/', 'IndexController@main')->name('main');
Route::get('reklama/{loc?}', 'MainController@adv')->name('adv');
Route::get('onas/{loc?}', 'MainController@about')->name('about');

Route::match(['get', 'post'], 'main', 'MainController@index');

Route::get('preparat/{loc}/{medicine}/{act?}', 'MedicineController@medicine')
    ->name('medicine')
    ->where(['medicine' => '[\w-]+', 'loc' => 'ru|ua', 'act' => 'analogi|adaptinaya-instrukcija|chastye-voprosy']);
Route::get('preparat/{loc}/{medicine}/analog', 'MedicineController@analog')->name('medicine_analog')->where(['medicine' => '[\w-]+', 'loc' => 'ru|ua']);
Route::get('preparat/{loc}/{medicine}/adaptive', 'MedicineController@adaptive')->name('medicine_adaptive')->where(['medicine' => '[\w-]+', 'loc' => 'ru|ua']);
Route::get('preparat/{loc}/{medicine}/faq', 'MedicineController@faq')->name('medicine_faq')->where(['medicine' => '[\w-]+', 'loc' => 'ru|ua']);

/**
 * SEARCH
 */
Route::group(['prefix' => 'poisk'], function () {
    Route::get('/', 'SearchController@show')->name('search');
    Route::get('/alfavit/{loc}/{val?}', 'SearchController@alpha')->name('search_alpha')->where(['val' => '[\wа-яА-Яё-]+', 'loc' => 'ru|ua']);
    Route::get('/proizvoditel/{loc}/{val?}/{fabricator?}', 'SearchController@fabricator')
        ->name('search_fabricator')->where(['val' => '[\wа-яА-Яё]+', 'loc' => 'ru|ua', 'fabricator' => '[\w-]+']);
    Route::get('/mnn/{loc}/{val?}', 'SearchController@mnn')->name('search_mnn')->where(['val' => '[\w-]+', 'loc' => 'ru|ua']);
    Route::get('/atx/{loc}/{val?}', 'SearchController@atx')->name('search_atx')->where(['val' => '[\w]+', 'loc' => 'ru|ua']);
    Route::get('/farm-gruppa/{loc}/{val?}', 'SearchController@farm')->name('search_farm')->where(['val' => '[\w-]+', 'loc' => 'ru|ua']);
    Route::get('/veshestvo/{loc}/{val?}', 'SearchController@substance')->name('search_substance')->where(['val' => '[\w-]+', 'loc' => 'ru|ua']);
});

/**
 * Articles
 */
Route::group(['prefix' => 'statjі'], function () {
    Route::get('/', 'ArticlesController@show')->name('articles');
});
/**
 * Category
 */
Route::group(['prefix' => 'cats'], function () {
    Route::match(['get', 'post'], '/', ['uses' => 'Admin\CategoryController@show', 'as' => 'cats']);
    Route::match(['get', 'post'], 'edit/{cat}', ['uses' => 'Admin\CategoryController@edit', 'as' => 'edit_cats'])->where('cat', '[0-9]+');
});


Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/', 'Admin\IndexController@show')->name('admin');

    /**
     *   Admin ARTICLES
     *
     */
    Route::group(['prefix' => 'articles'], function () {
        //  show articles list
        Route::get('/', ['uses' => 'Admin\ArticlesController@index', 'as' => 'articles_admin']);
        Route::match(['get', 'post'], 'create', ['uses' => 'Admin\ArticlesController@create', 'as' => 'create_article']);
        Route::match(['get', 'post'], 'edit/{spec}/{article}', ['uses' => 'Admin\ArticlesController@edit', 'as' => 'edit_article'])
            ->where(['article' => '[0-9]+', 'spec' => 'ru|ua']);
        Route::get('del/{article}', ['uses' => 'Admin\ArticlesController@del', 'as' => 'delete_article'])->where('article', '[0-9]+');

    });
    /**
     *   Admin TAGS
     */
    Route::group(['prefix' => 'tags'], function () {
        Route::match(['get', 'post'], '/', ['uses' => 'Admin\TagsController@store', 'as' => 'tags_admin']);
        Route::match(['get', 'post'], 'edit/{tag}', ['uses' => 'Admin\TagsController@edit', 'as' => 'edit_tags'])->where('tag', '[0-9]+');
        Route::get('delete/{tag}', ['uses' => 'Admin\TagsController@destroy', 'as' => 'delete_tag'])->where('tag', '[0-9]+');
    });
    /**
     * Medicine
     */
    Route::group(['prefix' => 'medicine'], function () {
        Route::get('/', ['uses' => 'Admin\MedicineController@index', 'as' => 'medicine_admin']);
        Route::match(['get', 'post'], 'create', ['uses' => 'Admin\MedicineController@create', 'as' => 'medicine_create']);
        Route::match(['get', 'post'], 'edit/{spec}/{medicine}',
            ['uses' => 'Admin\MedicineController@edit', 'as' => 'medicine_edit'])
            ->where(['medicine' => '[\w-]+', 'spec' => 'ru|ua|aru|aua']);
        Route::get('del/{medicine}', ['uses' => 'Admin\MedicineController@del', 'as' => 'medicine_delete'])->where('medicine', '[\w-]+');
        Route::post('slider', 'Admin\MedicineController@slider')->name('delete_slider');
        Route::match(['get', 'post'], 'faq/{spec}/{medicine}', 'Admin\MedicineController@faq')
            ->name('faq')->where(['medicine' => '[\w-]+', 'spec' => 'ru|ua']);

        Route::post('customs', 'Admin\MedicineController@customs');
        Route::post('save-custom', 'Admin\MedicineController@saveCustom')->name('get_custom');

    });
    Route::match(['post', 'get'], 'blocks/{block?}', 'Admin\BlocksController@updateBlocks')
        ->name('blocks')->where('block', '[0-9]+');
    /**
     * MedicinesCats
     */
    Route::match(['get', 'post'], 'medicine-cats/{med_cat?}', 'Admin\MedicinesCatsController@updateCats')
        ->name('medicine_cats')->where('med_cat', '[0-9]{1,5}');

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
Route::get('password/reset/{token}', 'Auth\PasswordController@showResetForm')->name('password.reset');