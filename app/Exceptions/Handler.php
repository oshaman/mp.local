<?php

namespace Fresh\Medpravda\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Menu;
use Cache;
use Fresh\Medpravda\Menu as Menus;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
//        \Illuminate\Session\TokenMismatchException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof \Illuminate\Session\TokenMismatchException) {

            return redirect()
                ->back()
                ->withInput($request->except('_token'))
                ->withErrors('Время Вашей сессии истекло, повторите запрос.');

        }

        if ($this->isHttpException($exception)) {
            $statusCode = $exception->getStatusCode();

            switch ($statusCode) {
                case '404' :
                    $header = Cache::remember('ru_menu_404', 60, function () {
                        $themes = $this->getThemes();
                        $block = \Fresh\Medpravda\Block::where('id', 1)->first();
                        $cats = $this->getMenu();
                        return view('layouts.header.404ru')
                            ->with(['block' => $block, 'menu' => $cats, 'themes' => $themes])->render();
                    });

                    $tags = \Fresh\Medpravda\Tag::select(['name', 'alias'])
                        ->where(['approved' => 1])->skip(15)->take(15)->get();
                    $all_cats = Cache::remember('main_cats', 24 * 60, function () {
                        return \Fresh\Medpravda\Category::get();
                    });

                    $med_tags = Cache::remember('med-tags', 24 * 60, function () {
                        $meds = \Fresh\Medpravda\Medtag::take(14)->get();
                        return \Fresh\Medpravda\Medicine::select('title', 'alias')->whereIn('alias', $meds->toArray())
                            ->get();
                    });

                    $copyright = Cache::remember('copyright', 24 * 60, function () {
                        return \Fresh\Medpravda\About::find(7);
                    });
                    $footer = view('layouts.footer.ru')
                        ->with(['cats' => $all_cats, 'tags' => $tags, 'med_tags' => $med_tags, 'copyright' => $copyright])
                        ->render();

                    return response()->view('errors.404',
                        ['header' => $header, 'footer' => $footer], 404);

            }
        }

        return parent::render($request, $exception);
    }

    /**
     * @param $status
     * @return mixed
     */
    public function getMenu($status = false)
    {
        if ($status) {
            $cats = Menus::with('category')->where('own', 'ua')->get();
        } else {
            $cats = Menus::with('category')->where('own', 'ru')->get();
        }

        return Menu::make('menu', function ($menu) use ($cats, $status) {
            foreach ($cats as $cat) {
                $route = $status ? 'ua_' : '';
                $title = $status ? 'u' : '';
                $menu->add(str_limit($cat->category->{$title . 'title'}, 32), ['route' => [$route . 'articles_cat', $cat->category->alias]]);
            }
        });
    }

    /**
     * @param bool $status
     * @return mixed
     */
    public function getThemes($status = false)
    {
        if ($status) {
            $themes = \Fresh\Medpravda\Toptheme::select('title', 'link')->where([['approved', 1], ['loc', 'ua']])
                ->orderBy('priority', 'asc')->take(8)->get();
        } else {
            $themes = \Fresh\Medpravda\Toptheme::select('title', 'link')->where([['approved', 1], ['loc', 'ru']])
                ->orderBy('priority', 'asc')->take(8)->get();
        }

        return Menu::make('themes', function ($menu) use ($themes) {
            foreach ($themes as $cat) {
                $menu->add(str_limit($cat->title, 32))->link->href($cat->link);;
            }
        });
    }
}
