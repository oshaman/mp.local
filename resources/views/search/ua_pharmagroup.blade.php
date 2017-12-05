<section class="content">
    <div class="wrap">
        {{--BreadCrumbs--}}
        <div class="bread-crumbs breadcrumbs mobile-display-none" id="breadcrumbs" itemscope
             itemtype="http://schema.org/BreadcrumbList">
            <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                <a href="{{ route('main', ['loc'=>'ua']) }}" itemprop="item">Головна</a>
                <meta itemprop="position" content="1"/>
            </div>
            @if(!empty($farm))
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                        <a href="{{ route('search_farm_u') }}" itemprop="item">
                            Сортування за фармокологічною групою
                        </a>
                        <meta itemprop="position" content="2"/>
                    </div>
                </div>
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <span>{{ str_limit($farm->utitle, 24) }}</span>
                    <meta itemprop="position" content="3"/>
                </div>
            @else
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <span itemprop="name" class="label1">
                        Сортування за фармокологічною групою @if(!empty($farm)) : <a>{{ $farm->utitle }}</a>@endif
                    </span>
                    <meta itemprop="position" content="2"/>
                </div>
            @endif
        </div>
        {{--BreadCrumbs--}}
        <h1 class="product-title">Сортировка по:</h1>

        @include('search.nav')
    </div>
    <div class="section-title-meta-icon">
        <h3>
            Сортування за фармокологічною групою:&nbsp;
            @if(!empty($farm->utitle))
                <a>{{ $farm->utitle }}</a>
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
                            {{ link_to_route('search_farm_u', 'А', [null, 'farmgroup' =>'А'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm_u', 'Б', [null, 'farmgroup' =>'Б'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm_u', 'В', [null, 'farmgroup' =>'В'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm_u', 'Г', [null, 'farmgroup' =>'Г'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm_u', 'Д', [null, 'farmgroup' =>'Д'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm_u', 'Е', [null, 'farmgroup' =>'Е'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm_u', 'Ж', [null, 'farmgroup' =>'Ж'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm_u', 'З', [null, 'farmgroup' =>'З'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm_u', 'И', [null, 'farmgroup' =>'И'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm_u', 'К', [null, 'farmgroup' =>'К'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm_u', 'Л', [null, 'farmgroup' =>'Л'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm_u', 'М', [null, 'farmgroup' =>'М'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm_u', 'Н', [null, 'farmgroup' =>'Н'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm_u', 'О', [null, 'farmgroup' =>'О'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm_u', 'П', [null, 'farmgroup' =>'П'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm_u', 'Р', [null, 'farmgroup' =>'Р'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm_u', 'С', [null, 'farmgroup' =>'С'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm_u', 'Т', [null, 'farmgroup' =>'Т'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm_u', 'У', [null, 'farmgroup' =>'У'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm_u', 'Ф', [null, 'farmgroup' =>'Ф'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm_u', 'Х', [null, 'farmgroup' =>'Х'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm_u', 'Ц', [null, 'farmgroup' =>'Ц'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm_u', 'Ш', [null, 'farmgroup' =>'Ш'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm_u', 'Щ', [null, 'farmgroup' =>'Щ'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm_u', 'Є', [null, 'farmgroup' =>'Є'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm_u', 'Я', [null, 'farmgroup' =>'Я'], ['class'=>'nav-button-grey']) }}
                        </div>
                    </div>
                </div>
            </div>
            @if(!empty($medicines))
                @if(!empty($farm->utitle))
                    {{ $farm->utitle }}
                @endif
                @foreach($medicines as $medicine)
                    <div class="search-result">
                        <a href="{{ route('medicine_ua', ['medicine'=> $medicine->alias]) }}">
                            <h3>{{ $medicine->title }}</h3></a>
                    </div>
                @endforeach
            @endif
            @if(!empty($farms))
                @foreach($farms as $farm)
                    <div class="search-result">
                        <a href="{{ route('search_farm_u', ['val'=>$farm->alias]) }}">
                            <h3>{{ $farm->utitle }}</h3></a>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="SEO-text">

        </div>
    </div>
</section>