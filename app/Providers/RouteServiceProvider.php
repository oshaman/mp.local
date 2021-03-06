<?php

namespace Fresh\Medpravda\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Fresh\Medpravda\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        Route::model('tag', \Fresh\Medpravda\Tag::class);
        Route::model('atx', \Fresh\Medpravda\Classification::class);
        Route::model('pharm', \Fresh\Medpravda\Pharmagroup::class);
        Route::model('fabricator_bind', \Fresh\Medpravda\Fabricator::class);
        Route::model('med_tag', \Fresh\Medpravda\Medtag::class);
        Route::model('med_cat', \Fresh\Medpravda\MedicinesCat::class);
        Route::model('cat', \Fresh\Medpravda\Category::class);
        Route::model('block', \Fresh\Medpravda\Block::class);
        Route::model('article', \Fresh\Medpravda\Article::class);
//        Route::model('medicine', \Fresh\Medpravda\Medicine::class);
        Route::model('seo', \Fresh\Medpravda\Seo::class);
        Route::model('theme', \Fresh\Medpravda\Toptheme::class);
        Route::model('substance', \Fresh\Medpravda\Substance::class);
        Route::model('inn', \Fresh\Medpravda\Innname::class);

        Route::bind('article_alias', function ($value, \Illuminate\Routing\Route $route) {
            return \Fresh\Medpravda\Article::where('alias', $value)->first();
        });

        Route::bind('ua_article_alias', function ($value) {
            return \Fresh\Medpravda\UArticle::where('alias', $value)->first();
        });
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}
