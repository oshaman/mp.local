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

Route::get('/{loc?}', 'IndexController@main')->name('main')->where(['loc' => 'ua']);

Route::get('reklama/{loc?}', 'MainController@adv')->name('adv');
Route::get('onas/{loc?}', 'MainController@about')->name('about');
Route::get('soglashenie/{loc?}', 'MainController@convention')->name('convention');
Route::get('usloviya/{loc?}', 'MainController@conditions')->name('conditions');

Route::match(['get', 'post'], 'main', 'MainController@index');

Route::get('preparat/{medicine}/{loc?}', 'MedicineController@medicine')
    ->name('medicine')
    ->where(['medicine' => '[\w-]+', 'loc' => 'ua']);


Route::get('preparat/{medicine}/analog/{loc?}', 'MedicineController@analog')
    ->name('medicine_analog')->where(['medicine' => '[\w-]+', 'loc' => 'ua']);
Route::get('preparat/{medicine}/official/{loc?}', 'MedicineController@official')->name('medicine_official')
    ->where(['medicine' => '[\w-]+', 'loc' => 'ua']);
Route::get('preparat/{medicine}/faq/{loc?}', 'MedicineController@faq')
    ->name('medicine_faq')->where(['medicine' => '[\w-]+', 'loc' => 'ua']);
Route::get('preparat/{medicine}/print/{vr}/{loc?}', 'MedicineController@toprint')->name('toprint')
    ->where(['medicine' => '[\w-]+', 'vr' => 'main|adaptive', 'loc' => 'ua']);
/**
 * SEARCH
 */
Route::group(['prefix' => 'sort'], function () {
    Route::get('/', 'SearchController@show')->name('sort');

    Route::group(['prefix' => 'alfavit'], function () {
        Route::get('/{val?}', 'SearchController@alpha')->name('search_alpha')->where(['val' => '[\wа-яА-Яё-]+']);
        Route::get('ua/{val?}', 'SearchController@alphau')
            ->name('search_alpha_u')->where(['val' => '[\wа-яА-Яё-]+']);
    });

    Route::group(['prefix' => 'proizvoditel'], function () {
        Route::get('/{val?}/{fabricator?}', 'SearchController@fabricator')
            ->name('search_fabricator')->where(['val' => '[\wа-яА-Яё]+', 'fabricator' => '[\w-]+']);
        Route::get('/ua/{val?}/{fabricator?}', 'SearchController@fabricatoru')
            ->name('search_fabricatoru')->where(['val' => '[\wа-яА-Яё]+', 'fabricator' => '[\w-]+']);
    });

    Route::group(['prefix' => 'mnn'], function () {
        Route::get('/{val?}', 'SearchController@mnn')
            ->name('search_mnn')->where(['val' => '[\w-]+']);
        Route::get('/ua/{val?}', 'SearchController@mnnu')
            ->name('search_mnnu')->where(['val' => '[\w-]+']);
    });

    Route::group(['prefix' => 'atx'], function () {
        Route::get('/{val?}', 'SearchController@atx')->name('search_atx')->where(['val' => '[\w]+']);
        Route::get('/ua/{val?}', 'SearchController@atxa')->name('search_atxa')->where(['val' => '[\w]+']);

    });
    Route::group(['prefix' => 'farm-gruppa'], function () {
        Route::get('/{val?}', 'SearchController@farm')->name('search_farm')->where(['val' => '[\w-]+']);
        Route::get('/ua/{val?}', 'SearchController@farmu')->name('search_farmu')->where(['val' => '[\w-]+']);
    });
    Route::group(['prefix' => 'veshestvo'], function () {
        Route::get('/{val?}', 'SearchController@substance')->name('search_substance')->where(['val' => '[\w-]+']);
        Route::get('/ua/{val?}', 'SearchController@substanceu')->name('search_substanceu')->where(['val' => '[\w-]+', 'loc' => 'ua']);
    });

});

Route::match(['get', 'post'], 'poisk/{loc?}', 'SearchController@search')
    ->name('search')->where(['loc' => 'ua']);

/**
 * Articles
 */
Route::group(['prefix' => 'statjі'], function () {
    Route::get('/{article_alias?}/{loc?}', 'ArticlesController@show')->name('articles')->where(['loc' => 'ua', 'article_alias' => '[\w-]+']);
    Route::get('/cat/{cat_alias}/{loc?}', 'ArticlesController@cats')->name('articles_cat')->where(['loc' => 'ua', 'cat_alias' => '[\w-]+']);
    Route::get('/teg/{tag_alias}/{loc?}', 'ArticlesController@tag')
        ->name('articles_tag')->where(['loc' => 'ua', 'tag_alias' => '[\w-]+']);
//    Route::get();
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
        Route::match(['get', 'post'], 'edit/{spec}/{article_id}', ['uses' => 'Admin\ArticlesController@edit', 'as' => 'edit_article'])
            ->where(['article_id' => '[0-9]+', 'spec' => 'ru|ua']);
        Route::get('del/{article}', ['uses' => 'Admin\ArticlesController@del', 'as' => 'delete_article'])->where('article', '[0-9]+');

    });

    /**
     * Category
     */
    Route::group(['prefix' => 'cats'], function () {
        Route::match(['get', 'post'], '/', ['uses' => 'Admin\CategoryController@show', 'as' => 'cats']);
        Route::match(['get', 'post'], 'edit/{cat}', ['uses' => 'Admin\CategoryController@edit', 'as' => 'edit_cats'])->where('cat', '[0-9]+');
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
     * Slider 1
     */
    Route::match(['post', 'get'], 'mainslider/{mainslider?}', 'Admin\SlidersController@updateSlider')
        ->name('main_slider')->where('mainslider', '[0-9]+');
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

    /**
     * Static
     */
    Route::group(['prefix' => 'static'], function () {
        Route::get('/', 'Admin\StaticsController@show');
        Route::match(['get', 'post'], 'adv/{adv?}', 'Admin\StaticsController@updateAdv')->name('adv_admin')->where('adv', '[0-9]+');
        Route::post('delimg', 'Admin\StaticsController@delimg');
//        AboutUs
        Route::match(['get', 'post'], 'about', 'Admin\StaticsController@updateAbout')->name('about_admin');
    });
    /**
     * Main
     */
    Route::get('main-admin', 'Admin\MainController@show')->name('main_admin');
    /**
     * Admin SEO
     */
    Route::group(['prefix' => 'seo'], function () {
        Route::get('/', 'Admin\SeoController@index')->name('seo_admin');
        Route::match(['post', 'get'], 'edit/{seo}', 'Admin\SeoController@edit')->name('seo_update')->where('seo', '[0-9]+');
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