<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            @if('medicine_cats' == Route::currentRouteName())
                <li><a class="btn btn-default">Редактирование витрины препаратов</a></li>
            @else
                <li><a href="{{ route('medicine_cats') }}">Редактирование витрины препаратов</a></li>
            @endif
            @if('blocks' == Route::currentRouteName())
                <li><a class="btn btn-default">Блоки заголовков</a></li>
            @else
                <li><a href="{{ route('blocks') }}">Блоки заголовков</a></li>
            @endif
        </ul>
    </div>
</nav>