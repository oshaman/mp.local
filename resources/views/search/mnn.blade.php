<section class="content">
    <div class="wrap">
        {{--BreadCrumbs--}}
        <div class="bread-crumbs breadcrumbs mobile-display-none" id="breadcrumbs" itemscope
             itemtype="http://schema.org/BreadcrumbList">
            <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                <a href="{{ route('main') }}" itemprop="item">Главная</a>
                <meta itemprop="position" content="1"/>
            </div>
            @if(!empty($mnn))
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <a href="{{ route('search_mnn', 'ru') }}" itemprop="item">Сортировка по международному названию</a>
                    <meta itemprop="position" content="2"/>
                </div>
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <span>{{ str_limit($mnn->title, 48) }}</span>
                    <meta itemprop="position" content="3"/>
                </div>
            @else
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <span itemprop="name" class="label1">Сортировка по международному названию</span>
                    <meta itemprop="position" content="2"/>
                </div>
            @endif
        </div>
        {{--BreadCrumbs--}}
        <h1 class="head-title">
            Результаты поиска:&nbsp;@if(!empty($mnn)) :
            <a>{{ str_limit($mnn->title, 48) }}</a>@endif
        </h1>
    </div>

    <div class="section-title-meta-icon">
            <h3>
                ПОИСК ПРЕПАРАТОВ:&nbsp;
                @if(!empty($mnn->title))
                    <a>{{ $mnn->title }}</a>
                @endif
            </h3>
        <div class="section-meta-icon">
            <div class="section-icon">
                <img src="{{ asset('assets') }}/images/title-icons/found.png" alt="Препарат">
            </div>
        </div>
    </div>
    <div class="wrap">
        <div class="product-analog">
            <h2 class="product-title">Сортировка препаратов по международному названию</h2>

            @include('search.nav')

            <div class="search-alfavit">
                <h2 class="product-title">Сортировка препаратов по международному названию
                    @if(!empty($mnn->title))
                        {{ $mnn->title }}
                    @endif
                </h2>
                <div class="search-alfavit-column">
                    <div class="search-left-content">
                        <div class="first-alfavit">
                            {{ link_to_route('search_mnn', '4', ['ru', null, 'mnn' =>'4'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'A', ['ru', null, 'mnn' =>'A'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'B', ['ru', null, 'mnn' =>'B'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'C', ['ru', null, 'mnn' =>'C'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'D', ['ru', null, 'mnn' =>'D'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'E', ['ru', null, 'mnn' =>'E'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'F', ['ru', null, 'mnn' =>'F'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'G', ['ru', null, 'mnn' =>'G'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'H', ['ru', null, 'mnn' =>'H'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'I', ['ru', null, 'mnn' =>'I'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'J', ['ru', null, 'mnn' =>'J'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'K', ['ru', null, 'mnn' =>'K'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'L', ['ru', null, 'mnn' =>'L'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'M', ['ru', null, 'mnn' =>'M'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'N', ['ru', null, 'mnn' =>'N'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'O', ['ru', null, 'mnn' =>'O'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'P', ['ru', null, 'mnn' =>'P'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'Q', ['ru', null, 'mnn' =>'Q'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'R', ['ru', null, 'mnn' =>'R'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'S', ['ru', null, 'mnn' =>'S'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'T', ['ru', null, 'mnn' =>'T'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'U', ['ru', null, 'mnn' =>'U'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'V', ['ru', null, 'mnn' =>'V'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'W', ['ru', null, 'mnn' =>'W'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'X', ['ru', null, 'mnn' =>'X'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'Y', ['ru', null, 'mnn' =>'Y'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'Z', ['ru', null, 'mnn' =>'Z'], ['class'=>'nav-button-grey']) }}
                        </div>
                    </div>
                </div>
            </div>
            @if(!empty($medicines))
                @if(!empty($mnn->title))
                    {{ $mnn->title }}
                @endif
                @foreach($medicines as $medicine)
                    <div class="search-result">
                        <a href="{{ route('medicine', ['loc'=>'ru', 'medicine'=> $medicine->alias]) }}">
                            <h3>{{ $medicine->title }}</h3>
                        </a>
                    </div>
                @endforeach
            @endif
            @if(!empty($mnns))
                @foreach($mnns as $mnn)
                    <div class="search-result">
                        <a href="{{ route('search_mnn', ['loc'=>'ru', 'val'=> $mnn->alias]) }}">
                            <h3>{{ $mnn->title }}</h3>
                            {{ $mnn->name }}
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="SEO-text">

        </div>
    </div>
</section>