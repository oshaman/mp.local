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
                <a href="{{ route('search') }}" itemprop="item">
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
                <span itemprop="name" class="label1">Аналоги</span>
                <meta itemprop="position" content="4"/>
            </div>
        </div>
        {{--BreadCrumbs--}}


        <h1 class="head-title">{{ $medicine->title }}: аналоги</h1>
        <div class="product-nav">
            <a href="{{ route('medicine', ['medicine'=>$medicine->alias, 'loc'=>'ru']) }}" class="nav-button-grey">Официальная
                инструкция</a>
            <a href="product-adaptive-instruction.html!" class="nav-button-grey">Адаптированная инструкция</a>
            <a class="nav-button-grey active">Аналоги</a>
            <a href="product-question.html!" class="nav-button-grey">Вопросы</a>
        </div>
        <div class="minzdrav">
            Перед применением проконсультируйтесь со своим лечащим врачом!
        </div>
        <div class="product-analog">
            <h2 class="product-title">Совпадают действующие вещества</h2>
            <div class="product-nav product-nav-analog">
                @foreach($forms as $alias=>$form)
                    <a class="nav-button-grey" data-form-id="{{ $alias }}">{{ $form }}</a>
                @endforeach
            </div>
            @foreach($analogs as $analog)
                <div class="analog {{ $analog->form->alias }}">
                    <a href="{{ route('medicine', ['loc'=>'ru', 'medicine'=>$analog->alias]) }}">
                        <h3>{{ $analog->title }}</h3></a>
                    <div>
                        <span>Действующие вещества:</span>
                        @foreach($analog->substance as $substance)
                            <a href="{{ route('search_substance', ['loc'=>'ru', 'val'=>$substance->alias]) }}">
                                {{ $substance->title }}
                            </a>
                            @if($loop->last)
                                <span>. </span>
                            @else
                                <span>, </span>
                            @endif
                        @endforeach
                    </div>
                    <div>
                        <span>Код АТХ:</span>
                        <a href="{{ route('search_atx', ['loc'=>'ru', 'val'=>$analog->classification->class ]) }}">
                            {{ $analog->classification->class }}
                        </a>
                    </div>
                    <div>

                    </div>
                </div>
            @endforeach
        </div>
        <div class="SEO-text">

        </div>
    </div>
</section>