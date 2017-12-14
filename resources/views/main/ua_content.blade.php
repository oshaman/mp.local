<div class="full-content">
    <!-- MOBILE SLIDER -->
    <section class="mobile-first-screen desktop-display-none">
        <div class="mobile-first-screen-image">
            <img src="{{ asset('assets') }}/images/index/slider.jpg">
        </div>
        <div class="mobile-first-screen-info">
            Сайт пошуку преператів
        </div>
    </section>
    <!-- END MOBILE SLIDER -->
    <!-- SLIDER -->
    <section class="main-slider mobile-display-none">
        <div id="main-page-top-slider" class="slider">
            @if(!empty($sliders))
                @foreach($sliders as $slider)
                    <div class="slide">
                        <a href="{{ $slider->link ?? route('sort') }}" class="slider-images">
                            <img src="{{ asset('asset') }}/images/slider/{{ $slider->path }}"
                                 alt="{{ $slider->alt }}" title="{{ $slider->title }}">
                        </a>
                        <div class="slider-info">
                            <div class="slider-info-text">
                                <h2>{{ $slider->description }}</h2>
                                <p>{{ $slider->text }}</p>
                            </div>
                            <a href="{{ $slider->link ?? route('sort') }}" class="button-blue">Детальніше</a>
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
            <h3>На сайті</h3>
            <div class="section-meta-icon">
                <div class="section-icon">
                    <img src="{{ asset('assets') }}/images/title-icons/main-icon-1.png" alt="иконка на сайте">
                </div>
            </div>
        </div>
        <div class="box-number-three">
            <a href="{{ route('search_alpha_u') }}" class="box-number">
                <img src="{{ asset('assets') }}/images/index/main-1.jpg">
                <div class="box-number-info">
                    <div class="box-number-num">
                        20 000
                    </div>
                    <div class="box-number-info-text">
                        мед препаратів
                    </div>
                    <span class="button-blue">Всі мед препарати</span>
                </div>
            </a>
            <a href="{{ route('search_fabricator_u') }}" class="box-number">
                <img src="{{ asset('assets') }}/images/index/main-2.jpg">
                <div class="box-number-info">
                    <div class="box-number-num">
                        5 000
                    </div>
                    <div class="box-number-info-text">
                        фарм виробників
                    </div>
                    <span class="button-blue">Всі фарм виробники</span>
                </div>
            </a>
            <a href="{{ route('adv', ['loc'=>'ua']) }}" class="box-number">
                <img src="{{ asset('assets') }}/images/index/main-3.jpg">
                <div class="box-number-info">
                    <div class="box-number-num">
                        2 000
                    </div>
                    <div class="box-number-info-text">
                        партнерів
                    </div>
                    <span class="button-blue">Всі партнери</span>
                </div>
            </a>
        </div>
    </section>
    <!-- end НА САЙТЕ -->

    <!-- Поиск препаратов -->
    <section class="section-product-search">
        <div class="section-title-meta-icon">
            <h3>{{ $blocks[1]->utitle ?? '' }}</h3>
            <div class="section-meta-icon">
                @if(!empty($blocks[1]->fourth))
                    {{ link_to_route('search', $blocks[1]->fourth, ['search' =>$blocks[1]->fourth]) }}
                @endif
                @if(!empty($blocks[1]->fifth))
                    {{ link_to_route('search', $blocks[1]->fifth, ['search' =>$blocks[1]->fifth]) }}
                @endif
                @if(!empty($blocks[1]->sixth))
                    {{ link_to_route('search', $blocks[1]->sixth, ['search' =>$blocks[1]->sixth]) }}
                @endif
                <div class="section-icon">
                    <img src="{{ asset('assets') }}/images/title-icons/found.png" alt="иконка Также ищут">
                </div>
            </div>
        </div>
        <div class="product-search">
            {{--Витрина--}}
            @include('main.ua_medicines_cats', $med_cats)
            {{--Витрина--}}
            <div>
                <a href="{{ route('sort') }}" class="button-white">Більше препаратів</a>
            </div>
        </div>
    </section>
    <!-- end Поиск препаратов -->

    <!-- ТОП СТАТЬИ -->
    {{--<section class="mobile-display-none">--}}
    <section>
        <div class="section-title-meta-icon">
            <h3>{{ $blocks[2]->utitle ?? '' }}</h3>
            <div class="section-meta-icon">
                @if(!empty($blocks[2]->fourth))
                    {{ link_to_route('search', $blocks[2]->fourth, ['search' =>$blocks[2]->fourth]) }}
                @endif
                @if(!empty($blocks[2]->fifth))
                    {{ link_to_route('search', $blocks[2]->fifth, ['search' =>$blocks[2]->fifth]) }}
                @endif
                @if(!empty($blocks[2]->sixth))
                    {{ link_to_route('search', $blocks[2]->sixth, ['search' =>$blocks[2]->sixth]) }}
                @endif
                <div class="section-icon">
                    <img src="{{ asset('assets') }}/images/title-icons/main-icon-2.png" alt="иконка Топ статьи">
                </div>
            </div>
        </div>
        <div class="section-interest-art wrap">
            @if(!empty($articles['themes']) && $articles['themes']->isNotEmpty())
                @foreach($articles['themes'] as $theme)
                    <article class="article-articles">
                        <a href="{{ $theme->link }}">
                            <div class="article-img">
                                <img src="{{ asset('asset/images/theme').'/'.$theme->path }}"
                                     alt="{{ $theme->alt ?? '' }}"
                                     title="{{ $theme->imgtitle ?? ($theme->alt ?? '') }}">
                            </div>
                            <div class="article-info">
                                <h4 class="article-title">{{ $theme->title }}</h4>
                                <div class="date-link">
                                    <div class="article-date">
                                        {{ $theme->created_at->format('d')
                                            . ' '  . trans('ua.'.$theme->created_at->format('m'))
                                            . ' '  . $theme->created_at->format('Y')
                                        }}
                                    </div>
                                    <span class="btn-link">Докладніше</span>
                                </div>
                            </div>
                        </a>
                        <div class="article-border"></div>
                    </article>
                @endforeach
            @endif
        </div>
        <div>
            <a href="{{ route('ua_themes') }}" class="button-white">
                Більше статей</a>
        </div>
    </section>
    <!-- end ТОП СТАТЬИ -->

    <!-- НОВОСТИ -->
    <div class="news-aside mobile-display-none">
        <div class="content last-commercial">
            <section class="section-last-arts">
                <div class="section-title-meta-icon">
                    <h3>{{ $blocks[3]->utitle ?? '' }}</h3>
                    <div class="section-meta-icon">
                        @if(!empty($blocks[3]->fourth))
                            {{ link_to_route('search', $blocks[3]->fourth, ['search' =>$blocks[3]->fourth]) }}
                        @endif
                        @if(!empty($blocks[3]->fifth))
                            {{ link_to_route('search', $blocks[3]->fifth, ['search' =>$blocks[3]->fifth]) }}
                        @endif
                        @if(!empty($blocks[3]->sixth))
                            {{ link_to_route('search', $blocks[3]->sixth, ['search' =>$blocks[3]->sixth]) }}
                        @endif
                        <div class="section-icon">
                            <img src="{{ asset('assets') }}/images/title-icons/main-icon-3.png"
                                 alt="Последние статьи">
                        </div>
                    </div>
                </div>
                <div class="last-arts">
                    <div class="two-column-articles article-wrap section-interest-art">
                        <div class="left-column big-news">
                            @if(!empty($articles['tops']) && $articles['tops']->isNotEmpty())
                                <article class="news">
                                    <a href="{{ route('ua_articles',
                                                    ['ua_article_alias'=>$articles['tops'][0]->alias]) }}">
                                        <div class="article-img">
                                            <img src="{{ asset('asset/images/articles/ua/middle').'/'.$articles['tops'][0]->image->path }}"
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
                                                        . ' '  . trans('ua.'.$articles['tops'][0]->created_at->format('m'))
                                                        . ' '  . $articles['tops'][0]->created_at->format('Y')
                                                    }}
                                                </div>
                                                <span class="btn-link">Докладніше</span>
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
                                        <a href="{{ route('ua_articles', ['ua_article_alias'=>$article->alias]) }}">
                                            <div class="article-img">
                                                <img src="{{ asset('asset/images/articles/ua/small').'/'.$article->image->path }}">
                                                <div class="views"><span>{{ $article->view }}</span></div>
                                            </div>
                                            <div class="article-info">
                                                <h4 class="article-title">{{ $article->title }}</h4>
                                                <div class="date-link">
                                                    <div class="article-date">
                                                        {{ $article->created_at->format('d')
                                                            . ' '  . trans('ua.'.$article->created_at->format('m'))
                                                            . ' '  . $article->created_at->format('Y')
                                                        }}
                                                    </div>
                                                    <span class="btn-link">Докладніше</span>
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
                    <a href="{{ route('ua_articles_cat', ['cat_alias'=>'top-stati']) }}"
                       class="button-white">Більше статей</a>
                </div>
            </section>
            <section class="section-commercial-arts">
                <div class="section-title-meta-icon">
                    <h3>{{ $blocks[4]->utitle ?? '' }}</h3>
                    <div class="section-meta-icon">
                        @if(!empty($blocks[4]->fourth))
                            {{ link_to_route('search', $blocks[4]->fourth, ['search' =>$blocks[4]->fourth]) }}
                        @endif
                        @if(!empty($blocks[4]->fifth))
                            {{ link_to_route('search', $blocks[4]->fifth, ['search' =>$blocks[4]->fifth]) }}
                        @endif
                        @if(!empty($blocks[4]->sixth))
                            {{ link_to_route('search', $blocks[4]->sixth, ['search' =>$blocks[4]->sixth]) }}
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
                                    <a href="{{ route('ua_articles',
                                                    ['ua_article_alias'=>$articles['intims'][0]->alias]) }}">
                                        <div class="article-img">
                                            <img src="{{ asset('asset/images/articles/ua/middle').'/'.$articles['intims'][0]->image->path }}"
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
                                                        . ' '  . trans('ua.'.$articles['intims'][0]->created_at->format('m'))
                                                        . ' '  . $articles['intims'][0]->created_at->format('Y')
                                                    }}
                                                </div>
                                                <span class="btn-link">Докладніше</span>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="article-border"></div>
                                </article>
                                @if(!empty($articles['intims'][1]))
                                <article class="news">
                                    <a href="{{ route('ua_articles',
                                                    ['ua_article_alias'=>$articles['intims'][1]->alias]) }}">
                                        <div class="article-img">
                                            <img src="{{ asset('asset/images/articles/ua/middle').'/'.$articles['intims'][1]->image->path }}"
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
                                                        . ' '  . trans('ua.'.$articles['intims'][1]->created_at->format('m'))
                                                        . ' '  . $articles['intims'][1]->created_at->format('Y')
                                                    }}
                                                </div>
                                                <span class="btn-link">Докладніше</span>
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
                                @if(!empty($articles['intims']) && $articles['intims']->isNotEmpty())
                                    @foreach($articles['intims'] as $article)
                                        @continue($loop->index < 2)
                                        <article class="news">
                                            <a href="{{ route('ua_articles', ['ua_article_alias'=>$article->alias]) }}">
                                                <div class="article-img">
                                                    <img src="{{ asset('asset/images/articles/ua/small').'/'.$article->image->path }}">
                                                    <div class="views"><span>{{ $article->view }}</span></div>
                                                </div>
                                                <div class="article-info">
                                                    <h4 class="article-title">{{ $article->title }}</h4>
                                                    <div class="date-link">
                                                        <div class="article-date">
                                                            {{ $article->created_at->format('d')
                                                                . ' '  . trans('ua.'.$article->created_at->format('m'))
                                                                . ' '  . $article->created_at->format('Y')
                                                            }}
                                                        </div>
                                                        <span class="btn-link">Докладніше</span>
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
                        <a href="{{ route('ua_articles_cat', ['cat_alias'=>'intimnye-temy']) }}"
                           class="button-white">Більше статей</a>
                    </div>
            </section>
        </div>
        <aside class="news-med">
            <div class="section-title-meta-icon">
                <h3>{{ $blocks[6]->utitle ?? '' }}</h3>
                <div class="section-meta-icon">
                    @if(!empty($blocks[6]->fourth))
                        {{ link_to_route('search', $blocks[6]->fourth, ['search' =>$blocks[6]->fourth]) }}
                    @endif
                    @if(!empty($blocks[6]->fifth))
                        {{ link_to_route('search', $blocks[6]->fifth, ['search' =>$blocks[6]->fifth]) }}
                    @endif
                    @if(!empty($blocks[6]->sixth))
                        {{ link_to_route('search', $blocks[6]->sixth, ['search' =>$blocks[6]->sixth]) }}
                    @endif
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
                                <a href="{{ route('ua_articles', ['ua_article_alias'=>$article->alias]) }}">
                                    <div class="article-img">
                                        @if(!empty($article->image->path))
                                            @if($loop->first)
                                                <img src="{{ asset('asset/images/articles/ua/middle').'/'.$article->image->path }}">
                                            @else
                                                <img src="{{ asset('asset/images/articles/ua/small').'/'.$article->image->path }}">
                                            @endif
                                        @else
                                            <img src="{{ asset('asset/images/articles/mp.png') }}">
                                        @endif
                                        <div class="views"><span>{{ $article->view ?? 0}}</span></div>
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
                                                    . ' '  . trans('ua.'.$article->created_at->format('m'))
                                                    . ' '  . $article->created_at->format('Y')
                                                }}
                                            </div>
                                            <span class="btn-link">Докладніше</span>
                                        </div>
                                    </div>
                                </a>
                                <div class="article-border"></div>
                            </article>
                        @endforeach
                    @endif
                </div>
                <div>
                    <a href="{{ route('ua_articles_cat', ['cat_alias'=>'zabluzhdeniya']) }}"
                       class="button-white">Всі новини</a>
                </div>
            </div>
            <div class="section-title-meta-icon">
                <h3>{{ $blocks[0]->utitle ?? '' }}</h3>
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
                        <a href="{{ route('ua_articles_tag', ['tag_alias'=>$tag->alias]) }}"
                           class="btn-meta">
                            {{ $tag->uname }}
                        </a>
                    @endforeach
                @endif
            </div>
            <div class="index-aside-promo">
                <a href="{{ route('ua_adv') }}">
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
            <h3>{{ $blocks[5]->utitle ?? '' }}</h3>
            <div class="section-meta-icon">
                @if(!empty($blocks[5]->fourth))
                    {{ link_to_route('search', $blocks[5]->fourth, ['search' =>$blocks[5]->fourth]) }}
                @endif
                @if(!empty($blocks[5]->fifth))
                    {{ link_to_route('search', $blocks[5]->fifth, ['search' =>$blocks[5]->fifth]) }}
                @endif
                @if(!empty($blocks[5]->sixth))
                    {{ link_to_route('search', $blocks[5]->sixth, ['search' =>$blocks[5]->sixth]) }}
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
                        <a href="{{ route('ua_articles',
                                                ['ua_article_alias'=>$article->alias]) }}">
                            <div class="article-img">
                                <img src="{{ asset('asset/images/articles/ua/middle').'/'.$article->image->path }}">
                                <div class="views"><span>{{ $article->view }}</span></div>
                            </div>
                            <div class="article-info">
                                <h4 class="article-title">{{ $article->title }}</h4>
                                <div class="date-link">
                                    <div class="article-date">
                                        {{ $article->created_at->format('d')
                                            . ' '  . trans('ua.'.$article->created_at->format('m'))
                                            . ' '  . $article->created_at->format('Y')
                                        }}
                                    </div>
                                    <span class="btn-link">Докладніше</span>
                                </div>
                            </div>
                        </a>
                        <div class="article-border"></div>
                    </article>
                @endforeach
            @endif
        </div>
        <div>
            <a href="{{ route('ua_articles_cat', ['cat_alias'=>'pitanie-i-dieta']) }}"
               class="button-white">Більше статей</a>
        </div>
    </section>
    <!-- end Интересные СТАТЬИ -->
</div>
<div class="SEO-text">
    @if(!empty($seo))
        {!! $seo->seo_text !!}
    @endif
</div>