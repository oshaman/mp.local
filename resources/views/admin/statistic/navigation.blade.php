<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            @if('stats_medicine' == Route::currentRouteName())
                <li><a class="btn btn-default">Статистика препаратов</a></li>
            @else
                <li><a href="{{ route('stats_medicine') }}">Статистика препаратов</a></li>
            @endif
            @if('stats_class' == Route::currentRouteName())
                <li><a class="btn btn-default">Статистика ATX</a></li>
            @else
                <li><a href="{{ route('stats_class') }}">Статистика ATX</a></li>
            @endif
        </ul>
    </div>
</nav>