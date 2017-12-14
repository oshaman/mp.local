<!-- HEADER -->
<header>
    <div class="wrap">
        <div class="logo">
            @if('main' == Route::currentRouteName())
                <img src="{{ asset('assets') }}/images/main/logo_ru.png" alt="Логотип МЕД правда"></a>
            @else
                <a href="{{ route('main') }}">
                    <img src="{{ asset('assets') }}/images/main/logo_ru.png" alt="Логотип МЕД правда"></a>
            @endif
        </div>
        <div class="search">
            <input autocomplete="off" type="search" name="search" class="search-placeholder"
                   placeholder="Поиск по сайту">
            <input type="hidden" name="stats">
            <div class="wrap-search"></div>
            <span class="img-search"></span>
        </div>
        <div class="main-menu">
            <nav class="mobile-display-none">
                <div>
                    @if('search_alpha' == Route::currentRouteName())
                        <div><a>Препараты</a></div>
                    @else
                        <div><a href="{{ route('search_alpha') }}">Препараты</a></div>
                    @endif
                </div>
                <div>
                    @if('themes' == Route::currentRouteName())
                        <div><a>Популярные темы</a></div>
                    @else
                        <div><a href="{{ route('themes') }}">Популярные темы</a></div>
                    @endif
                </div>
                <div>
                    @if('top_articles' == Route::currentRouteName())
                        <div><a>Топ статьи</a></div>
                    @else
                        <div><a href="{{ route('top_articles') }}">Топ статьи</a></div>
                    @endif
                </div>
                <div>
                    @if('articles' == Route::currentRouteName() && null == Request::segment(2))
                        <div><a>Свежие статьи</a></div>
                        <div>{!! $menu->asUl() !!}</div>
                    @else
                        <div><a href="{{ route('articles') }}">Свежие статьи</a></div>
                        <div>{!! $menu->asUl() !!}</div>
                    @endif
                </div>
                <div>
                    @if('adv' == Route::currentRouteName())
                        <div><a>Реклама</a></div>
                    @else
                        <div><a href="{{ route('adv') }}">Реклама</a></div>
                    @endif
                </div>
            </nav>
            <a class="burgerBtn">
                <span></span>
            </a>
        </div>
        <div class="lang-menu mobile-display-none">
            <span class="active">Рус</span>
            <a href="{{ str_replace(env('APP_URL'), env('APP_URL').'/ua', Request::url()) }}">Укр</a>
        </div>
    </div>
</header>
<section class="top-meta-section">
    <div class="wrap">
        <div class="top-meta mobile-display-none">
            <span class="meta-title">
                {{ $block->title ?? '' }}
            </span>
            @if(!empty($block->first))
                {{ link_to_route('search', $block->first, ['search' =>$block->first], ['class'=>'btn-meta']) }}
            @endif
            @if(!empty($block->second))
                {{ link_to_route('search', $block->second, ['search' =>$block->second], ['class'=>'btn-meta']) }}
            @endif
            @if(!empty($block->third))
                {{ link_to_route('search', $block->third, ['search' =>$block->third], ['class'=>'btn-meta']) }}
            @endif
        </div>
        <div class="search">
            {!! Form::open(['url'=>route('search'), 'method'=>'post']) !!}
            <input autocomplete="off" type="search" name="search" class="search-placeholder"
                   placeholder="Поиск по сайту">
            <input type="hidden" name="stats">
            <div class="wrap-search"></div>
            {{ Form::close() }}
            <span class="img-search"></span>
        </div>
    </div>
</section>
<!-- end HEADER -->