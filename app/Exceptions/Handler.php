<?php

namespace Fresh\Medpravda\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Session\TokenMismatchException::class,
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
        if ($this->isHttpException($exception)) {
            $statusCode = $exception->getStatusCode();

            switch ($statusCode) {
                case '404' :

                    $block = \Fresh\Medpravda\Block::where('id', 1)->first();
                    $cats = \Fresh\Medpravda\Category::get();
                    $header = view('layouts.header.ru')->with(['block' => $block, 'cats' => $cats])->render();

                    $tags = \Fresh\Medpravda\Tag::select(['name', 'alias'])
                        ->where(['approved' => 1])->skip(15)->take(15)->get();
                    $footer = view('layouts.footer.ru')->with(['cats' => $cats, 'tags' => $tags])->render();

                    return response()->view('errors.404',
                        ['header' => $header, 'footer' => $footer], 404);
            }
        }

        return parent::render($request, $exception);
    }
}
