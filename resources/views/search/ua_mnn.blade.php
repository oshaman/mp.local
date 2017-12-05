<section class="content">
    <div class="wrap">
        {{--BreadCrumbs--}}
        <div class="bread-crumbs breadcrumbs mobile-display-none" id="breadcrumbs" itemscope
             itemtype="http://schema.org/BreadcrumbList">
            <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                <a href="{{ route('main', ['loc'=>'ua']) }}" itemprop="item">Головна</a>
                <meta itemprop="position" content="1"/>
            </div>
            @if(!empty($mnn))
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <a href="{{ route('search_mnn_u') }}" itemprop="item">Сортування за міжнародною назвою</a>
                    <meta itemprop="position" content="2"/>
                </div>
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <span>{{ str_limit($mnn->title, 48) }}</span>
                    <meta itemprop="position" content="3"/>
                </div>
            @else
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <span itemprop="name" class="label1">Сортування за міжнародною назвою</span>
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
            Сортування за міжнародною назвою:&nbsp;
            @if(!empty($mnn->title))
                <a>{{ $mnn->title }}</a>
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
                            {{ link_to_route('search_mnn_u', '4', [null, 'mnn' =>'4'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn_u', 'A', [null, 'mnn' =>'A'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn_u', 'B', [null, 'mnn' =>'B'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn_u', 'C', [null, 'mnn' =>'C'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn_u', 'D', [null, 'mnn' =>'D'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn_u', 'E', [null, 'mnn' =>'E'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn_u', 'F', [null, 'mnn' =>'F'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn_u', 'G', [null, 'mnn' =>'G'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn_u', 'H', [null, 'mnn' =>'H'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn_u', 'I', [null, 'mnn' =>'I'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn_u', 'J', [null, 'mnn' =>'J'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn_u', 'K', [null, 'mnn' =>'K'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn_u', 'L', [null, 'mnn' =>'L'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn_u', 'M', [null, 'mnn' =>'M'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn_u', 'N', [null, 'mnn' =>'N'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn_u', 'O', [null, 'mnn' =>'O'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn_u', 'P', [null, 'mnn' =>'P'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn_u', 'Q', [null, 'mnn' =>'Q'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn_u', 'R', [null, 'mnn' =>'R'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn_u', 'S', [null, 'mnn' =>'S'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn_u', 'T', [null, 'mnn' =>'T'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn_u', 'U', [null, 'mnn' =>'U'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn_u', 'V', [null, 'mnn' =>'V'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn_u', 'W', [null, 'mnn' =>'W'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn_u', 'X', [null, 'mnn' =>'X'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn_u', 'Y', [null, 'mnn' =>'Y'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn_u', 'Z', [null, 'mnn' =>'Z'], ['class'=>'nav-button-grey']) }}
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
                        <a href="{{ route('medicine_ua', ['medicine'=> $medicine->alias]) }}">
                            <h3>{{ $medicine->title }}</h3>
                        </a>
                    </div>
                @endforeach
            @endif
            @if(!empty($mnns))
                @foreach($mnns as $mnn)
                    <div class="search-result">
                        <a href="{{ route('search_mnn_u', ['val'=> $mnn->alias]) }}">
                            <h3>{{ $mnn->title }}</h3>
                            {{ $mnn->uname }}
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="SEO-text">

        </div>
    </div>
</section>