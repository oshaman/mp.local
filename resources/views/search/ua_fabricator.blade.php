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
            Сортування за виробником:<br/>
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
                        @if(!empty($alphabet['en']))
                            <div class="first-alfavit">
                                @foreach($alphabet['en'] as $a)
                                    <a href="{{ route('search_fabricator_u', ['val'=>$a]) }}"
                                       class="nav-button-grey">{{$a}}</a>
                                @endforeach
                            </div>
                        @endif
                        @if(!empty($alphabet['ru']))
                            <div class="second-alfavit">
                                @foreach($alphabet['ru'] as $a)
                                    <a href="{{ route('search_fabricator_u', ['val'=>$a]) }}"
                                       class="nav-button-grey">{{$a}}</a>
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
    </div>
</section>