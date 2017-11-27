<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            @if('adv_admin' == Route::currentRouteName())
                <li><a class="btn btn-default">Редактирование страницы рекламы</a></li>
            @else
                <li><a href="{{ route('adv_admin') }}">Редактирование страницы рекламы</a></li>
            @endif
        </ul>
    </div>
</nav>