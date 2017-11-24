<section class="content">
    <div class="wrap">
        {{--BreadCrumbs--}}
        <div class="bread-crumbs breadcrumbs mobile-display-none" id="breadcrumbs" itemscope
             itemtype="http://schema.org/BreadcrumbList">
            <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                <a href="{{ route('main') }}" itemprop="item">Главная</a>
                <meta itemprop="position" content="1"/>
            </div>
            @if(!empty($fabricator))
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <a href="{{ route('search_fabricator', 'ru') }}" itemprop="item">Поиск по производителю</a>
                    <meta itemprop="position" content="2"/>
                </div>
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <span>{{ $fabricator->title }}</span>
                    <meta itemprop="position" content="3"/>
                </div>
            @else
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <span itemprop="name" class="label1">Поиск по производителю</span>
                    <meta itemprop="position" content="2"/>
                </div>
            @endif
        </div>
        {{--BreadCrumbs--}}
        <h1 class="head-title">Результаты поиска:
            &nbsp;@if(!empty($fabricator)) : <a>{{ str_limit($fabricator->title, 48) }}</a>@endif
        </h1>
    </div>

    <div class="section-title-meta-icon">
        <h3>
            @if(!empty($fabricator->title))
                ПОИСК ПРЕПАРАТОВ :
                <a>{{ $fabricator->title }}</a>
            @endif
        </h3>
        <div class="section-meta-icon">
            <div class="section-icon">
                <img src="{{ asset('assets') }}/images/title-icons/found.png" alt="иконка Также ищут">
            </div>
        </div>
    </div>
    <div class="wrap">
        <div class="product-analog">
            <h2 class="product-title">Поиск препаратов по производителю</h2>

            @include('search.nav')

            <div class="search-alfavit">
                <h2 class="product-title">Поиск препаратов по производителю
                    @if(!empty($fabricator->title))
                        {{ $fabricator->title }}
                    @endif
                </h2>
                <div class="search-alfavit-column">
                    <div class="search-left-content">
                        <div class="first-alfavit">
                            <a href="{{ route('search_fabricator', ['loc'=>'ru', 'val'=>'E']) }}"
                               class="nav-button-grey">E</a>
                            <a href="{{ route('search_fabricator', ['loc'=>'ru', 'val'=>'L']) }}"
                               class="nav-button-grey">L</a>
                            <a href="{{ route('search_fabricator', ['loc'=>'ru', 'val'=>'S']) }}"
                               class="nav-button-grey">S</a>
                            <a href="{{ route('search_fabricator', ['loc'=>'ru', 'val'=>'Y']) }}"
                               class="nav-button-grey">Y</a>
                            <hr>
                            <a href="{{ route('search_fabricator', ['loc'=>'ru', 'val'=>'А']) }}"
                               class="nav-button-grey">А</a>
                            <a href="{{ route('search_fabricator', ['loc'=>'ru', 'val'=>'Б']) }}"
                               class="nav-button-grey">Б</a>
                            <a href="{{ route('search_fabricator', ['loc'=>'ru', 'val'=>'В']) }}"
                               class="nav-button-grey">В</a>
                            <a href="{{ route('search_fabricator', ['loc'=>'ru', 'val'=>'Г']) }}"
                               class="nav-button-grey">Г</a>
                            <a href="{{ route('search_fabricator', ['loc'=>'ru', 'val'=>'Д']) }}"
                               class="nav-button-grey">Д</a>
                            <a href="{{ route('search_fabricator', ['loc'=>'ru', 'val'=>'Е']) }}"
                               class="nav-button-grey">Е</a>
                            <a href="{{ route('search_fabricator', ['loc'=>'ru', 'val'=>'Ж']) }}"
                               class="nav-button-grey">Ж</a>
                            <a href="{{ route('search_fabricator', ['loc'=>'ru', 'val'=>'З']) }}"
                               class="nav-button-grey">З</a>
                            <a href="{{ route('search_fabricator', ['loc'=>'ru', 'val'=>'И']) }}"
                               class="nav-button-grey">И</a>
                            <a href="{{ route('search_fabricator', ['loc'=>'ru', 'val'=>'Й']) }}"
                               class="nav-button-grey">Й</a>
                            <a href="{{ route('search_fabricator', ['loc'=>'ru', 'val'=>'К']) }}"
                               class="nav-button-grey">К</a>
                            <a href="{{ route('search_fabricator', ['loc'=>'ru', 'val'=>'Л']) }}"
                               class="nav-button-grey">Л</a>
                            <a href="{{ route('search_fabricator', ['loc'=>'ru', 'val'=>'М']) }}"
                               class="nav-button-grey">М</a>
                            <a href="{{ route('search_fabricator', ['loc'=>'ru', 'val'=>'Н']) }}"
                               class="nav-button-grey">Н</a>
                            <a href="{{ route('search_fabricator', ['loc'=>'ru', 'val'=>'О']) }}"
                               class="nav-button-grey">О</a>
                            <a href="{{ route('search_fabricator', ['loc'=>'ru', 'val'=>'П']) }}"
                               class="nav-button-grey">П</a>
                            <a href="{{ route('search_fabricator', ['loc'=>'ru', 'val'=>'Р']) }}"
                               class="nav-button-grey">Р</a>
                            <a href="{{ route('search_fabricator', ['loc'=>'ru', 'val'=>'С']) }}"
                               class="nav-button-grey">С</a>
                            <a href="{{ route('search_fabricator', ['loc'=>'ru', 'val'=>'Т']) }}"
                               class="nav-button-grey">Т</a>
                            <a href="{{ route('search_fabricator', ['loc'=>'ru', 'val'=>'У']) }}"
                               class="nav-button-grey">У</a>
                            <a href="{{ route('search_fabricator', ['loc'=>'ru', 'val'=>'Ф']) }}"
                               class="nav-button-grey">Ф</a>
                            <a href="{{ route('search_fabricator', ['loc'=>'ru', 'val'=>'Х']) }}"
                               class="nav-button-grey">Х</a>
                            <a href="{{ route('search_fabricator', ['loc'=>'ru', 'val'=>'Ц']) }}"
                               class="nav-button-grey">Ц</a>
                            <a href="{{ route('search_fabricator', ['loc'=>'ru', 'val'=>'Ч']) }}"
                               class="nav-button-grey">Ч</a>
                            <a href="{{ route('search_fabricator', ['loc'=>'ru', 'val'=>'Ш']) }}"
                               class="nav-button-grey">Ш</a>
                            <a href="{{ route('search_fabricator', ['loc'=>'ru', 'val'=>'Щ']) }}"
                               class="nav-button-grey">Щ</a>
                            <a href="{{ route('search_fabricator', ['loc'=>'ru', 'val'=>'Э']) }}"
                               class="nav-button-grey">Э</a>
                            <a href="{{ route('search_fabricator', ['loc'=>'ru', 'val'=>'Ю']) }}"
                               class="nav-button-grey">Ю</a>
                            <a href="{{ route('search_fabricator', ['loc'=>'ru', 'val'=>'Я']) }}"
                               class="nav-button-grey">Я</a>
                        </div>
                    </div>
                </div>
            </div>
            @if(!empty($medicines))
                @if(!empty($fabricator->title))
                    {{ $fabricator->title }}
                @endif
                @foreach($medicines as $medicine)
                    <div class="search-result">
                        <a href="{{ route('medicine', ['loc'=>'ru', 'medicine'=> $medicine->alias]) }}">
                            <h3>{{ $medicine->title }}</h3></a>
                    </div>
                @endforeach
            @endif
            @if(!empty($fabricators))
                @foreach($fabricators as $fabricator)
                    <div class="search-result">
                        <a href="{{ route('search_fabricator', ['loc'=>'ru', 'val'=>$val, 'fabricator'=> $fabricator->alias]) }}">
                            <h3>{{ $fabricator->title }}</h3></a>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="SEO-text">

        </div>
    </div>
</section>