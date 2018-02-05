<section class="content">
    <div class="wrap">
        {{--BreadCrumbs--}}
        <div class="bread-crumbs breadcrumbs mobile-display-none" id="breadcrumbs" itemscope
             itemtype="http://schema.org/BreadcrumbList">
            <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                <a href="{{ route('main') }}" itemprop="item">Главная</a>
                <meta itemprop="position" content="1"/>
            </div>
            @empty($atx)
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <span itemprop="name" class="label1">Сортировка по ATX-классификации</span>
                    <meta itemprop="position" content="2"/>
                </div>
            @endempty
            @if(!empty($atx->parents))
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <a href="{{ route('search_atx') }}">Сортировка по ATX-классификации</a>
                    <meta itemprop="position" content="2"/>
                </div>
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <a href="{{ route('search_atx', ['val'=>$atx->parents->class ]) }}">{{ $atx->parents->class}}</a>
                    <meta itemprop="position" content="3"/>
                </div>
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <span itemprop="name" class="label1">{{ $atx->class ?? '' }}</span>
                    <meta itemprop="position" content="4"/>
                </div>
            @elseif(!empty($atx))
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <a href="{{ route('search_atx') }}">Сортировка по ATX-классификации</a>
                    <meta itemprop="position" content="2"/>
                </div>
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <span itemprop="name" class="label1">{{ $atx->class ?? '' }}</span>
                    <meta itemprop="position" content="3"/>
                </div>
            @endif
        </div>
        {{--BreadCrumbs--}}
        <h1 class="product-title">Сортировка по:</h1>

        @include('search.nav')
    </div>

    <div class="section-title-meta-icon serch-height">
        <h3>
            Сортировка препаратов по ATX:&nbsp;
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
    <div class="">
        <div class="product-analog">
            <div class="search-alfavit wrap">
                <div class="search-alfavit-column">
                    @if(!empty($parents))
                        <div class="search-left-content admin-content">
                            <div class="first-alfavit">
                                <ul>
                                    @foreach($parents as $parent)
                                        @continue('none' == $parent->name)
                                        <li>
                                            <a href="{{ route('search_atx', ['val'=>$parent->class ]) }}">{{ $parent->class .' - '. $parent->name}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            @if(!empty($classes))
                <div class="atx">
                    <div class="wrap">
                        @foreach($classes as $key=>$item)
                            @if($loop->last)
                                <a>
                                    {{ $key .' - '. $item['name'] }}
                                </a>
                            @else
                                <a href="{{ route('search_atx', ['val'=>$item['class'] ]) }}">
                                    {{ $key .' - '. $item['name'] }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
            @if(!empty($atx->children))
                <div class="admin-content wrap">
                    <ul>
                        @foreach($atx->children as $class)
                            <li>
                                <a href="{{ route('search_atx', ['val'=>$class->class ]) }}">{{ $class->class .' - '. $class->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(!empty($classifications))
                <div class="search-left-content admin-content wrap">
                    @foreach($classifications as $class=>$medicines)
                        <h4>{{ $class .' - '.($medicines['name']) }}</h4>
                        @foreach($medicines as $k=>$medicine)
                            @continue('name' === $k)
                            <a href="{{ route('medicine', ['medicine'=> $medicine->alias]) }}">
                                {{ $medicine->title }}</br>
                            </a>
                        @endforeach
                    @endforeach
                </div>
            @endif
        </div>
        @if(!empty($atxseo))
            <div class="SEO-text">
                {!! $atxseo->seo_text !!}
            </div>
        @endif
    </div>
</section>