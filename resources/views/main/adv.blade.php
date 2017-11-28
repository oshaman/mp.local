<section class="full-content page-articles">
    <div class="wrap">
        {{--BreadCrumbs--}}
        <div class="bread-crumbs breadcrumbs mobile-display-none" id="breadcrumbs" itemscope
             itemtype="http://schema.org/BreadcrumbList">
            <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                <a href="{{ route('main') }}" itemprop="item">Главная</a>
                <meta itemprop="position" content="1"/>
            </div>
            <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                <span itemprop="name" class="label1">Размещение рекламы</span>
                <meta itemprop="position" content="2"/>
            </div>
        </div>
        {{--BreadCrumbs--}}
        <div class="admin-content">
            @if(!empty($advs) && is_object($advs))
                @foreach($advs as $adv)
                    @if($loop->first)
                        <p><h1>{{ $adv->title }}</h1></p>
                        {!! $adv->text !!}
                    @else
                        <p>
                        <div class="section-title-meta-icon">
                            <h3>{{ $adv->title }}</h3>
                        </div>
                        </p>
                        @if(!empty($adv->path))
                            <p>
                            <div class="full-width-image">
                                <img src="{{ asset('asset') }}/images/rk/ru/{{ $adv->path }}"
                                     alt="{{ $adv->img_alt ?? '' }}" title="{{ $adv->img_title ?? '' }}">
                            </div>
                            </p>
                        @endif
                        {!! $adv->text !!}
                    @endif
                @endforeach
            @endif
        </div>

    </div>

    <div class="SEO-text">

    </div>

</section>