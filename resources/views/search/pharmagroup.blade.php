<section class="content">
    <div class="wrap">
        {{--BreadCrumbs--}}
        <div class="bread-crumbs breadcrumbs mobile-display-none" id="breadcrumbs" itemscope
             itemtype="http://schema.org/BreadcrumbList">
            <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                <a href="{{ route('main') }}" itemprop="item">Главная</a>
                <meta itemprop="position" content="1"/>
            </div>
            @if(!empty($farm))
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <span>
                        Поиск по фармакологической группе @if(!empty($farm)) : {{ str_limit($farm->title, 24) }}@endif
                    </span>
                    <meta itemprop="position" content="2"/>
                </div>
            @else
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <span itemprop="name" class="label1">
                        Поиск по фармакологической группе @if(!empty($farm)) : <a>{{ $farm->title }}</a>@endif
                    </span>
                    <meta itemprop="position" content="2"/>
                </div>
            @endif
        </div>
        {{--BreadCrumbs--}}
        <h1 class="head-title">Результаты поиска по фармакологической группе:&nbsp;@if(!empty($farm)) :
            <a>{{ str_limit($farm->title, 48) }}</a>@endif</h1>
    </div>

    <div class="section-title-meta-icon">
        @if(!empty($farm->title))
            <h3>
                ПОИСК ПРЕПАРАТОВ :
                <a>{{ str_limit($farm->title, 40) }}</a>
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
            <h2 class="product-title">Поиск препаратов по фармакологической группе</h2>

            @include('search.nav')

            <div class="search-alfavit">
                <h2 class="product-title">Поиск препаратов по фармакологической группе
                    @if(!empty($farm->title))
                        {{ $farm->title }}
                    @endif
                </h2>
                <div class="search-alfavit-column">
                    <div class="search-left-content">
                        <div class="first-alfavit">
                            {{ link_to_route('search_farm', 'А', ['ru', null, 'farmgroup' =>'А'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'Б', ['ru', null, 'farmgroup' =>'Б'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'В', ['ru', null, 'farmgroup' =>'В'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'Г', ['ru', null, 'farmgroup' =>'Г'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'Д', ['ru', null, 'farmgroup' =>'Д'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'Е', ['ru', null, 'farmgroup' =>'Е'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'Ж', ['ru', null, 'farmgroup' =>'Ж'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'З', ['ru', null, 'farmgroup' =>'З'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'И', ['ru', null, 'farmgroup' =>'И'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'К', ['ru', null, 'farmgroup' =>'К'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'Л', ['ru', null, 'farmgroup' =>'Л'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'М', ['ru', null, 'farmgroup' =>'М'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'Н', ['ru', null, 'farmgroup' =>'Н'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'О', ['ru', null, 'farmgroup' =>'О'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'П', ['ru', null, 'farmgroup' =>'П'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'Р', ['ru', null, 'farmgroup' =>'Р'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'С', ['ru', null, 'farmgroup' =>'С'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'Т', ['ru', null, 'farmgroup' =>'Т'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'У', ['ru', null, 'farmgroup' =>'У'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'Ф', ['ru', null, 'farmgroup' =>'Ф'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'Х', ['ru', null, 'farmgroup' =>'Х'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'Ц', ['ru', null, 'farmgroup' =>'Ц'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'Ш', ['ru', null, 'farmgroup' =>'Ш'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'Щ', ['ru', null, 'farmgroup' =>'Щ'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'Э', ['ru', null, 'farmgroup' =>'Э'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'Я', ['ru', null, 'farmgroup' =>'Я'], ['class'=>'nav-button-grey']) }}
                        </div>
                    </div>
                </div>
            </div>
            @if(!empty($medicines))
                @if(!empty($farm->title))
                    {{ $farm->title }}
                @endif
                @foreach($medicines as $medicine)
                    <div class="search-result">
                        <a href="{{ route('medicine', ['loc'=>'ru', 'medicine'=> $medicine->alias]) }}">
                            <h3>{{ $medicine->title }}</h3></a>
                    </div>
                @endforeach
            @endif
            @if(!empty($farms))
                @foreach($farms as $farm)
                    <div class="search-result">
                        <a href="{{ route('search_farm', ['loc'=>'ru', 'val'=>$farm->alias]) }}">
                            <h3>{{ $farm->title }}</h3></a>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="SEO-text">

        </div>
    </div>
</section>