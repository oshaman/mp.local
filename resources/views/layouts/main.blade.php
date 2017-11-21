<!DOCTYPE html>
<html lang="ru">
<head>
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