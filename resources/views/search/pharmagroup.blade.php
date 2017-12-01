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
                        Сортировка по фармакологической группе @if(!empty($farm)) : <a>{{ $farm->title }}</a>@endif
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
            Сортировка препаратов по фармакологической группе:&nbsp;
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
                            {{ link_to_route('search_farm', 'А', [null, 'farmgroup' =>'А'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'Б', [null, 'farmgroup' =>'Б'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'В', [null, 'farmgroup' =>'В'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'Г', [null, 'farmgroup' =>'Г'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'Д', [null, 'farmgroup' =>'Д'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'Е', [null, 'farmgroup' =>'Е'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'Ж', [null, 'farmgroup' =>'Ж'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'З', [null, 'farmgroup' =>'З'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'И', [null, 'farmgroup' =>'И'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'К', [null, 'farmgroup' =>'К'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'Л', [null, 'farmgroup' =>'Л'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'М', [null, 'farmgroup' =>'М'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'Н', [null, 'farmgroup' =>'Н'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'О', [null, 'farmgroup' =>'О'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'П', [null, 'farmgroup' =>'П'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'Р', [null, 'farmgroup' =>'Р'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'С', [null, 'farmgroup' =>'С'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'Т', [null, 'farmgroup' =>'Т'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'У', [null, 'farmgroup' =>'У'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'Ф', [null, 'farmgroup' =>'Ф'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'Х', [null, 'farmgroup' =>'Х'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'Ц', [null, 'farmgroup' =>'Ц'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'Ш', [null, 'farmgroup' =>'Ш'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'Щ', [null, 'farmgroup' =>'Щ'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'Э', [null, 'farmgroup' =>'Э'], ['class'=>'nav-button-grey']) }}
                            {{ link_to_route('search_farm', 'Я', [null, 'farmgroup' =>'Я'], ['class'=>'nav-button-grey']) }}
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
        <div class="SEO-text">

        </div>
    </div>
</section>