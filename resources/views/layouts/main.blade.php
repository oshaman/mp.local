<!DOCTYPE html>
<html lang="ru">
<head>
    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-5SZ98T6');</script>
    <!-- End Google Tag Manager -->
    @if('ua' == Request::segment(1))
        <link rel="alternate" href="{{ env('APP_URL') }}/ua/" hreflang="x-default"/>
        <link rel="alternate" href="{{ env('APP_URL') }}" hreflang="ru"/>
    @else
        <link rel="alternate" href="{{ env('APP_URL') }}" hreflang="x-default"/>
        <link rel="alternate" href="{{ env('APP_URL') }}/ua/" hreflang="uk-UA"/>
    @endif
    @if(!empty($seo->seo_keywords))
        <meta name="keywords" content="{{ $seo->seo_keywords }}">
    @endif
    @if(!empty($seo->seo_description))
        <meta name="description" content="{{ $seo->seo_description }}">
    @endif
    @if(!empty($seo->og_title))
        <meta property="og:title" content="{{ $seo->og_title }}"/>
    @endif
    @if(!empty($seo->og_description))
        <meta property="og:description" content="{{ $seo->og_description }}"/>
    @endif
    <meta property="og:url" content="{{ url()->current() }}"/>
    @if(!empty($seo->og_image))
        <meta property="og:image" content="{{ $seo->og_image }}"/>
    @endif
    <title>
        @if(!empty($seo->seo_title))
            {{ $seo->seo_title . ' - ' . env('APP_NAME') }}
        @else
            {{ $title ?? env('APP_NAME') }}
        @endif
    </title>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <link href="{{ asset('/') }}favicon.png" rel="shortcut icon">
    <link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond:700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/font-awesome.min.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/fonts.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/reklama-body.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/slick.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/fresh.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/style.css">
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5SZ98T6"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
<!-- REKLAMA BODY -->
<div class="body-promotion desktop">
    <img src="{{ asset('assets') }}/images/promotion/body-rek.jpg" alt="">
</div>
<div class="body-promotion tablet">
    <img src="{{ asset('assets') }}/images/promotion/body-rek-tablet.jpg" alt="">
</div>
<div class="body-promotion mobile clone-from" data-number="1">
    <img src="{{ asset('assets') }}/images/promotion/body-rek-mob.jpg" alt="">
</div>
<!-- end REKLAMA BODY -->
<!-- WRAP -->
<div class="main-wrapper
        @if('main' == Route::currentRouteName()) main-page @endif
@if(('articles' == Route::currentRouteName()) || ('ua_articles' == Route::currentRouteName())) single-article @endif
@if(('articles_cat' == Route::currentRouteName()) || ('ua_articles_cat' == Route::currentRouteName())) articles @endif
        ">
    @yield('header')

    @yield('content')
    @yield('aside')
    @yield('slider')

    @yield('footer')

</div><!-- end WRAP -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="{{ asset('assets') }}/js/slick.min.js"></script>
<script type="text/javascript" src="{{ asset('assets') }}/js/slider.js"></script>
<script type="text/javascript" src="{{ asset('assets') }}/js/accordion.js"></script>
<script type="text/javascript" src="{{ asset('assets') }}/js/menu.js"></script>
<script type="text/javascript" src="{{ asset('assets') }}/js/totop.js"></script>
@yield('jss')
</body>
</html>