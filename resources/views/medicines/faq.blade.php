@if(!empty($medicine))
    <section class="content">
        <div class="wrap">
            {{--BreadCrumbs--}}
            <div class="bread-crumbs breadcrumbs mobile-display-none" id="breadcrumbs"
                 itemscope itemtype="http://schema.org/BreadcrumbList">
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <a href="{{ route('main') }}" itemprop="item">
                        <span itemprop="name" class="label1">Главная</span>
                        <meta itemprop="position" content="1"/>
                    </a>
                </div>
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <a href="{{ route('sort') }}" itemprop="item">
                        <span itemprop="name" class="label1">Поиск препаратов</span>
                        <meta itemprop="position" content="2"/>
                    </a>
                </div>
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <a href="{{ route('medicine', ['loc'=>'ru', 'medicine'=>$medicine->alias]) }}" itemprop="item">
                        <span itemprop="name" class="label1">{{ $medicine->title }}</span>
                        <meta itemprop="position" content="3"/>
                    </a>
                </div>
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <span itemprop="name" class="label1">Вопросы</span>
                    <meta itemprop="position" content="4"/>
                </div>
            </div>
            {{--BreadCrumbs--}}
            <h1 class="head-title">{{ $medicine->title }} инструкция и цена в аптеках</h1>
            <div class="clone-to" data-number="3"></div>
            <div class="product-nav">
                <a href="{{ route('medicine_official', ['loc'=>'ru', 'medicine'=>$medicine->alias]) }}"
                   class="nav-button-grey">
                    Официальная инструкция
                </a>
                <a href="{{ route('medicine', ['medicine'=>$medicine->alias, 'loc'=>'ru']) }}"
                   class="nav-button-grey ">Адаптированная инструкция</a>
                <a href="{{ route('medicine_analog', ['medicine'=>$medicine->alias, 'loc'=>'ru']) }}"
                   class="nav-button-grey">Аналоги</a>
                <a class="nav-button-grey active">Вопросы</a>
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