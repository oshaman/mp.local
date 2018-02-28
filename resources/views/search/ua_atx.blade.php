<section class="content">
    <div class="wrap">
        {{--BreadCrumbs--}}
        <div class="bread-crumbs breadcrumbs mobile-display-none" id="breadcrumbs" itemscope
             itemtype="http://schema.org/BreadcrumbList">
            <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                <a href="{{ route('main', ['loc'=>'ua']) }}" itemprop="item">Головна</a>
                <meta itemprop="position" content="1"/>
            </div>
            @empty($atx)
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <span itemprop="name" class="label1">Сортування за АТХ-класифікацією</span>
                    <meta itemprop="position" content="2"/>
                </div>
            @endempty
            @if(!empty($atx->parents))
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <a href="{{ route('search_atx_u') }}">Сортування за АТХ-класифікацією</a>
                    <meta itemprop="position" content="2"/>
                </div>
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <a href="{{ route('search_atx_u', ['val'=>$atx->parents->class ]) }}">{{ $atx->parents->class}}</a>
                    <meta itemprop="position" content="3"/>
                </div>
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <span itemprop="name" class="label1">{{ $atx->class ?? '' }}</span>
                    <meta itemprop="position" content="4"/>
                </div>
            @elseif(!empty($atx))
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <a href="{{ route('search_atx_u') }}">Сортування за АТХ-класифікацією</a>
                    <meta itemprop="position" content="2"/>
                </div>
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <span itemprop="name" class="label1">{{ $atx->class ?? '' }}</span>
                    <meta itemprop="position" content="3"/>
                </div>
            @endif
        </div>
        {{--BreadCrumbs--}}
        <h1 class="product-title">Сортування за:</h1>

        @include('search.ua_nav')
    </div>

    <div class="section-title-meta-icon serch-height">
        <h3>
            Сортування за АТХ-класифікацією:&nbsp;
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
                                            <a href="{{ route('search_atx_u', ['val'=>$parent->class ]) }}">{{ $parent->class .' - '. $parent->uname}}</a>
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
                                    {{ $key .' - '. $item['uname'] }}
                                </a>
                            @else
                                <a href="{{ route('search_atx_u', ['val'=>$item['class'] ]) }}">
                                    {{ $key .' - '. $item['uname'] }}
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
                                <a href="{{ route('search_atx_u', ['val'=>$class->class ]) }}">{{ $class->class .' - '. $class->uname}}</a>
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
                            <a href="{{ route('medicine_ua', ['medicine'=> $medicine->alias]) }}">
                                {{ $medicine->title }}</br>
                            </a>
                        @endforeach
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>