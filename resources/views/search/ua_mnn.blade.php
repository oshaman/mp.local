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
    <div class="section-title-meta-icon serch-height">
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
                        @if(!empty($alphabet) && count($alphabet)>0)
                            <div class="first-alfavit">
                                @foreach($alphabet as $a)
                                    {{ link_to_route('search_mnn_u', $a->first, [null, 'mnn' =>$a->first], ['class'=>'nav-button-grey']) }}
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @if(!empty($medicines))
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
    </div>
</section>