<section class="content">
    <div class="wrap">
        {{--BreadCrumbs--}}
        <div class="bread-crumbs breadcrumbs mobile-display-none" id="breadcrumbs" itemscope
             itemtype="http://schema.org/BreadcrumbList">
            <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                <a href="{{ route('main', ['loc'=>'ua']) }}" itemprop="item">Головна</a>
                <meta itemprop="position" content="1"/>
            </div>
            @if(!empty($fabricator))
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <a href="{{ route('search_fabricator_u') }}" itemprop="item">Сортування за виробником</a>
                    <meta itemprop="position" content="2"/>
                </div>
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <span>{{ $fabricator->utitle }}</span>
                    <meta itemprop="position" content="3"/>
                </div>
            @else
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <span itemprop="name" class="label1">Сортування за виробником</span>
                    <meta itemprop="position" content="2"/>
                </div>
            @endif
        </div>
        {{--BreadCrumbs--}}
        <h1 class="product-title">Сортування за:</h1>

        @include('search.ua_nav')
    </div>
    <div class="section-title-meta-icon serch-height">
        <h3>
            Сортування за виробником:&nbsp;
            @if(!empty($fabricator->utitle))
                <a>{{ $fabricator->utitle }}</a>
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
            <div class="search-alfavit">
                <div class="search-alfavit-column">
                    <div class="search-left-content">
                        <div class="first-alfavit">
                            <a href="{{ route('search_fabricator_u', ['val'=>'E']) }}"
                               class="nav-button-grey">E</a>
                            <a href="{{ route('search_fabricator_u', ['val'=>'L']) }}"
                               class="nav-button-grey">L</a>
                            <a href="{{ route('search_fabricator_u', ['val'=>'S']) }}"
                               class="nav-button-grey">S</a>
                            <a href="{{ route('search_fabricator_u', ['val'=>'Y']) }}"
                               class="nav-button-grey">Y</a>
                            <hr>
                            <a href="{{ route('search_fabricator_u', ['val'=>'А']) }}"
                               class="nav-button-grey">А</a>
                            <a href="{{ route('search_fabricator_u', ['val'=>'Б']) }}"
                               class="nav-button-grey">Б</a>
                            <a href="{{ route('search_fabricator_u', ['val'=>'В']) }}"
                               class="nav-button-grey">В</a>
                            <a href="{{ route('search_fabricator_u', ['val'=>'Г']) }}"
                               class="nav-button-grey">Г</a>
                            <a href="{{ route('search_fabricator_u', ['val'=>'Д']) }}"
                               class="nav-button-grey">Д</a>
                            <a href="{{ route('search_fabricator_u', ['val'=>'Е']) }}"
                               class="nav-button-grey">Е</a>
                            <a href="{{ route('search_fabricator_u', ['val'=>'Ж']) }}"
                               class="nav-button-grey">Ж</a>
                            <a href="{{ route('search_fabricator_u', ['val'=>'З']) }}"
                               class="nav-button-grey">З</a>
                            <a href="{{ route('search_fabricator_u', ['val'=>'И']) }}"
                               class="nav-button-grey">И</a>
                            <a href="{{ route('search_fabricator_u', ['val'=>'І']) }}"
                               class="nav-button-grey">І</a>
                            <a href="{{ route('search_fabricator_u', ['val'=>'Й']) }}"
                               class="nav-button-grey">Й</a>
                            <a href="{{ route('search_fabricator_u', ['val'=>'К']) }}"
                               class="nav-button-grey">К</a>
                            <a href="{{ route('search_fabricator_u', ['val'=>'Л']) }}"
                               class="nav-button-grey">Л</a>
                            <a href="{{ route('search_fabricator_u', ['val'=>'М']) }}"
                               class="nav-button-grey">М</a>
                            <a href="{{ route('search_fabricator_u', ['val'=>'Н']) }}"
                               class="nav-button-grey">Н</a>
                            <a href="{{ route('search_fabricator_u', ['val'=>'О']) }}"
                               class="nav-button-grey">О</a>
                            <a href="{{ route('search_fabricator_u', ['val'=>'П']) }}"
                               class="nav-button-grey">П</a>
                            <a href="{{ route('search_fabricator_u', ['val'=>'Р']) }}"
                               class="nav-button-grey">Р</a>
                            <a href="{{ route('search_fabricator_u', ['val'=>'С']) }}"
                               class="nav-button-grey">С</a>
                            <a href="{{ route('search_fabricator_u', ['val'=>'Т']) }}"
                               class="nav-button-grey">Т</a>
                            <a href="{{ route('search_fabricator_u', ['val'=>'У']) }}"
                               class="nav-button-grey">У</a>
                            <a href="{{ route('search_fabricator_u', ['val'=>'Ф']) }}"
                               class="nav-button-grey">Ф</a>
                            <a href="{{ route('search_fabricator_u', ['val'=>'Х']) }}"
                               class="nav-button-grey">Х</a>
                            <a href="{{ route('search_fabricator_u', ['val'=>'Ц']) }}"
                               class="nav-button-grey">Ц</a>
                            <a href="{{ route('search_fabricator_u', ['val'=>'Ч']) }}"
                               class="nav-button-grey">Ч</a>
                            <a href="{{ route('search_fabricator_u', ['val'=>'Ш']) }}"
                               class="nav-button-grey">Ш</a>
                            <a href="{{ route('search_fabricator_u', ['val'=>'Щ']) }}"
                               class="nav-button-grey">Щ</a>
                            <a href="{{ route('search_fabricator_u', ['val'=>'Є']) }}"
                               class="nav-button-grey">Є</a>
                            <a href="{{ route('search_fabricator_u', ['val'=>'Ю']) }}"
                               class="nav-button-grey">Ю</a>
                            <a href="{{ route('search_fabricator_u', ['val'=>'Я']) }}"
                               class="nav-button-grey">Я</a>
                        </div>
                    </div>
                </div>
            </div>
            @if(!empty($medicines))
                @foreach($medicines as $medicine)
                    <div class="search-result">
                        <a href="{{ route('medicine_ua', ['medicine'=> $medicine->alias]) }}">
                            <h3>{{ $medicine->title }}</h3></a>
                    </div>
                @endforeach
            @endif
            @if(!empty($fabricators))
                @foreach($fabricators as $fabricator)
                    <div class="search-result">
                        <a href="{{ route('search_fabricator_u', ['val'=>$val, 'fabricator'=> $fabricator->alias]) }}">
                            <h3>{{ $fabricator->utitle }}</h3></a>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="SEO-text">

        </div>
    </div>
</section>