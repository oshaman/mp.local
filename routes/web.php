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

Route::group(['prefix' => 'ua'], function () {
    Route::group(['prefix' => 'sort'], function () {
//        SORT ===============================>
//        alpha
        Route::get('/alfavit/{val?}', 'SearchController@alphau')
            ->name('search_alpha_u')->where(['val' => '[\wа-яА-Яё-]+']);
//      fabric
        Route::get('/proizvoditel/{val?}/{fabricator?}', 'SearchController@fabricatoru')
            ->name('search_fabricator_u')->where(['val' => '[\wа-яА-Яё]+', 'fabricator' => '[\w-]+']);
//        mnn
        Route::get('/mnn/{val?}', 'SearchController@mnnu')->name('search_mnn_u')->where(['val' => '[\w-]+']);
//        atx
        Route::get('/atx/{val?}', 'SearchController@atxu')->name('search_atx_u')->where(['val' => '[\w]+']);
//      pharm
        Route::get('/farm-gruppa/{val?}', 'SearchController@farmu')->name('search_farm_u')->where(['val' => '[\w-]+']);

//      substance
        Route::get('/veshestvo/{val?}', 'SearchController@substanceu')->name('search_substance_u')->where(['val' => '[\w-]+', 'loc' => 'ua']);
    });
//        SORT ===============================>
//        MEDICINE ===============================>
    Route::get('preparat/{medicine}', 'MedicineController@medicineUa')
        ->name('medicine_ua')->where(['medicine' => '[\w-]+']);
    Route::get('preparat/{medicine}/analog', 'MedicineController@analogUa')
        ->name('medicine_analog_ua')->where(['medicine' => '[\w-]+']);
    Route::get('preparat/{medicine}/official', 'MedicineController@officialUa')->name('medicine_official_ua')
        ->where(['medicine' => '[\w-]+']);
    Route::get('preparat/{medicine}/faq', 'MedicineController@faqUa')
        ->name('medicine_faq_ua')->where(['medicine' => '[\w-]+']);
    Route::get('preparat/{medicine}/print/{vr}', 'MedicineController@toprintUa')->name('toprint_ua')
        ->where(['medicine' => '[\w-]+', 'vr' => 'main|adaptive']);
//        MEDICINE ===============================>
//        ARTICLES ===============================>
    Route::group(['prefix' => 'statjі'], function () {
        Route::get('/{ua_article_alias?}', 'ArticlesController@uaShow')->name('ua_articles')->where(['ua_article_alias' => '[\w-]+']);
        Route::get('/cat/{cat_alias}', 'ArticlesController@uaCats')->name('ua_articles_cat')->where(['cat_alias' => '[\w-]+']);
        Route::get('/teg/{tag_alias}', 'ArticlesController@uaTag')
            ->name('ua_articles_tag')->where(['tag_alias' => '[\w-]+']);
    });
//        SEARCH ===============================>
    Route::match(['get', 'post'], 'poisk/{val?}', 'SearchController@search')->where(['val' => '[\wа-яА-ЯёЁІіЇЇ\'-]+']);
//        SEARCH ===============================>


});


Route::match(['get', 'post'], 'main', 'MainController@index');

Route::get('preparat/{medicine}', 'MedicineController@medicine')
    ->name('medicine')
    ->where(['medicine' => '[\w-]+']);


Route::get('preparat/{medicine}/analog', 'MedicineController@analog')
    ->name('medicine_analog')->where(['medicine' => '[\w-]+']);
Route::get('preparat/{medicine}/official', 'MedicineController@official')->name('medicine_official')
    ->where(['medicine' => '[\w-]+', 'loc' => 'ua']);
Route::get('preparat/{medicine}/faq', 'MedicineController@faq')
    ->name('medicine_faq')->where(['medicine' => '[\w-]+']);
Route::get('preparat/{medicine}/print/{vr}', 'MedicineController@toprint')->name('toprint')
    ->where(['medicine' => '[\w-]+', 'vr' => 'main|adaptive']);
/**
 * SEARCH
 */
Route::group(['prefix' => 'sort'], function () {
    Route::get('/', 'SearchController@show')->name('sort');

    Route::get('/alfavit/{val?}', 'SearchController@alpha')->name('search_alpha')->where(['val' => '[\wа-яА-Яё-]+']);

    Route::get('/proizvoditel/{val?}/{fabricator?}', 'SearchController@fabricator')
        ->name('search_fabricator')->where(['val' => '[\wа-яА-Яё]+', 'fabricator' => '[\w-]+']);

    Route::get('/mnn/{val?}', 'SearchController@mnn')->name('search_mnn')->where(['val' => '[\w-]+']);

    Route::get('/atx/{val?}', 'SearchController@atx')->name('search_atx')->where(['val' => '[\w]+']);

    Route::get('/farm-gruppa/{val?}', 'SearchController@farm')->name('search_farm')->where(['val' => '[\w-]+']);

    Route::get('/veshestvo/{val?}', 'SearchController@substance')->name('search_substance')->where(['val' => '[\w-]+']);

});

Route::match(['get', 'post'], 'poisk/{val?}', 'SearchController@search')
    ->name('search')->where(['val' => '[\wа-яА-ЯёЁІіЇЇ\'-]+']);
Route::match(['get', 'post'], 'presearch', 'SearchController@presearch')->name('presearch');

/**
 * Articles
 */
Route::group(['prefix' => 'statjі'], function () {
    Route::get('/{article_alias?}', 'ArticlesController@show')->name('articles')->where(['article_alias' => '[\w-]+']);
    Route::get('/cat/{cat_alias}', 'ArticlesController@cats')->name('articles_cat')->where(['cat_alias' => '[\w-]+']);
    Route::get('/teg/{tag_alias}', 'ArticlesController@tag')
        ->name('articles_tag')->where(['tag_alias' => '[\w-]+']);
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