<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            @if('adv_admin' == Route::currentRouteName())
                <li><a class="btn btn-default">Страница рекламы</a></li>
            @else
                <li><a href="{{ route('adv_admin') }}">Страница рекламы</a></li>
            @endif
            @if('about_admin' == Route::currentRouteName())
                <li><a class="btn btn-default">О Нас</a></li>
            @else
                <li><a href="{{ route('about_admin') }}">О Нас</a></li>
            @endif
            @if('seo_admin' == Route::currentRouteName())
                <li><a class="btn btn-default">SEO</a></li>
            @else
                <li><a href="{{ route('seo_admin') }}">SEO</a></li>
            @endif
        </ul>
    </div>
</nav>