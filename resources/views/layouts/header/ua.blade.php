<!-- HEADER -->
<header>
    <div class="wrap">
        <div class="logo">
            @if('main' == Route::currentRouteName())
                <img src="{{ asset('assets') }}/images/main/logo.png" alt="Логотип МЕД правда"></a>
            @else
                <a href="{{ route('main') }}">
                    <img src="{{ asset('assets') }}/images/main/logo.png" alt="Логотип МЕД правда"></a>
            @endif
        </div>
        <div class="search">
            <input type="search" name="search" id="search" placeholder="Поиск по сайту">
            <span class="img-search"></span>
        </div>
        <div class="main-menu">
            <nav class="mobile-display-none">
                <a href="{{ route('search_alpha_u') }}">Препарати</a>
                @if(!empty($cats))
                    @foreach($cats as $cat)
                        @continue($loop->index > 3)
                        @if('articles_cat' == Route::currentRouteName() && $cat->alias == Request::segment(2))
                            <a>{{ $cat->utitle }}</a>
                        @else
                            <a href="{{ route('ua_articles_cat', ['cat'=>$cat->alias]) }}">{{ $cat->utitle }}</a>
                        @endif
                    @endforeach
                @endif
            </nav>
            <a class="burgerBtn">
                <span></span>
            </a>
        </div>
        <div class="lang-menu mobile-display-none">
            <a href="{{  str_replace('/ua', '', url()->full()) }}">Рус</a>
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
            <input type="search" name="search" id="search" placeholder="Пошук по сайту">
            <input type="hidden" name="stats">
            {{ Form::close() }}
            <span class="img-search"></span>
        </div>
    </div>
</section>
<!-- end HEADER -->