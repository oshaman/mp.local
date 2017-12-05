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
                    <a href="{{ route('search_mnn') }}" itemprop="item">Сортировка по международному названию</a>
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
        <h1 class="product-title">Сортировка по:</h1>

        @include('search.nav')
    </div>
    <div class="section-title-meta-icon">
        <h3>
            Сортировка препаратов по международному названию:&nbsp;
            @if(!empty($mnn->title))
                <a>{{ str_limit($mnn->title, 48) }}</a>
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
                            {{ link_to_route('search_mnn', '4', [null, 'mnn' =>'4'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'A', [null, 'mnn' =>'A'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'B', [null, 'mnn' =>'B'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'C', [null, 'mnn' =>'C'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'D', [null, 'mnn' =>'D'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'E', [null, 'mnn' =>'E'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'F', [null, 'mnn' =>'F'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'G', [null, 'mnn' =>'G'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'H', [null, 'mnn' =>'H'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'I', [null, 'mnn' =>'I'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'J', [null, 'mnn' =>'J'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'K', [null, 'mnn' =>'K'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'L', [null, 'mnn' =>'L'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'M', [null, 'mnn' =>'M'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'N', [null, 'mnn' =>'N'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'O', [null, 'mnn' =>'O'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'P', [null, 'mnn' =>'P'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'Q', [null, 'mnn' =>'Q'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'R', [null, 'mnn' =>'R'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'S', [null, 'mnn' =>'S'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'T', [null, 'mnn' =>'T'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'U', [null, 'mnn' =>'U'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'V', [null, 'mnn' =>'V'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'W', [null, 'mnn' =>'W'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'X', [null, 'mnn' =>'X'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'Y', [null, 'mnn' =>'Y'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_mnn', 'Z', [null, 'mnn' =>'Z'], ['class'=>'nav-button-grey']) }}
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
                        <a href="{{ route('medicine', ['medicine'=> $medicine->alias]) }}">
                            <h3>{{ $medicine->title }}</h3>
                        </a>
                    </div>
                @endforeach
            @endif
            @if(!empty($mnns))
                @foreach($mnns as $mnn)
                    <div class="search-result">
                        <a href="{{ route('search_mnn', ['val'=> $mnn->alias]) }}">
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