<!-- HEADER -->
<header>
    <div class="wrap">
        <div class="logo">
            @if('main' == Route::currentRouteName())
                <img src="{{ asset('assets') }}/images/main/logo_ua.png" alt="Логотип МЕД правда">
            @else
                @if('ua' == Request::segment(1))
                    <a href="{{ route('main', ['loc'=>'ua']) }}">
                        @else
                            <a href="{{ route('main') }}">
                                @endif
                                <img src="{{ asset('assets') }}/images/main/logo_ua.png" alt="Логотип МЕД правда"></a>
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
        <div class="main-menu">
            <nav class="mobile-display-none">
                <div>
                    @if('search_alpha_u' == Route::currentRouteName())
                        <div class="primary-menu"><a>Препарати</a></div>
                    @else
                        <div class="primary-menu"><a href="{{ route('search_alpha_u') }}">Препарати</a></div>
                    @endif
                </div>
                <div>
                    @if('ua_themes' == Route::currentRouteName())
                        <div class="primary-menu"><a>Популярні теми</a></div>
                        <div class="sub-menu">{!! $themes->asUl() !!}</div>
                    @else
                        <div class="primary-menu"><a href="{{ route('ua_themes') }}">Популярні теми</a></div>
                        <div class="sub-menu">{!! $themes->asUl() !!}</div>
                    @endif
                </div>
                <div>
                    @if('ua_top_articles' == Route::currentRouteName())
                        <div class="primary-menu"><a>Топ статті</a></div>
                    @else
                        <div class="primary-menu"><a href="{{ route('ua_top_articles') }}">Топ статті</a></div>
                    @endif
                </div>
                <div>
                    @if('ua_articles' == Route::currentRouteName() && null == Request::segment(3))
                        <div class="primary-menu"><a>Свіжі статті</a></div>
                        <div class="sub-menu">{!! $cats->asUl() !!}</div>
                    @else
                        <div class="primary-menu"><a href="{{ route('ua_articles') }}">Свіжі статті</a></div>
                        <div class="sub-menu">{!! $cats->asUl() !!}</div>
                    @endif
                </div>
                <div>
                    @if('ua_adv' == Route::currentRouteName())
                        <div class="primary-menu"><a>Реклама</a></div>
                    @else
                        <div class="primary-menu"><a href="{{ route('ua_adv') }}">Реклама</a></div>
                    @endif
                </div>
            </nav>
            <a class="burgerBtn">
                <span></span>
            </a>
        </div>
        <div class="lang-menu mobile-display-none">
            <a href="{{  str_replace('/ua', '', Request::url()) }}">Рус</a>
            <span class="active">Укр</span>
        </div>
    </div>
</header>
<section class="top-meta-section">
    <div class="wrap">
        <div class="top-meta mobile-display-none">
            <span class="meta-title">
                {{ $block->utitle ?? '' }}
            </span>
            @if(!empty($block->fourth))
                {{ link_to_route('search', $block->fourth, ['search' =>$block->fourth], ['class'=>'btn-meta']) }}
            @endif
            @if(!empty($block->fifth))
                {{ link_to_route('search', $block->fifth, ['search' =>$block->fifth], ['class'=>'btn-meta']) }}
            @endif
            @if(!empty($block->sixth))
                {{ link_to_route('search', $block->sixth, ['search' =>$block->sixth], ['class'=>'btn-meta']) }}
            @endif
        </div>
        <div class="search">
            {!! Form::open(['url'=>route('search'), 'method'=>'post']) !!}
            <input autocomplete="off" type="search" name="search" class="search-placeholder"
                   placeholder="Пошук по сайту">
            <input type="hidden" name="stats">
            <div class="wrap-search"></div>
            {{ Form::close() }}
            <span class="img-search"></span>
        </div>
    </div>
</section>
<!-- end HEADER -->