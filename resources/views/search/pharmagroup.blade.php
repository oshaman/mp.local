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
                    <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                        <a href="{{ route('search_farm') }}" itemprop="item">Сортировка по фармакологической
                            группе</a>
                        <meta itemprop="position" content="2"/>
                    </div>
                </div>
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <span>{{ str_limit($farm->title, 24) }}</span>
                    <meta itemprop="position" content="3"/>
                </div>
            @else
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <span itemprop="name" class="label1">
                        Сортировка по фармакотерапевтической группе @if(!empty($farm)) : <a>{{ $farm->title }}</a>@endif
                    </span>
                    <meta itemprop="position" content="2"/>
                </div>
            @endif
        </div>
        {{--BreadCrumbs--}}
        <h1 class="product-title">Сортировка по:</h1>

        @include('search.nav')
    </div>
    <div class="section-title-meta-icon serch-height">
        <h3>
            Сортировка препаратов по фармакотерапевтической группе:&nbsp;
            @if(!empty($farm->title))
                <a>{{ str_limit($farm->title, 128) }}</a>
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
                                    @if('n' == $a->first) @continue @endif
                                    {{ link_to_route('search_farm', $a->first, [null, 'farmgroup' =>$a->first], ['class'=>'nav-button-grey']) }}
                                @endforeach
                            </div>
                        @endif
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
            @if(!empty($farms))
                @foreach($farms as $farm)
                    <div class="search-result">
                        <a href="{{ route('search_farm', ['val'=>$farm->alias]) }}">
                            <h3>{{ $farm->title }}</h3></a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>