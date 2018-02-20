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
                    <a href="{{ route('search_substance', 'ru') }}" itemprop="item">Сортировка по действующему
                        веществу</a>
                    <meta itemprop="position" content="2"/>
                </div>
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <span>{{ $substance->title }}</span>
                    <meta itemprop="position" content="3"/>
                </div>
            @else
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <span itemprop="name" class="label1">Сортировка по действующему веществу</span>
                    <meta itemprop="position" content="2"/>
                </div>
            @endif
        </div>
        {{--BreadCrumbs--}}
        <h1 class="product-title">Сортировка по: {{ $substance->title ?? '' }}</h1>

        @include('search.nav')
    </div>
    <div class="section-title-meta-icon serch-height">
        <h3>
            Сортировка препаратов по действующему веществу:&nbsp;
            @if(!empty($letter))
                <a>{{ $letter }}</a>
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
                            {{ link_to_route('search_substance', '5', [null, 'substance' =>'5'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'B', [null, 'substance' =>'B'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'C', [null, 'substance' =>'C'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'L', [null, 'substance' =>'L'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'P', [null, 'substance' =>'P'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'T', [null, 'substance' =>'T'], ['class'=>'nav-button-grey']) }}
                        </div>
                        <div class="first-alfavit">
                            {{ link_to_route('search_substance', 'А', [null, 'substance' =>'А'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'Б', [null, 'substance' =>'Б'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'В', [null, 'substance' =>'В'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'Г', [null, 'substance' =>'Г'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'Д', [null, 'substance' =>'Д'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'Е', [null, 'substance' =>'Е'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'Ж', [null, 'substance' =>'Ж'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'З', [null, 'substance' =>'З'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'И', [null, 'substance' =>'И'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'Й', [null, 'substance' =>'Й'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'К', [null, 'substance' =>'К'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'Л', [null, 'substance' =>'Л'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'М', [null, 'substance' =>'М'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'Н', [null, 'substance' =>'Н'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'О', [null, 'substance' =>'О'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'П', [null, 'substance' =>'П'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'Р', [null, 'substance' =>'Р'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'С', [null, 'substance' =>'С'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'Т', [null, 'substance' =>'Т'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'У', [null, 'substance' =>'У'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'Ф', [null, 'substance' =>'Ф'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'Х', [null, 'substance' =>'Х'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'Ц', [null, 'substance' =>'Ц'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'Ч', [null, 'substance' =>'Ч'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'Ш', [null, 'substance' =>'Ш'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'Щ', [null, 'substance' =>'Щ'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'Э', [null, 'substance' =>'Э'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'Ю', [null, 'substance' =>'Ю'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_substance', 'Я', [null, 'substance' =>'Я'], ['class'=>'nav-button-grey']) }}
                        </div>
                    </div>
                </div>
            </div>
            @if(!empty($medicines))
                @foreach($medicines as $medicine)
                    <div class="search-result">
                        <a href="{{ route('medicine', ['medicine'=> $medicine->alias]) }}">
                            <h3>{{ $medicine->title }}</h3></a>
                    </div>
                @endforeach
            @endif
            @if(!empty($substances))
                @foreach($substances as $substance)
                    <div class="search-result">
                        <a href="{{ route('search_substance', ['val'=>$substance->alias]) }}">
                            <h3>{{ $substance->title }}</h3></a>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="SEO-text">

        </div>
    </div>
</section>