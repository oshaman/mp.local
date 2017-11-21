<section class="content">
    <div class="wrap">
        {{--BreadCrumbs--}}
        <div class="bread-crumbs breadcrumbs mobile-display-none" id="breadcrumbs" itemscope
             itemtype="http://schema.org/BreadcrumbList">
            <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                <a href="{{ route('main') }}" itemprop="item">Главная</a>
                <meta itemprop="position" content="1"/>
            </div>
            @if(!empty($substance))
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <span>Поиск по действующему веществу</span>
                    <meta itemprop="position" content="2"/>
                </div>
            @else
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <span itemprop="name" class="label1">Поиск по действующему веществу</span>
                    <meta itemprop="position" content="2"/>
                </div>
            @endif
        </div>
        {{--BreadCrumbs--}}
        <h1 class="head-title">
            Результаты поиска по действующему веществу @if(!empty($substance)): <a>{{ $substance->title }}</a>@endif
        </h1>
    </div>

    <div class="section-title-meta-icon">
        @if(!empty($substance->title))
            <h3>
                ПОИСК ПРЕПАРАТОВ :
                <a>{{ $substance->title }}</a>
            </h3>
        @endif
        <div class="section-meta-icon">
            <div class="section-icon">
                <img src="{{ asset('assets') }}/images/title-icons/found.png" alt="иконка Также ищут">
            </div>
        </div>
    </div>
    <div class="wrap">
        <div class="product-analog">
            <h2 class="product-title">Поиск препаратов по действующему веществу</h2>

            @include('search.nav')

            <div class="search-alfavit">
                <h2 class="product-title">Поиск препаратов по действующему веществу
                    @if(!empty($substance->title))
                        {{ $substance->title }}
                    @endif
                </h2>
                <div class="search-alfavit-column">
                    <div class="search-left-content">
                        <div class="first-alfavit">
                            {{ link_to_route('search_substance', '5', ['ru', null, 'substancesubstance' =>'5'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'B', ['ru', null, 'substance' =>'B'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'C', ['ru', null, 'substance' =>'C'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'L', ['ru', null, 'substance' =>'L'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'P', ['ru', null, 'substance' =>'P'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'T', ['ru', null, 'substance' =>'T'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'А', ['ru', null, 'substance' =>'А'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'Б', ['ru', null, 'substance' =>'Б'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'В', ['ru', null, 'substance' =>'В'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'Г', ['ru', null, 'substance' =>'Г'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'Д', ['ru', null, 'substance' =>'Д'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'Е', ['ru', null, 'substance' =>'Е'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'Ж', ['ru', null, 'substance' =>'Ж'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'З', ['ru', null, 'substance' =>'З'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'И', ['ru', null, 'substance' =>'И'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'Й', ['ru', null, 'substance' =>'Й'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'К', ['ru', null, 'substance' =>'К'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'Л', ['ru', null, 'substance' =>'Л'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'М', ['ru', null, 'substance' =>'М'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'Н', ['ru', null, 'substance' =>'Н'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'О', ['ru', null, 'substance' =>'О'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'П', ['ru', null, 'substance' =>'П'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'Р', ['ru', null, 'substance' =>'Р'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'С', ['ru', null, 'substance' =>'С'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'Т', ['ru', null, 'substance' =>'Т'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'У', ['ru', null, 'substance' =>'У'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'Ф', ['ru', null, 'substance' =>'Ф'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'Х', ['ru', null, 'substance' =>'Х'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'Ц', ['ru', null, 'substance' =>'Ц'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'Ч', ['ru', null, 'substance' =>'Ч'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'Ш', ['ru', null, 'substance' =>'Ш'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'Щ', ['ru', null, 'substance' =>'Щ'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'Э', ['ru', null, 'substance' =>'Э'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'Ю', ['ru', null, 'substance' =>'Ю'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'Я', ['ru', null, 'substance' =>'Я'], ['class'=>'nav-button-grey']) }}
                        </div>
                    </div>
                </div>
            </div>
            @if(!empty($medicines))
                @if(!empty($substance->title))
                    {{ $substance->title }}
                @endif
                @foreach($medicines as $medicine)
                    <div class="search-result">
                        <a href="{{ route('medicine', ['loc'=>'ru', 'medicine'=> $medicine->alias]) }}">
                            <h3>{{ $medicine->title }}</h3></a>
                    </div>
                @endforeach
            @endif
            @if(!empty($substances))
                @foreach($substances as $substance)
                    <div class="search-result">
                        <a href="{{ route('search_substance', ['loc'=>'ru', 'val'=>$substance->alias]) }}">
                            <h3>{{ $substance->title }}</h3></a>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="SEO-text">

        </div>
    </div>
</section>