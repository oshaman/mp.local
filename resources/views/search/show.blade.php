<section class="content">
    <div class="wrap">
        {{--BreadCrumbs--}}
        <div class="bread-crumbs breadcrumbs mobile-display-none" id="breadcrumbs" itemscope
             itemtype="http://schema.org/BreadcrumbList">
            <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                <a href="{{ route('main') }}" itemprop="item">Главная</a>
                <meta itemprop="position" content="1"/>
            </div>
            @if(!empty($search))
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <span>Поиск по запросу "{{ $search }}"</span>
                    <meta itemprop="position" content="2"/>
                </div>
            @else
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <span itemprop="name" class="label1">Поиск</span>
                    <meta itemprop="position" content="2"/>
                </div>
            @endif
        </div>
        {{--BreadCrumbs--}}
        <h1 class="head-title">Результаты поиска по запросу:&nbsp;<a href="#!">{{ $search ?? '' }}</a></h1>
    </div>

    <div class="section-title-meta-icon">
        @if(!empty($search))
            <h3>Поиск препаратов:&nbsp;<a href="#!">{{ $search .' ('.count($titles['medicines'] ?? 0).')'}}</a></h3>
        @endif
        <div class="section-meta-icon">
            <div class="section-icon">
                <img src="{{ asset('assets') }}/images/title-icons/found.png" alt="иконка Также ищут">
            </div>
        </div>
    </div>
    <div class="wrap">
        @if(!empty($titles['medicines']))
            @foreach($titles['medicines'] as $title)
                <div class="search-result">
                    <a href="{{ route('medicine', ['medicine'=> $title['alias']]) }}">
                        <h3>{{ $title['title'] }}</h3></a>
                </div>
            @endforeach
        @else
            <div>
                Введите в строку поиска название лекарства (АТХ-код, МНН, название производителя, действующее вещество).

                После выбора конкретного препарата Вы найдете:

                инструкцию;
                цены в аптеках города;
                варианты доставки с аптек;
                аналоги.
            </div>
        @endif

        <div class="SEO-text">

        </div>
    </div>
    @if(!empty($titles['articles']))
        <section>
            <div class="section-title-meta-icon">
                <h3>Поиск статей:&nbsp;<a href="#!">{{ $search }} </a></h3>
                <div class="section-meta-icon">
                    <div class="section-icon">
                        <img src="{{ asset('assets') }}/images/title-icons/main-icon-7.png"
                             alt="иконка Коммерчиские статьи">
                    </div>
                </div>
            </div>
            <div class="last-arts">
                <div class="two-column-articles article-wrap section-interest-art">
                    <div class="two-big-news">
                        @if(!empty($titles['articles']) && $titles['articles']->isNotEmpty())
                            <article class="news">
                                <a href="{{ route('articles',
                                                    ['article_alias'=>$titles['articles'][0]->alias]) }}">
                                    <div class="article-img">
                                        <img src="{{ asset('asset/images/articles/ru/middle').'/'.$titles['articles'][0]->image->path }}"
                                             alt="{{ $titles['articles'][0]->image->alt ?? '' }}"
                                             title="{{ $titles['articles'][0]->image->title ?? ($titles['articles'][0]->image->alt ?? '') }}">
                                        <div class="views"><span>{{ $titles['articles'][0]->view }}</span></div>
                                    </div>
                                    <div class="article-info">
                                        <h4 class="article-title">{{ $titles['articles'][0]->title }}</h4>
                                        <div class="article-text">
                                            {!! str_limit($titles['articles'][0]->content, 160) !!}
                                        </div>
                                        <div class="date-link">
                                            <div class="article-date">
                                                {{ $titles['articles'][0]->created_at->format('d')
                                                    . ' '  . trans('ru.'.$titles['articles'][0]->created_at->format('m'))
                                                    . ' '  . $titles['articles'][0]->created_at->format('Y')
                                                }}
                                            </div>
                                            <span class="btn-link">Подробнее</span>
                                        </div>
                                    </div>
                                </a>
                                <div class="article-border"></div>
                            </article>
                            @if(!empty($titles['articles'][1]))
                                <article class="news">
                                    <a href="{{ route('articles',
                                                    ['article_alias'=>$titles['articles'][1]->alias]) }}">
                                        <div class="article-img">
                                            <img src="{{ asset('asset/images/articles/ru/middle').'/'.$titles['articles'][1]->image->path }}"
                                                 alt="{{ $titles['articles'][1]->image->alt ?? '' }}"
                                                 title="{{ $titles['articles'][1]->image->title ?? ($titles['articles'][1]->image->alt ?? '') }}">
                                            <div class="views"><span>{{ $titles['articles'][1]->view }}</span></div>
                                        </div>
                                        <div class="article-info">
                                            <h4 class="article-title">{{ $titles['articles'][1]->title }}</h4>
                                            <div class="article-text">
                                                {!! str_limit($titles['articles'][1]->content, 160) !!}
                                            </div>
                                            <div class="date-link">
                                                <div class="article-date">
                                                    {{ $titles['articles'][1]->created_at->format('d')
                                                        . ' '  . trans('ru.'.$titles['articles'][1]->created_at->format('m'))
                                                        . ' '  . $titles['articles'][1]->created_at->format('Y')
                                                    }}
                                                </div>
                                                <span class="btn-link">Подробнее</span>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="article-border"></div>
                                </article>
                            @endif
                        @endif
                    </div>
                    <div>
                        <div class="small-news">
                            @if(!empty($titles['articles']) && $titles['articles']->isNotEmpty())
                                @foreach($titles['articles'] as $article)
                                    @continue($loop->first)
                                    @continue(1 == $loop->index)
                                    <article class="news">
                                        <a href="{{ route('articles',
                                                    ['article_alias'=>$article->alias]) }}">
                                            <div class="article-img">
                                                <img src="{{ asset('asset/images/articles/ru/small').'/'.$article->image->path }}">
                                                <div class="views"><span>{{ $article->view }}</span></div>
                                            </div>
                                            <div class="article-info">
                                                <h4 class="article-title">{{ $article->title }}</h4>
                                                <div class="date-link">
                                                    <div class="article-date">
                                                        {{ $article->created_at->format('d')
                                                            . ' '  . trans('ru.'.$article->created_at->format('m'))
                                                            . ' '  . $article->created_at->format('Y')
                                                        }}
                                                    </div>
                                                    <span class="btn-link">Подробнее</span>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="article-border"></div>
                                    </article>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div>
            <div>
                <a href="#!" class="button-white">Больше статей</a>
            </div>
        </section>
    @endif
</section>