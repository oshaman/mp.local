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
            <input type="search" name="search" id="search" placeholder="Поиск по сайту">
            <span class="img-search"></span>
        </div>
        <div class="main-menu">
            <nav class="mobile-display-none">
                <a href="{{ route('sort') }}">Препараты</a>
                @if(!empty($cats))
                    @foreach($cats as $cat)
                        @continue($loop->index > 3)
                        @if('articles_cat' == Route::currentRouteName() && $cat->alias == Request::segment(2))
                            <a>{{ $cat->title }}</a>
                        @else
                            <a href="{{ route('articles_cat', ['cat'=>$cat->alias]) }}">{{ $cat->title }}</a>
                        @endif
                    @endforeach
                @endif
            </nav>
            <a class="burgerBtn">
                <span></span>
            </a>
        </div>
        <div class="lang-menu mobile-display-none">
            <span class="active">Рус</span>
            <a href="{{ str_replace(env('APP_URL'), env('APP_URL').'/ua', url()->full()) }}">Укр</a>
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
                <input type="search" name="search" id="search" placeholder="Поиск по сайту">
            <input type="hidden" name="stats">
            {{ Form::close() }}
            <span class="img-search"></span>
        </div>
    </div>
</section>
<!-- end HEADER -->