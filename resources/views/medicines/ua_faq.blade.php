@if(!empty($medicine))
    <section class="content">
        <div class="wrap">
            {{--BreadCrumbs--}}
            <div class="bread-crumbs breadcrumbs mobile-display-none" id="breadcrumbs"
                 itemscope itemtype="http://schema.org/BreadcrumbList">
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <a href="{{ route('main', ['loc'=>'ua']) }}" itemprop="item">
                        <span itemprop="name" class="label1">Головна</span>
                        <meta itemprop="position" content="1"/>
                    </a>
                </div>
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <a href="{{ route('sort') }}" itemprop="item">
                        <span itemprop="name" class="label1">Пошук препаратів</span>
                        <meta itemprop="position" content="2"/>
                    </a>
                </div>
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <a href="{{ route('medicine_ua', ['medicine'=>$medicine->alias]) }}" itemprop="item">
                        <span itemprop="name" class="label1">{{ $medicine->title }}</span>
                        <meta itemprop="position" content="3"/>
                    </a>
                </div>
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <span itemprop="name" class="label1">Запитання</span>
                    <meta itemprop="position" content="4"/>
                </div>
            </div>
            {{--BreadCrumbs--}}
            <h1 class="head-title">{{ $medicine->title }}</h1>
            <div class="clone-to" data-number="3"></div>
            <div class="product-nav">
                <a href="{{ route('medicine_official_ua', ['medicine'=>$medicine->alias]) }}"
                   class="nav-button-grey">
                    Офіційна інструкція
                </a>
                <a href="{{ route('medicine_ua', ['medicine'=>$medicine->alias]) }}"
                   class="nav-button-grey ">Адаптована інструкція</a>
                <a href="{{ route('medicine_analog_ua', ['medicine'=>$medicine->alias]) }}"
                   class="nav-button-grey">Аналоги</a>
                <a class="nav-button-grey active">Запитання</a>
            </div>
            @if($medicine->questions->isNotEmpty())
                <div class="product-question accordion">
                    <ul>
                        @foreach($medicine->questions as $question)
                            <li class="accordion-item">
                                <h6>{{ $question->question }}</h6>
                                <div class="accordion-target">
                                    {!! $question->answer !!}
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="SEO-text">

            </div>
        </div>
    </section>
@endif