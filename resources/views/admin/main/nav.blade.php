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
            @if('main_slider' == Route::currentRouteName())
                <li><a class="btn btn-default">Главный слайдер</a></li>
            @else
                <li><a href="{{ route('main_slider') }}">Главный слайдер</a></li>
            @endif
            @if('med_tags_admin' == Route::currentRouteName())
                <li><a class="btn btn-default">Тэги-препараты</a></li>
            @else
                <li><a href="{{ route('med_tags_admin') }}">Тэги-препараты</a></li>
            @endif
        </ul>
    </div>
</nav>