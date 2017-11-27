<!-- HEADER -->
<header>
    <div class="wrap">
        <div class="logo">
            <a @if('main' !== Route::currentRouteName())href="{{ route('main') }}"@endif>
                <img src="{{ asset('assets') }}/images/main/logo.png" alt="Логотип МЕД правда"></a>
        </div>
        <div class="search">
            <input type="search" name="search" id="search" placeholder="Поиск по сайту">
            <span class="img-search"></span>
        </div>
        <div class="main-menu">
            <nav class="mobile-display-none">
                <a href="{{ route('search') }}">Препараты</a>
                <a href="{{ route('articles', ['loc'=>'ru']) }}">Интересно</a>
                <a href="{{ route('articles', ['loc'=>'ru']) }}">Последние статьи</a>
                <a href="{{ route('articles', ['loc'=>'ru']) }}">Новости медицины</a>
                <a href="{{ route('articles', ['loc'=>'ru']) }}">Лечение</a>
            </nav>
            <a class="burgerBtn">
                <span></span>
            </a>
        </div>
        <div class="lang-menu mobile-display-none">
            <span class="active">Рус</span>
            <a href="{{ $link ?? '' }}">Укр</a>
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
            {{--@if(!empty($block->fourth))
                {{ link_to_route('search', $block->fourth, ['search' =>$block->fourth], ['class'=>'btn-meta']) }}
            @endif
            @if(!empty($block->fifth))
                {{ link_to_route('search', $block->fifth, ['search' =>$block->fifth], ['class'=>'btn-meta']) }}
            @endif
            @if(!empty($block->sixth))
                {{ link_to_route('search', $block->sixth, ['search' =>$block->sixth], ['class'=>'btn-meta']) }}
            @endif--}}
        </div>
        <div class="search">
            <form method="GET" action="{{ route('search') }}" accept-charset="UTF-8">
                <input type="search" name="search" id="search" placeholder="Поиск по сайту">
            </form>
            <span class="img-search"></span>
        </div>
    </div>
</section>
<!-- end HEADER -->