<section class="content">
    <div class="wrap">
        {{--BreadCrumbs--}}
        <div class="bread-crumbs breadcrumbs mobile-display-none" id="breadcrumbs" itemscope
             itemtype="http://schema.org/BreadcrumbList">
            <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                <a href="{{ route('main') }}" itemprop="item">Главная</a>
                <meta itemprop="position" content="1"/>
            </div>
            @if(!empty($atx->name))
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <a href="{{ route('search_atx', ['loc'=>'ru', 'val'=>$atx->class ]) }}">{{ $atx->name}}</a>
                    <meta itemprop="position" content="2"/>
                </div>
            @else
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <span itemprop="name" class="label1">Поиск по ATX-классификации</span>
                    <meta itemprop="position" content="2"/>
                </div>
            @endif
        </div>
        {{--BreadCrumbs--}}
        <h1 class="head-title">Результаты поиска по ATX-классификации:&nbsp;
            @if(!empty($atx)) : <a>{{ str_limit($atx->class, 48) }}</a>@endif
        </h1>
    </div>

    <div class="section-title-meta-icon">
        @if(!empty($atx->name))
            <h3>
                ПОИСК ПРЕПАРАТОВ :
                <a>{{ $atx->name }}</a>
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
            <h2 class="product-title">Поиск препаратов по ATX-классификации</h2>

            @include('search.nav')

            <div class="search-alfavit">
                <h2 class="product-title">Поиск препаратов по ATX-классификации
                    @if(!empty($atx->name))
                        - {{ $atx->name }}
                    @endif
                </h2>
                <div class="search-alfavit-column">
                    @if(!empty($parents))
                        <div class="search-left-content admin-content">
                            <div class="first-alfavit">
                                <ul>
                                    @foreach($parents as $parent)
                                        @continue('none' == $parent->name)
                                        <li>
                                            <a href="{{ route('search_atx', ['loc'=>'ru', 'val'=>$parent->class ]) }}">{{ $parent->class .' - '. $parent->name}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            @if(!empty($atx->children))
                <div class="search-result  admin-content">
                    <ul>
                        @foreach($atx->children as $class)
                            <li>
                                <a href="{{ route('search_atx', ['loc'=>'ru', 'val'=>$class->class ]) }}">{{ $class->class .' - '. $class->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(!empty($classifications))
                <div class="search-left-content admin-content">
                    @foreach($classifications as $class=>$medicines)
                        <h4>{{ $class .' - '.($medicines['name']) }}</h4>
                        @foreach($medicines as $k=>$medicine)
                            @continue('name' === $k)
                            <a href="{{ route('medicine', ['loc'=>'ru', 'medicine'=> $medicine->alias]) }}">
                                {{ $medicine->title }}</br>
                            </a>
                        @endforeach
                    @endforeach
                </div>
            @endif
        </div>
        <div class="SEO-text">

        </div>
    </div>
</section>