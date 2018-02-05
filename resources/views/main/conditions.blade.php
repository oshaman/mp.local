<section class="full-content page-articles">
    <div class="wrap">
        {{--BreadCrumbs--}}
        <div class="bread-crumbs breadcrumbs mobile-display-none" id="breadcrumbs" itemscope
             itemtype="http://schema.org/BreadcrumbList">
            <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                @if(empty($loc))
                    <a href="{{ route('main') }}" itemprop="item">Главная</a>
                @else
                    <a href="{{ route('main', ['loc'=>'ua']) }}" itemprop="item">Головна</a>
                @endif
                <meta itemprop="position" content="1"/>
            </div>
            <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                @if(empty($loc))
                    <span itemprop="name" class="label1">Условия использования сайта</span>
                @else
                    <span itemprop="name" class="label1">Умови використання сайту</span>
                @endif
                <meta itemprop="position" content="2"/>
            </div>
        </div>
        {{--BreadCrumbs--}}
        <div class="admin-content">
            <p>
            <h1>{{ $about->title ?? '' }}</h1></p>
            <p>
            @isset($about->path)
                <div class="full-width-image">
                    <img src="{{ asset('asset') }}/images/about/{{ $loc ?? 'ru' }}/{{ $about->path }}"
                         alt="{{ $about->alt ?? "Medpravda" }}" title="{{ $about->img_title ?? "Medpravda" }}">
                </div>
                </p>
            @endisset
            {!! $about->text ?? '' !!}

        </div>

        <div class="SEO-text">

        </div>
    </div>

</section>