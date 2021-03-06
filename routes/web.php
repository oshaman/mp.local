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

Route::get('reklama', 'MainController@adv')->name('adv');
Route::get('onas', 'MainController@about')->name('about');
Route::get('soglashenie', 'MainController@convention')->name('convention');
Route::get('usloviya', 'MainController@conditions')->name('conditions');

Route::group(['prefix' => 'ua'], function () {
    Route::get('/reklama', 'MainController@uaAdv')->name('ua_adv');
    Route::get('/onas', 'MainController@uaAbout')->name('ua_about');

    Route::get('/soglashenie', 'MainController@uaConvention')->name('ua_convention');
    Route::get('/usloviya', 'MainController@uaConditions')->name('ua_conditions');


    Route::get('/top-themes', 'ThemesController@uaThemes')->name('ua_themes');

    Route::get('/top-articles', 'ArticlesController@topUarticles')->name('ua_top_articles');
//        SORT ===============================>
    Route::group(['prefix' => 'sort'], function () {
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
    Route::group(['prefix' => 'fresh-articles'], function () {
        Route::get('/{ua_article_alias?}', 'ArticlesController@uaShow')->name('ua_articles')->where(['ua_article_alias' => '[\w-]+']);
        Route::get('cat/{cat_alias}', 'ArticlesController@uaCats')->name('ua_articles_cat')->where(['cat_alias' => '[\w-]+']);
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

Route::get('/top-themes', 'ThemesController@themes')->name('themes');

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

Route::get('/top-articles', 'ArticlesController@topArticles')->name('top_articles');
/**
 * Articles
 */
Route::group(['prefix' => 'fresh-articles'], function () {
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
//    SEO ANALOG
    Route::match(['post', 'get'], 'seo-analog/{medicine}', 'Admin\AnalogController@updateSeo')
        ->name('seo_analog')->where('medicine', '[0-9]+');
    Route::match(['post', 'get'], 'seo-faq/{medicine}', 'Admin\FaqController@updateSeo')
        ->name('seo_faq')->where('medicine', '[0-9]+');


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
//        convention
        Route::match(['get', 'post'], 'convention', 'Admin\StaticsController@updateConvention')->name('convention_admin');
//        conditions
        Route::match(['get', 'post'], 'conditions', 'Admin\StaticsController@updateConditions')->name('conditions_admin');
//        footer copyright
        Route::match(['get', 'post'], 'copyright', 'Admin\StaticsController@updateCopyright')->name('footer_copyright_admin');

    });
    /**
     * Main
     */
    Route::get('main-admin', 'Admin\MainController@show')->name('main_admin');
    /**
     * Statistic
     */
    Route::group(['prefix' => 'statistics'], function () {
        Route::match(['post', 'get'], 'medicine', 'Admin\StatisticController@medicine')->name('stats_medicine');
        Route::match(['post', 'get'], 'class', 'Admin\StatisticController@class')->name('stats_class');
//        Route::match(['post', 'get'], 'get-atx', 'Admin\StatisticController@downloadClass')->name('download_atx');
//        Route::match(['post', 'get'], 'atx-charts', 'Admin\StatisticController@showCharts')->name('charts_atx');
    });
    /**
     * Admin SEO
     */
    Route::group(['prefix' => 'seo'], function () {
        Route::get('/', 'Admin\SeoController@index')->name('seo_admin');
        Route::match(['post', 'get'], 'edit/{seo}', 'Admin\SeoController@edit')->name('seo_update')->where('seo', '[0-9]+');
    });
    /**
     * Admin ATX
     */
    Route::group(['prefix' => 'atx'], function () {
        Route::match(['post', 'get'], '/', 'Admin\ClassificationsController@index')->name('atx_admin');
        Route::match(['post', 'get'], 'edit/{atx}', 'Admin\ClassificationsController@updateAtx')->name('atx_update')->where('atx', '[0-9]+');
    });
    /**
     * Admin PHARMGROUP
     */
    Route::group(['prefix' => 'pharm'], function () {
        Route::match(['post', 'get'], '/', 'Admin\PharmController@index')->name('pharm_admin');
        Route::match(['post', 'get'], 'edit/{pharm}', 'Admin\PharmController@updatePharm')
            ->name('pharm_update')->where('pharm', '[0-9]+');
        Route::match(['post', 'get'], 'seo/{pharm}', 'Admin\PharmController@updateSeo')
            ->name('pharm_seo_update')->where('pharm', '[0-9]+');
    });

    /**
     * Admin SUBSTANCE
     */
    Route::group(['prefix' => 'substance'], function () {
        Route::match(['post', 'get'], '/', 'Admin\SubstanceController@show')->name('substance_admin');
        Route::match(['post', 'get'], 'edit/{substance}', 'Admin\SubstanceController@update')
            ->name('substance_update')->where('substance', '[0-9]+');
        Route::match(['post', 'get'], 'seo/{substance}', 'Admin\SubstanceController@updateSeo')
            ->name('substance_seo_update')->where('substance', '[0-9]+');
    });
    /**
     * Admin INN
     */
    Route::group(['prefix' => 'inn'], function () {
        Route::match(['post', 'get'], '/', 'Admin\InnController@show')->name('inn_admin');
        Route::match(['post', 'get'], 'edit/{inn}', 'Admin\InnController@update')
            ->name('inn_update')->where('inn', '[0-9]+');
        Route::match(['post', 'get'], 'seo/{inn}', 'Admin\InnController@updateSeo')
            ->name('inn_seo_update')->where('inn', '[0-9]+');
    });
    /**
     * Admin FABRICATORS
     */
    Route::group(['prefix' => 'fabricator'], function () {
        Route::match(['post', 'get'], '/', 'Admin\FabricatorsController@index')->name('fabricator_admin');
        Route::match(['get', 'post'], 'create', ['uses' => 'Admin\FabricatorsController@store', 'as' => 'fabricator_create']);
        Route::match(['post', 'get'], 'edit/{fabricator_bind}', 'Admin\FabricatorsController@updateFabricator')
            ->name('fabricator_update')->where('fabricator_bind', '[0-9]+');
        Route::match(['post', 'get'], 'seo/{fabricator_bind}', 'Admin\FabricatorsController@updateSeo')
            ->name('fabricator_seo_update')->where('fabricator_bind', '[0-9]+');
    });
    /**
     * Med Tags
     */
    Route::group(['prefix' => 'med-teg'], function () {
        Route::match(['get', 'post'], '/', ['uses' => 'Admin\MedtagController@store', 'as' => 'med_tags_admin']);
        Route::get('delete/{med_tag}', ['uses' => 'Admin\MedtagController@destroy', 'as' => 'delete_medtag'])->where('med_tag', '[0-9]+');
    });
    /**
     * Themes
     */
    Route::group(['prefix' => 'topthemes'], function () {

        Route::get('/', ['uses' => 'Admin\ThemesController@index', 'as' => 'themes_admin']);
        Route::match(['get', 'post'], 'create', ['uses' => 'Admin\ThemesController@createTheme', 'as' => 'themes_add']);
        Route::match(['get', 'post'], 'edit/{theme}', ['uses' => 'Admin\ThemesController@edit', 'as' => 'themes_update'])
            ->where(['theme' => '[0-9]+']);
        Route::get('del/{theme}', ['uses' => 'Admin\ThemesController@del', 'as' => 'delete_theme'])->where('theme', '[0-9]+');

    });
    /**
     * Admin Menus
     */
    Route::match(['post', 'get'], 'menus', 'Admin\MenusController@index')->name('menus');

    Route::get('test', 'Admin\StatisticController@test');
});
//Auth
Route::get('login', 'Auth\AuthController@showLoginForm')->name('login');
Route::post('login', 'Auth\AuthController@login');
Route::post('logout', 'Auth\AuthController@logout')->name('logout');

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/reset', 'Auth\PasswordController@reset');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\PasswordController@showResetForm')->name('password.reset');