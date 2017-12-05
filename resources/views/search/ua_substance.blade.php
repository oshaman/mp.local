<section class="content">
    <div class="wrap">
        {{--BreadCrumbs--}}
        <div class="bread-crumbs breadcrumbs mobile-display-none" id="breadcrumbs" itemscope
             itemtype="http://schema.org/BreadcrumbList">
            <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                <a href="{{ route('main', ['loc'=>'ua']) }}" itemprop="item">Головна</a>
                <meta itemprop="position" content="1"/>
            </div>
            @if(!empty($substance))
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <a href="{{ route('search_substance_u') }}" itemprop="item">
                        Сортування за діючою речовиною
                    </a>
                    <meta itemprop="position" content="2"/>
                </div>
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <span>{{ $substance->utitle }}</span>
                    <meta itemprop="position" content="3"/>
                </div>
            @else
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <span itemprop="name" class="label1">Сортування за діючою речовиною</span>
                    <meta itemprop="position" content="2"/>
                </div>
            @endif
        </div>
        {{--BreadCrumbs--}}
        <h1 class="product-title">Сортування за:</h1>

        @include('search.ua_nav')
    </div>
    <div class="section-title-meta-icon">
        <h3>
            Сортування за діючою речовиною:&nbsp;
            @if(!empty( $substance->utitle ))
                <a>{{  $substance->utitle  }}</a>
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
                            {{ link_to_route('search_substance_u', '5', [null, 'substance' =>'5'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance_u', 'B', [null, 'substance' =>'B'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance_u', 'C', [null, 'substance' =>'C'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance_u', 'L', [null, 'substance' =>'L'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance_u', 'P', [null, 'substance' =>'P'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance_u', 'T', [null, 'substance' =>'T'], ['class'=>'nav-button-grey']) }}
                        </div>
                        <div class="first-alfavit">
                            {{ link_to_route('search_substance_u', 'А', [null, 'substance' =>'А'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance_u', 'Б', [null, 'substance' =>'Б'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance_u', 'В', [null, 'substance' =>'В'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance_u', 'Г', [null, 'substance' =>'Г'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance_u', 'Д', [null, 'substance' =>'Д'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance_u', 'Е', [null, 'substance' =>'Е'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance_u', 'Ж', [null, 'substance' =>'Ж'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance_u', 'З', [null, 'substance' =>'З'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance_u', 'И', [null, 'substance' =>'И'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance_u', 'Й', [null, 'substance' =>'Й'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance_u', 'К', [null, 'substance' =>'К'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance_u', 'Л', [null, 'substance' =>'Л'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance_u', 'М', [null, 'substance' =>'М'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance_u', 'Н', [null, 'substance' =>'Н'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance_u', 'О', [null, 'substance' =>'О'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance_u', 'П', [null, 'substance' =>'П'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance_u', 'Р', [null, 'substance' =>'Р'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance_u', 'С', [null, 'substance' =>'С'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance_u', 'Т', [null, 'substance' =>'Т'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance_u', 'У', [null, 'substance' =>'У'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance_u', 'Ф', [null, 'substance' =>'Ф'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance_u', 'Х', [null, 'substance' =>'Х'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance_u', 'Ц', [null, 'substance' =>'Ц'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance_u', 'Ч', [null, 'substance' =>'Ч'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance_u', 'Ш', [null, 'substance' =>'Ш'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance_u', 'Щ', [null, 'substance' =>'Щ'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance_u', 'Є', [null, 'substance' =>'Є'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance_u', 'Ю', [null, 'substance' =>'Ю'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance_u', 'Я', [null, 'substance' =>'Я'], ['class'=>'nav-button-grey']) }}
                        </div>
                    </div>
                </div>
            </div>
            @if(!empty($medicines))
                @if(!empty($substance->utitle))
                    {{ $substance->utitle }}
                @endif
                @foreach($medicines as $medicine)
                    <div class="search-result">
                        <a href="{{ route('medicine_ua', ['medicine'=> $medicine->alias]) }}">
                            <h3>{{ $medicine->title }}</h3></a>
                    </div>
                @endforeach
            @endif
            @if(!empty($substances))
                @foreach($substances as $substance)
                    <div class="search-result">
                        <a href="{{ route('search_substance_u', ['val'=>$substance->alias]) }}">
                            <h3>{{ $substance->utitle }}</h3></a>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="SEO-text">

        </div>
    </div>
</section>