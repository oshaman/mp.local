<div class="full-content">
    <!-- MOBILE SLIDER -->
    <section class="mobile-first-screen desktop-display-none">
        <div class="mobile-first-screen-image">
            <img src="{{ asset('assets') }}/images/index/slider.jpg">
        </div>
        <div class="mobile-first-screen-info">
            Сайт поиска препаратов
        </div>
    </section>
    <!-- END MOBILE SLIDER -->
    <!-- SLIDER -->
    <section class="main-slider mobile-display-none">
        <div id="main-page-top-slider" class="slider">
            @if(!empty($sliders))
                @foreach($sliders as $slider)
                    <div class="slide">
                        <div class="slider-images">
                            <img src="{{ asset('asset') }}/images/slider/{{ $slider->path }}"
                                 alt="{{ $slider->alt }}" title="{{ $slider->title }}">
                    </div>
                        <div class="slider-info">
                            <div class="slider-info-text">
                                <h2>{{ $slider->description }}</h2>
                                <p>{{ $slider->text }}</p>
                            </div>
                            <a href="{{ $slider->link ?? route('sort') }}" class="button-blue">Подробнее</a>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
        <div class="pagination">
            <div class="slide">
                <div class="inner">
                    <img class="pagination-active" src="{{ asset('assets') }}/images/index/pagination-blue-1.png"
                         alt="" title="">
                    <img class="pagination-hover" src="{{ asset('assets') }}/images/index/pagination-white-1.png" alt=""
                         title="">
                </div>
            </div>
            <div class="slide">
                <div class="inner">
                    <img class="pagination-active" src="{{ asset('assets') }}/images/index/pagination-blue-2.png" alt=""
                         title="">
                    <img class="pagination-hover" src="{{ asset('assets') }}/images/index/pagination-white-2.png" alt=""
                         title="">
                </div>
            </div>
            <div class="slide">
                <div class="inner">
                    <img class="pagination-active" src="{{ asset('assets') }}/images/index/pagination-blue-3.png" alt=""
                         title="">
                    <img class="pagination-hover" src="{{ asset('assets') }}/images/index/pagination-white-3.png" alt=""
                         title="">
                </div>
            </div>
        </div>
    </section>
    <!-- end SLIDER -->

    <!-- НА САЙТЕ -->
    <section class="section-on-site">
        <div class="section-title-meta-icon">
            <h3>На сайте</h3>
            <div class="section-meta-icon">
                <div class="section-icon">
                    <img src="{{ asset('assets') }}/images/title-icons/main-icon-1.png" alt="иконка на сайте">
                </div>
            </div>
        </div>
        <div class="box-number-three">
            <a href="{{ route('sort') }}" class="box-number">
                <img src="{{ asset('assets') }}/images/index/main-1.jpg">
                <div class="box-number-info">
                    <div class="box-number-num">
                        20 000
                    </div>
                    <div class="box-number-info-text">
                        мед препаратов
                    </div>
                    <span class="button-blue">Все мед препараты</span>
                </div>
            </a>
            <a href="{{ route('search_fabricator') }}" class="box-number">
                <img src="{{ asset('assets') }}/images/index/main-2.jpg">
                <div class="box-number-info">
                    <div class="box-number-num">
                        5 000
                    </div>
                    <div class="box-number-info-text">
                        фарм производителей
                    </div>
                    <span class="button-blue">Все фарм производители</span>
                </div>
            </a>
            <a href="{{ route('adv') }}" class="box-number">
                <img src="{{ asset('assets') }}/images/index/main-3.jpg">
                <div class="box-number-info">
                    <div class="box-number-num">
                        2 000
                    </div>
                    <div class="box-number-info-text">
                        партнеров
                    </div>
                    <span class="button-blue">Все партнеры</span>
                </div>
            </a>
        </div>
    </section>
    <!-- end НА САЙТЕ -->

    <!-- Поиск препаратов -->
    <section class="section-product-search">
        <div class="section-title-meta-icon">
            <h3>{{ $blocks[1]->title ?? '' }}</h3>
            <div class="section-meta-icon">
                @if(!empty($blocks[1]->first))
                    {{ link_to_route('search', $blocks[1]->first, ['search' =>$blocks[1]->first]) }}
                @endif
                @if(!empty($blocks[1]->second))
                    {{ link_to_route('search', $blocks[1]->second, ['search' =>$blocks[1]->second]) }}
                @endif
                @if(!empty($blocks[1]->third))
                    {{ link_to_route('search', $blocks[1]->third, ['search' =>$blocks[1]->third]) }}
                @endif
                <div class="section-icon">
                    <img src="{{ asset('assets') }}/images/title-icons/found.png" alt="иконка Также ищут">
                </div>
            </div>
        </div>
        <div class="product-search">
            {{--Витрина--}}
            @include('main.medicines_cats', $med_cats)
            {{--Витрина--}}
            <div>
                <a href="{{ route('sort') }}" class="button-white">Больше препаратов</a>
            </div>
        </div>
    </section>
    <!-- end Поиск препаратов -->

    <!-- ТОП СТАТЬИ -->
    {{--<section class="mobile-display-none">--}}
    <section>
        <div class="section-title-meta-icon">
            <h3>{{ $blocks[2]->title ?? '' }}</h3>
            <div class="section-meta-icon">
                @if(!empty($blocks[2]->first))
                    {{ link_to_route('search', $blocks[2]->first, ['search' =>$blocks[2]->first]) }}
                @endif
                @if(!empty($blocks[2]->second))
                    {{ link_to_route('search', $blocks[2]->second, ['search' =>$blocks[2]->second]) }}
                @endif
                @if(!empty($blocks[2]->third))
                    {{ link_to_route('search', $blocks[2]->third, ['search' =>$blocks[2]->third]) }}
                @endif
                <div class="section-icon">
                    <img src="{{ asset('assets') }}/images/title-icons/main-icon-2.png" alt="иконка Топ статьи">
                </div>
            </div>
        </div>
        <div class="section-interest-art wrap">
            @if(!empty($articles['tops']) && $articles['tops']->isNotEmpty())
                @foreach($articles['tops'] as $top)
                    <article class="article-articles">
                        <a href="{{ route('articles', ['article_alias'=>$top->alias]) }}">
                            <div class="article-img">
                                <img src="{{ asset('asset/images/articles/ru/middle').'/'.$top->image->path }}"
                                     alt="{{ $top->image->alt ?? '' }}"
                                     title="{{ $top->image->title ?? ($top->image->alt ?? '') }}">
                                <div class="views"><span>{{ $top->view }}</span></div>
                            </div>
                            <div class="article-info">
                                <h4 class="article-title">{{ $top->title }}</h4>
                                <div class="date-link">
                                    <div class="article-date">
                                        {{ $top->created_at->format('d')
                                            . ' '  . trans('ru.'.$top->created_at->format('m'))
                                            . ' '  . $top->created_at->format('Y')
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

        <div>
            <a href="{{ route('articles_cat', ['cat_alias'=>'top-stati']) }}" class="button-white">
                Больше статей</a>
        </div>
    </section>
    <!-- end ТОП СТАТЬИ -->

    <!-- НОВОСТИ -->
    <div class="news-aside mobile-display-none">
        <div class="content last-commercial">
            <section class="section-last-arts">
                <div class="section-title-meta-icon">
                    <h3>{{ $blocks[3]->title ?? '' }}</h3>
                    <div class="section-meta-icon">
                        @if(!empty($blocks[3]->first))
                            {{ link_to_route('search', $blocks[3]->first, ['search' =>$blocks[3]->first]) }}
                        @endif
                        @if(!empty($blocks[3]->second))
                            {{ link_to_route('search', $blocks[3]->second, ['search' =>$blocks[3]->second]) }}
                        @endif
                        @if(!empty($blocks[3]->third))
                            {{ link_to_route('search', $blocks[3]->third, ['search' =>$blocks[3]->third]) }}
                        @endif
                        <div class="section-icon">
                            <img src="{{ asset('assets') }}/images/title-icons/main-icon-3.png"
                                 alt="иконка Последние статьи">
                        </div>
                    </div>
                </div>
                <div class="last-arts">
                    <div class="two-column-articles article-wrap section-interest-art">
                        <div class="left-column big-news">
                            @if(!empty($articles['tops']) && $articles['tops']->isNotEmpty())
                                <article class="news">
                                    <a href="{{ route('articles',
                                                    ['article_alias'=>$articles['tops'][0]->alias]) }}">
                                        <div class="article-img">
                                            <img src="{{ asset('asset/images/articles/ru/middle').'/'.$articles['tops'][0]->image->path }}"
                                                 alt="{{ $articles['tops'][0]->image->alt ?? '' }}"
                                                 title="{{ $articles['tops'][0]->image->title ?? ($articles['tops'][0]->image->alt ?? '') }}">
                                            <div class="views"><span>{{ $articles['tops'][0]->view }}</span></div>
                                        </div>
                                        <div class="article-info">
                                            <h4 class="article-title">{{ $articles['tops'][0]->title }}</h4>
                                            <div class="article-text">
                                                {!! str_limit($articles['tops'][0]->content, 160) !!}
                                            </div>
                                            <div class="date-link">
                                                <div class="article-date">
                                                    {{ $articles['tops'][0]->created_at->format('d')
                                                        . ' '  . trans('ru.'.$articles['tops'][0]->created_at->format('m'))
                                                        . ' '  . $articles['tops'][0]->created_at->format('Y')
                                                    }}
                                                </div>
                                                <span class="btn-link">Подробнее</span>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="article-border"></div>
                                </article>
                            @endif
                        </div>
                        <div class="right-column">
                            @if(!empty($articles['tops']) && $articles['tops']->isNotEmpty())
                                @foreach($articles['tops'] as $article)
                                    @continue($loop->first)
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
                    <a href="{{ route('articles_cat', ['cat_alias'=>'top-stati']) }}"
                       class="button-white">Больше статей</a>
                </div>
            </section>
            <section class="section-commercial-arts">
                <div class="section-title-meta-icon">
                    <h3>{{ $blocks[4]->title ?? '' }}</h3>
                    <div class="section-meta-icon">
                        @if(!empty($blocks[4]->first))
                            {{ link_to_route('search', $blocks[4]->first, ['search' =>$blocks[4]->first]) }}
                        @endif
                        @if(!empty($blocks[4]->second))
                            {{ link_to_route('search', $blocks[4]->second, ['search' =>$blocks[4]->second]) }}
                        @endif
                        @if(!empty($blocks[4]->third))
                            {{ link_to_route('search', $blocks[4]->third, ['search' =>$blocks[4]->third]) }}
                        @endif
                        <div class="section-icon">
                            <img src="{{ asset('assets') }}/images/title-icons/main-icon-5.png"
                                 alt="иконка Коммерчиские статьи">
                        </div>
                    </div>
                </div>
                <div class="last-arts">
                    <div class="two-column-articles article-wrap section-interest-art">
                        <div class="two-big-news">
                            @if(!empty($articles['intims']) && $articles['intims']->isNotEmpty())
                                <article class="news">
                                    <a href="{{ route('articles',
                                                    ['article_alias'=>$articles['intims'][0]->alias]) }}">
                                        <div class="article-img">
                                            <img src="{{ asset('asset/images/articles/ru/middle').'/'.$articles['intims'][0]->image->path }}"
                                                 alt="{{ $articles['intims'][0]->image->alt ?? '' }}"
                                                 title="{{ $articles['intims'][0]->image->title ?? ($articles['intims'][0]->image->alt ?? '') }}">
                                            <div class="views"><span>{{ $articles['intims'][0]->view }}</span></div>
                                        </div>
                                        <div class="article-info">
                                            <h4 class="article-title">{{ $articles['intims'][0]->title }}</h4>
                                            <div class="article-text">
                                                {!! str_limit($articles['intims'][0]->content, 160) !!}
                                            </div>
                                            <div class="date-link">
                                                <div class="article-date">
                                                    {{ $articles['intims'][0]->created_at->format('d')
                                                        . ' '  . trans('ru.'.$articles['intims'][0]->created_at->format('m'))
                                                        . ' '  . $articles['intims'][0]->created_at->format('Y')
                                                    }}
                                                </div>
                                                <span class="btn-link">Подробнее</span>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="article-border"></div>
                                </article>
                                <article class="news">
                                    <a href="{{ route('articles',
                                                    ['article_alias'=>$articles['intims'][1]->alias]) }}">
                                        <div class="article-img">
                                            <img src="{{ asset('asset/images/articles/ru/middle').'/'.$articles['intims'][1]->image->path }}"
                                                 alt="{{ $articles['intims'][1]->image->alt ?? '' }}"
                                                 title="{{ $articles['intims'][1]->image->title ?? ($articles['intims'][1]->image->alt ?? '') }}">
                                            <div class="views"><span>{{ $articles['intims'][1]->view }}</span></div>
                                        </div>
                                        <div class="article-info">
                                            <h4 class="article-title">{{ $articles['intims'][1]->title }}</h4>
                                            <div class="article-text">
                                                {!! str_limit($articles['intims'][1]->content, 160) !!}
                                            </div>
                                            <div class="date-link">
                                                <div class="article-date">
                                                    {{ $articles['intims'][1]->created_at->format('d')
                                                        . ' '  . trans('ru.'.$articles['intims'][1]->created_at->format('m'))
                                                        . ' '  . $articles['intims'][1]->created_at->format('Y')
                                                    }}
                                                </div>
                                                <span class="btn-link">Подробнее</span>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="article-border"></div>
                                </article>
                            @endif
                        </div>
                        <div>
                            <div class="small-news">
                                @if(!empty($articles['intims']) && $articles['intims']->isNotEmpty())
                                    @foreach($articles['intims'] as $article)
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
                    <a href="{{ route('articles_cat', ['cat_alias'=>'intimnye-temy']) }}"
                       class="button-white">Больше статей</a>
                </div>
            </section>
        </div>


        <aside class="news-med">
            <div class="section-title-meta-icon">
                <h3>{{ $blocks[6]->title ?? '' }}</h3>
                <div class="section-meta-icon">
                    <div class="section-icon">
                        <img src="{{ asset('assets') }}/images/title-icons/main-icon-4.png"
                             alt="иконка Новости медицины">
                    </div>
                </div>
            </div>
            <div class="news-med-arts">
                <div class="article-wrap big-news">
                    @if(!empty($articles['delusions']) && $articles['delusions']->isNotEmpty())
                        @foreach($articles['delusions'] as $article)
                            <article class="news">
                                <a href="{{ route('articles',
                                                ['article_alias'=>$article->alias]) }}">
                                    <div class="article-img">
                                        <img src="{{ asset('asset/images/articles/ru/small').'/'.$article->image->path }}">
                                        <div class="views"><span>{{ $article->view }}</span></div>
                                    </div>
                                    <div class="article-info">
                                        <h4 class="article-title">{{ $article->title }}</h4>
                                        @if($loop->first)
                                            <div class="article-text">
                                                {!! str_limit($article->content, 160) !!}
                                            </div>
                                        @endif
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
                <div>
                    <a href="{{ route('articles_cat', ['cat_alias'=>'zabluzhdeniya']) }}"
                       class="button-white">Все новости</a>
                </div>
            </div>
            <div class="section-title-meta-icon">
                <h3>{{ $blocks[0]->title ?? '' }}</h3>
                <div class="section-meta-icon">
                    <div class="section-icon">
                        <img src="{{ asset('assets') }}/images/title-icons/main-icon-6.png"
                             alt="иконка Популярные теги">
                    </div>
                </div>
            </div>
            <div class="popular-meta">
                @if(!empty($tags))
                    @foreach($tags as $tag)
                        <a href="{{ route('articles_tag', ['tag_alias'=>$tag->alias]) }}"
                           class="btn-meta">
                            {{ $tag->name }}
                        </a>
                    @endforeach
                @endif
            </div>
            <div class="index-aside-promo">
                <a href="{{ route('adv') }}">
                    <img src="{{ asset('assets') }}/images/promotion/main-reclama.jpg">
                </a>
            </div>

        </aside>

    </div>
    <!-- end НОВОСТИ -->
    <!-- Нижний слайдер -->
    <section class="down-slider-image mobile-display-none">
        <div class="only-slider-text-wrap section-down-slider">
            <div class="only-slider-text">
                Нельзя лечить неопознанную болезнь.
            </div>
            <div class="only-slider-text">
                Истина в вине, здоровье в воде.
            </div>
            <div class="only-slider-text">
                Сильнодействующее лекарство в руке неопытного, как мечь в руке (правой) безумного.
            </div>
            <div class="only-slider-text">
                Лечи умом, а не лекарствами.
            </div>
            <div class="only-slider-text">
                Врач - не что другое, как утешение для души.
            </div>
            <div class="only-slider-text">
                Врач - это философ, ведь нет большой разницы между мудростью и медициной. Гиппократ.
            </div>
            <div class="only-slider-text">
                Ничто так не мешает здоровью, как частая смена лекарств.
            </div>
            <div class="only-slider-text">
                Если помогает, хвалят природу, если не помогает, обвиняют врача.
            </div>
            <div class="only-slider-text">
                Подобное излечивается подобным.
            </div>
            <div class="only-slider-text">
                С устранением причины устраняется болезнь.
            </div>
        </div>
    </section>
    <!-- end Нижний слайдер -->
    <!-- Интересные СТАТЬИ -->
    <section class="mobile-display-none">
        <div class="section-title-meta-icon">
            <h3>{{ $blocks[5]->title ?? '' }}</h3>
            <div class="section-meta-icon">
                @if(!empty($blocks[5]->first))
                    {{ link_to_route('search', $blocks[5]->first, ['search' =>$blocks[5]->first]) }}
                @endif
                @if(!empty($blocks[5]->second))
                    {{ link_to_route('search', $blocks[5]->second, ['search' =>$blocks[5]->second]) }}
                @endif
                @if(!empty($blocks[5]->third))
                    {{ link_to_route('search', $blocks[5]->third, ['search' =>$blocks[5]->third]) }}
                @endif
                <div class="section-icon">
                    <img src="{{ asset('assets') }}/images/title-icons/main-icon-2.png" alt="иконка Топ статьи">
                </div>
            </div>
        </div>
        <div class="section-interest-art wrap">
            @if(!empty($articles['diets']) && $articles['diets']->isNotEmpty())
                @foreach($articles['diets'] as $article)
                    <article class="article-articles">
                        <a href="{{ route('articles',
                                                ['article_alias'=>$article->alias]) }}">
                            <div class="article-img">
                                <img src="{{ asset('asset/images/articles/ru/middle').'/'.$article->image->path }}">
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
        <div>
            <a href="{{ route('articles_cat', ['cat_alias'=>'pitanie-i-dieta']) }}"
               class="button-white">Больше статей</a>
        </div>
    </section>
    <!-- end Интересные СТАТЬИ -->
</div>
<div class="SEO-text">
    @if(!empty($seo))
        {!! $seo->seo_text !!}
    @endif
</div>