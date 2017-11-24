<!DOCTYPE html>
<html lang="ru">
<head>
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
            {{ $title ? ($title.' - '. env('APP_NAME')) : env('APP_NAME') }}
        @endif
    </title>
    <meta charset="UTF-8">
    <title>Мед правда | Вся правда о препаратах</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
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
<div id="product-official-instruction" class="main-wrapper main-page">
    @yield('header')

    @yield('content')
    @yield('aside')

    @yield('footer')

</div><!-- end WRAP -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="{{ asset('assets') }}/js/slick.min.js"></script>
<script type="text/javascript" src="{{ asset('assets') }}/js/slider.js"></script>
<script type="text/javascript" src="{{ asset('assets') }}/js/accordion.js"></script>
<script type="text/javascript" src="{{ asset('assets') }}/js/menu.js"></script>
<script type="text/javascript" src="{{ asset('assets') }}/js/clone.js"></script>
@yield('jss')
</body>
</html>