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
            <div class="slide">
                <div class="slider-images"><img src="{{ asset('assets') }}/images/index/slider.jpg"></div>

                <div class="slider-info">
                    <div class="slider-info-text">
                        <h2>Поиск препаратов</h2>
                        <p>Больше людей, испытывающих головне боли, предпочитают "заглушать" их таблетками, не
                            задумываясь,
                            что подобная реакция организма сама по себе показатель проблем. Больше людей, испытывающих
                            головне боли, предпочитают "заглушать" их таблетками, не
                            задумываясь,
                            что подобная реакция организма сама по себе показатель проблем.</p>
                    </div>
                    <a href="{{ route('search') }}" class="button-blue">Подробнее</a>
                </div>

            </div>
            <div class="slide">
                <div class="slider-images"><img src="{{ asset('assets') }}/images/index/slider2.jpg"></div>

                <div class="slider-info">
                    <div class="slider-info-text">
                        <h2>Поиск препаратов</h2>
                        <p>Больше людей, испытывающих головне боли, предпочитают "заглушать" их таблетками, не
                            задумываясь,
                            что подобная реакция организма сама по себе показатель проблем. Больше людей, испытывающих
                            головне боли, предпочитают "заглушать" их таблетками, не
                            задумываясь,
                            что подобная реакция организма сама по себе показатель проблем.</p>
                    </div>
                    <a href="{{ route('search') }}" class="button-blue">Подробнее</a>
                </div>
            </div>
            <div class="slide white-text">
                <div class="slider-images"><img src="{{ asset('assets') }}/images/index/slider3.jpg"></div>

                <div class="slider-info">
                    <div class="slider-info-text">
                        <h2>Поиск препаратов</h2>
                        <p>Больше людей, испытывающих головне боли, предпочитают "заглушать" их таблетками, не
                            задумываясь,
                            что подобная реакция организма сама по себе показатель проблем. Больше людей, испытывающих
                            головне боли, предпочитают "заглушать" их таблетками, не
                            задумываясь,
                            что подобная реакция организма сама по себе показатель проблем.</p>
                    </div>
                    <a href="{{ route('search') }}" class="button-blue">Подробнее</a>
                </div>
            </div>
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
            <div class="box-number">
                <img src="{{ asset('assets') }}/images/index/main-1.jpg">
                <div class="box-number-info">
                    <div class="box-number-num">
                        20 000
                    </div>
                    <div class="box-number-info-text">
                        мед препаратов
                    </div>
                    <a href="{{ route('search') }}" class="button-blue">Все мед препараты</a>
                </div>
            </div>
            <div class="box-number">
                <img src="{{ asset('assets') }}/images/index/main-2.jpg">
                <div class="box-number-info">
                    <div class="box-number-num">
                        5 000
                    </div>
                    <div class="box-number-info-text">
                        фарм производителей
                    </div>
                    <a href="{{ route('search_fabricator', 'ru') }}" class="button-blue">Все фарм производители</a>
                </div>
            </div>
            <div class="box-number">
                <img src="{{ asset('assets') }}/images/index/main-3.jpg">
                <div class="box-number-info">
                    <div class="box-number-num">
                        2 000
                    </div>
                    <div class="box-number-info-text">
                        партнеров
                    </div>
                    <a href="{{ route('search') }}" class="button-blue">Все партнеры</a>
                </div>
            </div>
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
                {{--@if(!empty($blocks[1]->fourth))
                    {{ link_to_route('search', $blocks[1]->fourth, ['search' =>$blocks[1]->fourth]) }}
                @endif
                @if(!empty($blocks[1]->fifth))
                    {{ link_to_route('search', $blocks[1]->fifth, ['search' =>$blocks[1]->fifth]) }}
                @endif
                @if(!empty($blocks[1]->sixth))
                    {{ link_to_route('search', $blocks[1]->sixth, ['search' =>$blocks[1]->sixth]) }}
                @endif--}}
                <div class="section-icon">
                    <img src="{{ asset('assets') }}/images/title-icons/found.png" alt="иконка Также ищут">
                </div>
            </div>
        </div>
        <div class="product-search">
            @include('main.medicines_cats', $med_cats)
            <div>
                <a href="{{ route('search') }}" class="button-white">Больше препаратов</a>
            </div>
        </div>
    </section>
    <!-- end Поиск препаратов -->

    <!-- ТОП СТАТЬИ -->
    <section class="mobile-display-none">
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
                {{--@if(!empty($blocks[2]->fourth))
                    {{ link_to_route('search', $blocks[2]->fourth, ['search' =>$blocks[2]->fourth]) }}
                @endif
                @if(!empty($blocks[2]->fifth))
                    {{ link_to_route('search', $blocks[2]->fifth, ['search' =>$blocks[2]->fifth]) }}
                @endif
                @if(!empty($blocks[2]->sixth))
                    {{ link_to_route('search', $blocks[2]->sixth, ['search' =>$blocks[2]->sixth]) }}
                @endif--}}
                <div class="section-icon">
                    <img src="{{ asset('assets') }}/images/title-icons/main-icon-2.png" alt="иконка Топ статьи">
                </div>
            </div>
        </div>
        <div class="section-interest-art wrap">
            <article class="article-articles">
                <a href="single-article.html">
                    <div class="article-img">
                        <img src="{{ asset('assets') }}/images/index/top-art.jpg">
                        <div class="views"><span>2143</span></div>
                    </div>
                    <div class="article-info">
                        <h4 class="article-title">Очки нам больше никогда не
                            понадобятся!</h4>
                        <p class="article-category">Статистика минздрава</p>
                        <p class="article-text">Больше людей, испытывающих головне боли, предпочитают "заглушать" их
                            таблетками, не
                            задумываясь,
                            что подобная реакция организма сама по себе показатель проблем. Больше людей,
                            испытывающих головне боли, предпочитают "заглушать" их таблетками, не задумываясь,
                            что подобная реакция организма сама по себе показатель проблем.</p>
                        <div class="date-link">
                            <div class="article-date">1 сентбря 2017</div>
                            <span class="btn-link">Подробнее</span>
                        </div>
                    </div>
                </a>
                <div class="article-border"></div>
            </article>
            <article class="article-articles">
                <a href="single-article.html">
                    <div class="article-img">
                        <img src="{{ asset('assets') }}/images/index/top-art.jpg">
                        <div class="views"><span>2143</span></div>
                    </div>
                    <div class="article-info">
                        <h4 class="article-title">Очки нам больше никогда не
                            понадобятся!</h4>
                        <p class="article-category">Статистика минздрава</p>
                        <p class="article-text">Больше людей, испытывающих головне боли, предпочитают "заглушать" их
                            таблетками, не
                            задумываясь,
                            что подобная реакция организма сама по себе показатель проблем. Больше людей,
                            испытывающих головне боли, предпочитают "заглушать" их таблетками, не задумываясь,
                            что подобная реакция организма сама по себе показатель проблем.</p>
                        <div class="date-link">
                            <div class="article-date">1 сентбря 2017</div>
                            <span class="btn-link">Подробнее</span>
                        </div>
                    </div>
                </a>
                <div class="article-border"></div>
            </article>
            <article class="article-articles">
                <a href="single-article.html">
                    <div class="article-img">
                        <img src="{{ asset('assets') }}/images/index/top-art.jpg">
                        <div class="views"><span>2143</span></div>
                    </div>
                    <div class="article-info">
                        <h4 class="article-title">Очки нам больше никогда не
                            понадобятся!</h4>
                        <p class="article-category">Статистика минздрава</p>
                        <p class="article-text">Больше людей, испытывающих головне боли, предпочитают "заглушать" их
                            таблетками, не
                            задумываясь,
                            что подобная реакция организма сама по себе показатель проблем. Больше людей,
                            испытывающих головне боли, предпочитают "заглушать" их таблетками, не задумываясь,
                            что подобная реакция организма сама по себе показатель проблем.</p>
                        <div class="date-link">
                            <div class="article-date">1 сентбря 2017</div>
                            <span class="btn-link">Подробнее</span>
                        </div>
                    </div>
                </a>
                <div class="article-border"></div>
            </article>
            <article class="article-articles">
                <a href="single-article.html">
                    <div class="article-img">
                        <img src="{{ asset('assets') }}/images/index/top-art.jpg">
                        <div class="views"><span>2143</span></div>
                    </div>
                    <div class="article-info">
                        <h4 class="article-title">Очки нам больше никогда не
                            понадобятся!</h4>
                        <p class="article-category">Статистика минздрава</p>
                        <p class="article-text">Больше людей, испытывающих головне боли, предпочитают "заглушать" их
                            таблетками, не
                            задумываясь,
                            что подобная реакция организма сама по себе показатель проблем. Больше людей,
                            испытывающих головне боли, предпочитают "заглушать" их таблетками, не задумываясь,
                            что подобная реакция организма сама по себе показатель проблем.</p>
                        <div class="date-link">
                            <div class="article-date">1 сентбря 2017</div>
                            <span class="btn-link">Подробнее</span>
                        </div>
                    </div>
                </a>
                <div class="article-border"></div>
            </article>
            <article class="article-articles">
                <a href="single-article.html">
                    <div class="article-img">
                        <img src="{{ asset('assets') }}/images/index/top-art.jpg">
                        <div class="views"><span>2143</span></div>
                    </div>
                    <div class="article-info">
                        <h4 class="article-title">Очки нам больше никогда не
                            понадобятся!</h4>
                        <p class="article-category">Статистика минздрава</p>
                        <p class="article-text">Больше людей, испытывающих головне боли, предпочитают "заглушать" их
                            таблетками, не
                            задумываясь,
                            что подобная реакция организма сама по себе показатель проблем. Больше людей,
                            испытывающих головне боли, предпочитают "заглушать" их таблетками, не задумываясь,
                            что подобная реакция организма сама по себе показатель проблем.</p>
                        <div class="date-link">
                            <div class="article-date">1 сентбря 2017</div>
                            <span class="btn-link">Подробнее</span>
                        </div>
                    </div>
                </a>
                <div class="article-border"></div>
            </article>
            <article class="article-articles">
                <a href="single-article.html">
                    <div class="article-img">
                        <img src="{{ asset('assets') }}/images/index/top-art.jpg">
                        <div class="views"><span>2143</span></div>
                    </div>
                    <div class="article-info">
                        <h4 class="article-title">Очки нам больше никогда не
                            понадобятся!</h4>
                        <p class="article-category">Статистика минздрава</p>
                        <p class="article-text">Больше людей, испытывающих головне боли, предпочитают "заглушать" их
                            таблетками, не
                            задумываясь,
                            что подобная реакция организма сама по себе показатель проблем. Больше людей,
                            испытывающих головне боли, предпочитают "заглушать" их таблетками, не задумываясь,
                            что подобная реакция организма сама по себе показатель проблем.</p>
                        <div class="date-link">
                            <div class="article-date">1 сентбря 2017</div>
                            <span class="btn-link">Подробнее</span>
                        </div>
                    </div>
                </a>
                <div class="article-border"></div>
            </article>
            <article class="article-articles">
                <a href="single-article.html">
                    <div class="article-img">
                        <img src="{{ asset('assets') }}/images/index/top-art.jpg">
                        <div class="views"><span>2143</span></div>
                    </div>
                    <div class="article-info">
                        <h4 class="article-title">Очки нам больше никогда не
                            понадобятся!</h4>
                        <p class="article-category">Статистика минздрава</p>
                        <p class="article-text">Больше людей, испытывающих головне боли, предпочитают "заглушать" их
                            таблетками, не
                            задумываясь,
                            что подобная реакция организма сама по себе показатель проблем. Больше людей,
                            испытывающих головне боли, предпочитают "заглушать" их таблетками, не задумываясь,
                            что подобная реакция организма сама по себе показатель проблем.</p>
                        <div class="date-link">
                            <div class="article-date">1 сентбря 2017</div>
                            <span class="btn-link">Подробнее</span>
                        </div>
                    </div>
                </a>
                <div class="article-border"></div>
            </article>
            <article class="article-articles">
                <a href="single-article.html">
                    <div class="article-img">
                        <img src="{{ asset('assets') }}/images/index/top-art.jpg">
                        <div class="views"><span>2143</span></div>
                    </div>
                    <div class="article-info">
                        <h4 class="article-title">Очки нам больше никогда не
                            понадобятся!</h4>
                        <p class="article-category">Статистика минздрава</p>
                        <p class="article-text">Больше людей, испытывающих головне боли, предпочитают "заглушать" их
                            таблетками, не
                            задумываясь,
                            что подобная реакция организма сама по себе показатель проблем. Больше людей,
                            испытывающих головне боли, предпочитают "заглушать" их таблетками, не задумываясь,
                            что подобная реакция организма сама по себе показатель проблем.</p>
                        <div class="date-link">
                            <div class="article-date">1 сентбря 2017</div>
                            <span class="btn-link">Подробнее</span>
                        </div>
                    </div>
                </a>
                <div class="article-border"></div>
            </article>
        </div>

        <div>
            <a href="{{ route('articles', ['loc'=>'ru']) }}" class="button-white">Больше статей</a>
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
                        {{--@if(!empty($blocks[3]->fourth))
                            {{ link_to_route('search', $blocks[3]->fourth, ['search' =>$blocks[3]->fourth]) }}
                        @endif
                        @if(!empty($blocks[3]->fifth))
                            {{ link_to_route('search', $blocks[3]->fifth, ['search' =>$blocks[3]->fifth]) }}
                        @endif
                        @if(!empty($blocks[3]->sixth))
                            {{ link_to_route('search', $blocks[3]->sixth, ['search' =>$blocks[3]->sixth]) }}
                        @endif--}}
                        <div class="section-icon">
                            <img src="{{ asset('assets') }}/images/title-icons/main-icon-3.png"
                                 alt="иконка Последние статьи">
                        </div>
                    </div>
                </div>
                <div class="last-arts">
                    <div class="two-column-articles article-wrap section-interest-art">
                        <div class="left-column big-news">
                            <article class="news">
                                <a href="single-article.html">
                                    <div class="article-img">
                                        <img src="{{ asset('assets') }}/images/news/article-big.jpg">
                                        <div class="views"><span>2143</span></div>
                                    </div>
                                    <div class="article-info">
                                        <h4 class="article-title">В Украине увеличилась
                                            численность
                                            населения</h4>
                                        <p class="article-category">Статистика минздрава</p>
                                        <p class="article-text">Больше людей, испытывающих головне боли, предпочитают
                                            "заглушать" их таблетками, не
                                            задумываясь,
                                            что подобная реакция организма сама по себе показатель проблем. Больше
                                            людей,
                                            испытывающих головне боли, предпочитают "заглушать" их таблетками, не
                                            задумываясь,
                                            что подобная реакция организма сама по себе показатель проблем.</p>
                                        <div class="date-link">
                                            <div class="article-date">1 сентбря 2017</div>
                                            <span class="btn-link">Подробнее</span>
                                        </div>
                                    </div>
                                </a>
                                <div class="article-border"></div>
                            </article>
                        </div>
                        <div class="right-column">
                            <article class="news">
                                <a href="single-article.html">
                                    <div class="article-img">
                                        <img src="{{ asset('assets') }}/images/news/article.jpg">
                                        <div class="views"><span>2143</span></div>
                                    </div>
                                    <div class="article-info">
                                        <h4 class="article-title">В Украине увеличилась
                                            численность
                                            населения</h4>
                                        <p class="article-category">Статистика минздрава</p>
                                        <p class="article-text">Больше людей, испытывающих головне боли, предпочитают
                                            "заглушать" их таблетками, не
                                            задумываясь,
                                            что подобная реакция организма сама по себе показатель проблем. Больше
                                            людей,
                                            испытывающих головне боли, предпочитают "заглушать" их таблетками, не
                                            задумываясь,
                                            что подобная реакция организма сама по себе показатель проблем.</p>
                                        <div class="date-link">
                                            <div class="article-date">1 сентбря 2017</div>
                                            <span class="btn-link">Подробнее</span>
                                        </div>
                                    </div>
                                </a>
                                <div class="article-border"></div>
                            </article>
                            <article class="news">
                                <a href="single-article.html">
                                    <div class="article-img">
                                        <img src="{{ asset('assets') }}/images/news/article.jpg">
                                        <div class="views"><span>2143</span></div>
                                    </div>
                                    <div class="article-info">
                                        <h4 class="article-title">В Украине увеличилась
                                            численность
                                            населения</h4>
                                        <p class="article-category">Статистика минздрава</p>
                                        <p class="article-text">Больше людей, испытывающих головне боли, предпочитают
                                            "заглушать" их таблетками, не
                                            задумываясь,
                                            что подобная реакция организма сама по себе показатель проблем. Больше
                                            людей,
                                            испытывающих головне боли, предпочитают "заглушать" их таблетками, не
                                            задумываясь,
                                            что подобная реакция организма сама по себе показатель проблем.</p>
                                        <div class="date-link">
                                            <div class="article-date">1 сентбря 2017</div>
                                            <span class="btn-link">Подробнее</span>
                                        </div>
                                    </div>
                                </a>
                                <div class="article-border"></div>
                            </article>
                            <article class="news">
                                <a href="single-article.html">
                                    <div class="article-img">
                                        <img src="{{ asset('assets') }}/images/news/article.jpg">
                                        <div class="views"><span>2143</span></div>
                                    </div>
                                    <div class="article-info">
                                        <h4 class="article-title">В Украине увеличилась
                                            численность
                                            населения</h4>
                                        <p class="article-category">Статистика минздрава</p>
                                        <p class="article-text">Больше людей, испытывающих головне боли, предпочитают
                                            "заглушать" их таблетками, не
                                            задумываясь,
                                            что подобная реакция организма сама по себе показатель проблем. Больше
                                            людей,
                                            испытывающих головне боли, предпочитают "заглушать" их таблетками, не
                                            задумываясь,
                                            что подобная реакция организма сама по себе показатель проблем.</p>
                                        <div class="date-link">
                                            <div class="article-date">1 сентбря 2017</div>
                                            <span class="btn-link">Подробнее</span>
                                        </div>
                                    </div>
                                </a>
                                <div class="article-border"></div>
                            </article>
                            <article class="news">
                                <a href="single-article.html">
                                    <div class="article-img">
                                        <img src="{{ asset('assets') }}/images/news/article.jpg">
                                        <div class="views"><span>2143</span></div>
                                    </div>
                                    <div class="article-info">
                                        <h4 class="article-title">В Украине увеличилась
                                            численность
                                            населения</h4>
                                        <p class="article-category">Статистика минздрава</p>
                                        <p class="article-text">Больше людей, испытывающих головне боли, предпочитают
                                            "заглушать" их таблетками, не
                                            задумываясь,
                                            что подобная реакция организма сама по себе показатель проблем. Больше
                                            людей,
                                            испытывающих головне боли, предпочитают "заглушать" их таблетками, не
                                            задумываясь,
                                            что подобная реакция организма сама по себе показатель проблем.</p>
                                        <div class="date-link">
                                            <div class="article-date">1 сентбря 2017</div>
                                            <span class="btn-link">Подробнее</span>
                                        </div>
                                    </div>
                                </a>
                                <div class="article-border"></div>
                            </article>
                        </div>
                    </div>
                </div>
                <div>
                    <a href="{{ route('articles', ['loc'=>'ru']) }}" class="button-white">Больше статей</a>
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
                        {{--@if(!empty($blocks[4]->fourth))
                            {{ link_to_route('search', $blocks[4]->fourth, ['search' =>$blocks[4]->fourth]) }}
                        @endif
                        @if(!empty($blocks[4]->fifth))
                            {{ link_to_route('search', $blocks[4]->fifth, ['search' =>$blocks[4]->fifth]) }}
                        @endif
                        @if(!empty($blocks[4]->sixth))
                            {{ link_to_route('search', $blocks[4]->sixth, ['search' =>$blocks[4]->sixth]) }}
                        @endif--}}
                        <div class="section-icon">
                            <img src="{{ asset('assets') }}/images/title-icons/main-icon-5.png"
                                 alt="иконка Коммерчиские статьи">
                        </div>
                    </div>
                </div>
                <div class="last-arts">
                    <div class="two-column-articles article-wrap section-interest-art">
                        <div class="left-column big-news">
                            <article class="news">
                                <a href="single-article.html">
                                    <div class="article-img">
                                        <img src="{{ asset('assets') }}/images/news/article-big.jpg">
                                        <div class="views"><span>2143</span></div>
                                    </div>
                                    <div class="article-info">
                                        <h4 class="article-title">В Украине увеличилась
                                            численность
                                            населения</h4>
                                        <p class="article-category">Статистика минздрава</p>
                                        <p class="article-text">Больше людей, испытывающих головне боли, предпочитают
                                            "заглушать" их таблетками, не
                                            задумываясь,
                                            что подобная реакция организма сама по себе показатель проблем. Больше
                                            людей,
                                            испытывающих головне боли, предпочитают "заглушать" их таблетками, не
                                            задумываясь,
                                            что подобная реакция организма сама по себе показатель проблем.</p>
                                        <div class="date-link">
                                            <div class="article-date">1 сентбря 2017</div>
                                            <span class="btn-link">Подробнее</span>
                                        </div>
                                    </div>
                                </a>
                                <div class="article-border"></div>
                            </article>
                            <article class="news">
                                <a href="single-article.html">
                                    <div class="article-img">
                                        <img src="{{ asset('assets') }}/images/news/article.jpg">
                                        <div class="views"><span>2143</span></div>
                                    </div>
                                    <div class="article-info">
                                        <h4 class="article-title">В Украине увеличилась
                                            численность
                                            населения</h4>
                                        <p class="article-category">Статистика минздрава</p>
                                        <p class="article-text">Больше людей, испытывающих головне боли, предпочитают
                                            "заглушать" их таблетками, не
                                            задумываясь,
                                            что подобная реакция организма сама по себе показатель проблем. Больше
                                            людей,
                                            испытывающих головне боли, предпочитают "заглушать" их таблетками, не
                                            задумываясь,
                                            что подобная реакция организма сама по себе показатель проблем.</p>
                                        <div class="date-link">
                                            <div class="article-date">1 сентбря 2017</div>
                                            <span class="btn-link">Подробнее</span>
                                        </div>
                                    </div>
                                </a>
                                <div class="article-border"></div>
                            </article>
                            <article class="news">
                                <a href="single-article.html">
                                    <div class="article-img">
                                        <img src="{{ asset('assets') }}/images/news/article.jpg">
                                        <div class="views"><span>2143</span></div>
                                    </div>
                                    <div class="article-info">
                                        <h4 class="article-title">В Украине увеличилась
                                            численность
                                            населения</h4>
                                        <p class="article-category">Статистика минздрава</p>
                                        <p class="article-text">Больше людей, испытывающих головне боли, предпочитают
                                            "заглушать" их таблетками, не
                                            задумываясь,
                                            что подобная реакция организма сама по себе показатель проблем. Больше
                                            людей,
                                            испытывающих головне боли, предпочитают "заглушать" их таблетками, не
                                            задумываясь,
                                            что подобная реакция организма сама по себе показатель проблем.</p>
                                        <div class="date-link">
                                            <div class="article-date">1 сентбря 2017</div>
                                            <span class="btn-link">Подробнее</span>
                                        </div>
                                    </div>
                                </a>
                                <div class="article-border"></div>
                            </article>
                            <article class="news">
                                <a href="single-article.html">
                                    <div class="article-img">
                                        <img src="{{ asset('assets') }}/images/news/article.jpg">
                                        <div class="views"><span>2143</span></div>
                                    </div>
                                    <div class="article-info">
                                        <h4 class="article-title">В Украине увеличилась
                                            численность
                                            населения</h4>
                                        <p class="article-category">Статистика минздрава</p>
                                        <p class="article-text">Больше людей, испытывающих головне боли, предпочитают
                                            "заглушать" их таблетками, не
                                            задумываясь,
                                            что подобная реакция организма сама по себе показатель проблем. Больше
                                            людей,
                                            испытывающих головне боли, предпочитают "заглушать" их таблетками, не
                                            задумываясь,
                                            что подобная реакция организма сама по себе показатель проблем.</p>
                                        <div class="date-link">
                                            <div class="article-date">1 сентбря 2017</div>
                                            <span class="btn-link">Подробнее</span>
                                        </div>
                                    </div>
                                </a>
                                <div class="article-border"></div>
                            </article>
                        </div>
                        <div class="right-column big-news">
                            <article class="news">
                                <a href="single-article.html">
                                    <div class="article-img">
                                        <img src="{{ asset('assets') }}/images/news/article-big.jpg">
                                        <div class="views"><span>2143</span></div>
                                    </div>
                                    <div class="article-info">
                                        <h4 class="article-title">В Украине увеличилась
                                            численность
                                            населения</h4>
                                        <p class="article-category">Статистика минздрава</p>
                                        <p class="article-text">Больше людей, испытывающих головне боли, предпочитают
                                            "заглушать" их таблетками, не
                                            задумываясь,
                                            что подобная реакция организма сама по себе показатель проблем. Больше
                                            людей,
                                            испытывающих головне боли, предпочитают "заглушать" их таблетками, не
                                            задумываясь,
                                            что подобная реакция организма сама по себе показатель проблем.</p>
                                        <div class="date-link">
                                            <div class="article-date">1 сентбря 2017</div>
                                            <span class="btn-link">Подробнее</span>
                                        </div>
                                    </div>
                                </a>
                            </article>
                            <article class="news">
                                <a href="single-article.html">
                                    <div class="article-img">
                                        <img src="{{ asset('assets') }}/images/news/article.jpg">
                                        <div class="views"><span>2143</span></div>
                                    </div>
                                    <div class="article-info">
                                        <h4 class="article-title">В Украине увеличилась
                                            численность
                                            населения</h4>
                                        <p class="article-category">Статистика минздрава</p>
                                        <p class="article-text">Больше людей, испытывающих головне боли, предпочитают
                                            "заглушать" их таблетками, не
                                            задумываясь,
                                            что подобная реакция организма сама по себе показатель проблем. Больше
                                            людей,
                                            испытывающих головне боли, предпочитают "заглушать" их таблетками, не
                                            задумываясь,
                                            что подобная реакция организма сама по себе показатель проблем.</p>
                                        <div class="date-link">
                                            <div class="article-date">1 сентбря 2017</div>
                                            <span class="btn-link">Подробнее</span>
                                        </div>
                                    </div>
                                </a>
                                <div class="article-border"></div>
                            </article>
                            <article class="news">
                                <a href="single-article.html">
                                    <div class="article-img">
                                        <img src="{{ asset('assets') }}/images/news/article.jpg">
                                        <div class="views"><span>2143</span></div>
                                    </div>
                                    <div class="article-info">
                                        <h4 class="article-title">В Украине увеличилась
                                            численность
                                            населения</h4>
                                        <p class="article-category">Статистика минздрава</p>
                                        <p class="article-text">Больше людей, испытывающих головне боли, предпочитают
                                            "заглушать" их таблетками, не
                                            задумываясь,
                                            что подобная реакция организма сама по себе показатель проблем. Больше
                                            людей,
                                            испытывающих головне боли, предпочитают "заглушать" их таблетками, не
                                            задумываясь,
                                            что подобная реакция организма сама по себе показатель проблем.</p>
                                        <div class="date-link">
                                            <div class="article-date">1 сентбря 2017</div>
                                            <span class="btn-link">Подробнее</span>
                                        </div>
                                    </div>
                                </a>
                                <div class="article-border"></div>
                            </article>
                            <article class="news">
                                <a href="single-article.html">
                                    <div class="article-img">
                                        <img src="{{ asset('assets') }}/images/news/article.jpg">
                                        <div class="views"><span>2143</span></div>
                                    </div>
                                    <div class="article-info">
                                        <h4 class="article-title">В Украине увеличилась
                                            численность
                                            населения</h4>
                                        <p class="article-category">Статистика минздрава</p>
                                        <p class="article-text">Больше людей, испытывающих головне боли, предпочитают
                                            "заглушать" их таблетками, не
                                            задумываясь,
                                            что подобная реакция организма сама по себе показатель проблем. Больше
                                            людей,
                                            испытывающих головне боли, предпочитают "заглушать" их таблетками, не
                                            задумываясь,
                                            что подобная реакция организма сама по себе показатель проблем.</p>
                                        <div class="date-link">
                                            <div class="article-date">1 сентбря 2017</div>
                                            <span class="btn-link">Подробнее</span>
                                        </div>
                                    </div>
                                </a>
                                <div class="article-border"></div>
                            </article>
                        </div>
                    </div>
                </div>
                <div>
                    <a href="{{ route('articles', ['loc'=>'ru']) }}" class="button-white">Больше статей</a>
                </div>
            </section>
        </div>
        <aside class="news-med">
            <div class="section-title-meta-icon">
                <h3>Новости медицины</h3>
                <div class="section-meta-icon">
                    <div class="section-icon">
                        <img src="{{ asset('assets') }}/images/title-icons/main-icon-4.png"
                             alt="иконка Новости медицины">
                    </div>
                </div>
            </div>
            <div class="news-med-arts">
                <div class="article-wrap big-news">
                    <article class="news">
                        <a href="single-article.html">
                            <div class="article-img">
                                <img src="{{ asset('assets') }}/images/news/article-big.jpg">
                                <div class="views"><span>2143</span></div>
                            </div>
                            <div class="article-info">
                                <h4 class="article-title">В Украине увеличилась
                                    численность
                                    населения. Больше людей, испытывающих головне боли, предпочитают
                                    "заглушать" их таблетками</h4>
                                <p class="article-category">Статистика минздрава</p>
                                <p class="article-text">Больше людей, испытывающих головне боли, предпочитают
                                    "заглушать" их таблетками, не
                                    задумываясь,
                                    что подобная реакция организма сама по себе показатель проблем. Больше людей,
                                    испытывающих головне боли, предпочитают "заглушать" их таблетками, не задумываясь,
                                    что подобная реакция организма сама по себе показатель проблем.</p>
                                <div class="date-link">
                                    <div class="article-date">1 сентбря 2017</div>
                                    <span class="btn-link">Подробнее</span>
                                </div>
                            </div>
                        </a>
                    </article>
                    <article class="news">
                        <a href="single-article.html">
                            <div class="article-img">
                                <img src="{{ asset('assets') }}/images/news/article.jpg">
                                <div class="views"><span>2143</span></div>
                            </div>
                            <div class="article-info">
                                <h4 class="article-title">В Украине увеличилась
                                    численность
                                    населения</h4>
                                <p class="article-category">Статистика минздрава</p>
                                <p class="article-text">Больше людей, испытывающих головне боли, предпочитают
                                    "заглушать" их таблетками, не
                                    задумываясь,
                                    что подобная реакция организма сама по себе показатель проблем. Больше
                                    людей,
                                    испытывающих головне боли, предпочитают "заглушать" их таблетками, не
                                    задумываясь,
                                    что подобная реакция организма сама по себе показатель проблем.</p>
                                <div class="date-link">
                                    <div class="article-date">1 сентбря 2017</div>
                                    <span class="btn-link">Подробнее</span>
                                </div>
                            </div>
                        </a>
                        <div class="article-border"></div>
                    </article>
                    <article class="news">
                        <a href="single-article.html">
                            <div class="article-img">
                                <img src="{{ asset('assets') }}/images/news/article.jpg">
                                <div class="views"><span>2143</span></div>
                            </div>
                            <div class="article-info">
                                <h4 class="article-title">В Украине увеличилась
                                    численность
                                    населения</h4>
                                <p class="article-category">Статистика минздрава</p>
                                <p class="article-text">Больше людей, испытывающих головне боли, предпочитают
                                    "заглушать" их таблетками, не
                                    задумываясь,
                                    что подобная реакция организма сама по себе показатель проблем. Больше
                                    людей,
                                    испытывающих головне боли, предпочитают "заглушать" их таблетками, не
                                    задумываясь,
                                    что подобная реакция организма сама по себе показатель проблем.</p>
                                <div class="date-link">
                                    <div class="article-date">1 сентбря 2017</div>
                                    <span class="btn-link">Подробнее</span>
                                </div>
                            </div>
                        </a>
                        <div class="article-border"></div>
                    </article>
                    <article class="news">
                        <a href="single-article.html">
                            <div class="article-img">
                                <img src="{{ asset('assets') }}/images/news/article.jpg">
                                <div class="views"><span>2143</span></div>
                            </div>
                            <div class="article-info">
                                <h4 class="article-title">В Украине увеличилась
                                    численность
                                    населения</h4>
                                <p class="article-category">Статистика минздрава</p>
                                <p class="article-text">Больше людей, испытывающих головне боли, предпочитают
                                    "заглушать" их таблетками, не
                                    задумываясь,
                                    что подобная реакция организма сама по себе показатель проблем. Больше
                                    людей,
                                    испытывающих головне боли, предпочитают "заглушать" их таблетками, не
                                    задумываясь,
                                    что подобная реакция организма сама по себе показатель проблем.</p>
                                <div class="date-link">
                                    <div class="article-date">1 сентбря 2017</div>
                                    <span class="btn-link">Подробнее</span>
                                </div>
                            </div>
                        </a>
                        <div class="article-border"></div>
                    </article>
                    <article class="news">
                        <a href="single-article.html">
                            <div class="article-img">
                                <img src="{{ asset('assets') }}/images/news/article.jpg">
                                <div class="views"><span>2143</span></div>
                            </div>
                            <div class="article-info">
                                <h4 class="article-title">В Украине увеличилась
                                    численность
                                    населения</h4>
                                <p class="article-category">Статистика минздрава</p>
                                <p class="article-text">Больше людей, испытывающих головне боли, предпочитают
                                    "заглушать" их таблетками, не
                                    задумываясь,
                                    что подобная реакция организма сама по себе показатель проблем. Больше
                                    людей,
                                    испытывающих головне боли, предпочитают "заглушать" их таблетками, не
                                    задумываясь,
                                    что подобная реакция организма сама по себе показатель проблем.</p>
                                <div class="date-link">
                                    <div class="article-date">1 сентбря 2017</div>
                                    <span class="btn-link">Подробнее</span>
                                </div>
                            </div>
                        </a>
                        <div class="article-border"></div>
                    </article>
                </div>
                <div>
                    <a href="#!" class="button-white">Все новости</a>
                </div>
            </div>
            <div class="section-title-meta-icon">
                <h3>Популярные теги</h3>
                <div class="section-meta-icon">
                    <div class="section-icon">
                        <img src="{{ asset('assets') }}/images/title-icons/main-icon-6.png"
                             alt="иконка Популярные теги">
                    </div>
                </div>
            </div>
            <div class="popular-meta">
                <a href="#!" class="btn-meta">Аспирин</a>
                <a href="#!" class="btn-meta active">Беременность</a>
                <a href="#!" class="btn-meta">Аспирин</a>
                <a href="#!" class="btn-meta">Грипп</a>
                <a href="#!" class="btn-meta">Алергия</a>
                <a href="#!" class="btn-meta">Аспирин</a>
                <a href="#!" class="btn-meta">Грипп</a>
                <a href="#!" class="btn-meta">Грипп</a>
                <a href="#!" class="btn-meta">Алергия</a>
                <a href="#!" class="btn-meta active">Беременность</a>
                <a href="#!" class="btn-meta">Алергия</a>
                <a href="#!" class="btn-meta">Алергия</a>
                <a href="#!" class="btn-meta active">Беременность</a>
                <a href="#!" class="btn-meta">Аспирин</a>
                <a href="#!" class="btn-meta active">Беременность</a>
                <a href="#!" class="btn-meta">Аспирин</a>
                <a href="#!" class="btn-meta">Грипп</a>
                <a href="#!" class="btn-meta">Алергия</a>
                <a href="#!" class="btn-meta">Аспирин</a>
                <a href="#!" class="btn-meta">Аспирин</a>
                <a href="#!" class="btn-meta">Грипп</a>
                <a href="#!" class="btn-meta active">Беременность</a>
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
    <section class="section-down-slider mobile-display-none">
        <div>
            <img src="{{ asset('assets') }}/images/index/down-slider.jpg"
                 style="width: 100%; height: 100%; display: flex;">
        </div>
        <div>
            <img src="{{ asset('assets') }}/images/index/down-slider.jpg"
                 style="width: 100%; height: 100%; display: flex;">
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
                {{--@if(!empty($blocks[5]->fourth))
                    {{ link_to_route('search', $blocks[5]->fourth, ['search' =>$blocks[5]->fourth]) }}
                @endif
                @if(!empty($blocks[5]->fifth))
                    {{ link_to_route('search', $blocks[5]->fifth, ['search' =>$blocks[5]->fifth]) }}
                @endif
                @if(!empty($blocks[5]->sixth))
                    {{ link_to_route('search', $blocks[5]->sixth, ['search' =>$blocks[5]->sixth]) }}
                @endif--}}
                <div class="section-icon">
                    <img src="{{ asset('assets') }}/images/title-icons/main-icon-2.png" alt="иконка Топ статьи">
                </div>
            </div>
        </div>
        <div class="section-interest-art wrap">
            <article class="article-articles">
                <a href="single-article.html">
                    <div class="article-img">
                        <img src="{{ asset('assets') }}/images/index/top-art.jpg">
                        <div class="views"><span>2143</span></div>
                    </div>
                    <div class="article-info">
                        <h4 class="article-title">Очки нам больше никогда не
                            понадобятся!</h4>
                        <p class="article-category">Статистика минздрава</p>
                        <p class="article-text">Больше людей, испытывающих головне боли, предпочитают "заглушать" их
                            таблетками, не
                            задумываясь,
                            что подобная реакция организма сама по себе показатель проблем. Больше людей,
                            испытывающих головне боли, предпочитают "заглушать" их таблетками, не задумываясь,
                            что подобная реакция организма сама по себе показатель проблем.</p>
                        <div class="date-link">
                            <div class="article-date">1 сентбря 2017</div>
                            <span class="btn-link">Подробнее</span>
                        </div>
                    </div>
                </a>
                <div class="article-border"></div>
            </article>
            <article class="article-articles">
                <a href="single-article.html">
                    <div class="article-img">
                        <img src="{{ asset('assets') }}/images/index/top-art.jpg">
                        <div class="views"><span>2143</span></div>
                    </div>
                    <div class="article-info">
                        <h4 class="article-title">Очки нам больше никогда не
                            понадобятся!</h4>
                        <p class="article-category">Статистика минздрава</p>
                        <p class="article-text">Больше людей, испытывающих головне боли, предпочитают "заглушать" их
                            таблетками, не
                            задумываясь,
                            что подобная реакция организма сама по себе показатель проблем. Больше людей,
                            испытывающих головне боли, предпочитают "заглушать" их таблетками, не задумываясь,
                            что подобная реакция организма сама по себе показатель проблем.</p>
                        <div class="date-link">
                            <div class="article-date">1 сентбря 2017</div>
                            <span class="btn-link">Подробнее</span>
                        </div>
                    </div>
                </a>
                <div class="article-border"></div>
            </article>
            <article class="article-articles">
                <a href="single-article.html">
                    <div class="article-img">
                        <img src="{{ asset('assets') }}/images/index/top-art.jpg">
                        <div class="views"><span>2143</span></div>
                    </div>
                    <div class="article-info">
                        <h4 class="article-title">Очки нам больше никогда не
                            понадобятся!</h4>
                        <p class="article-category">Статистика минздрава</p>
                        <p class="article-text">Больше людей, испытывающих головне боли, предпочитают "заглушать" их
                            таблетками, не
                            задумываясь,
                            что подобная реакция организма сама по себе показатель проблем. Больше людей,
                            испытывающих головне боли, предпочитают "заглушать" их таблетками, не задумываясь,
                            что подобная реакция организма сама по себе показатель проблем.</p>
                        <div class="date-link">
                            <div class="article-date">1 сентбря 2017</div>
                            <span class="btn-link">Подробнее</span>
                        </div>
                    </div>
                </a>
                <div class="article-border"></div>
            </article>
            <article class="article-articles">
                <a href="single-article.html">
                    <div class="article-img">
                        <img src="{{ asset('assets') }}/images/index/top-art.jpg">
                        <div class="views"><span>2143</span></div>
                    </div>
                    <div class="article-info">
                        <h4 class="article-title">Очки нам больше никогда не
                            понадобятся!</h4>
                        <p class="article-category">Статистика минздрава</p>
                        <p class="article-text">Больше людей, испытывающих головне боли, предпочитают "заглушать" их
                            таблетками, не
                            задумываясь,
                            что подобная реакция организма сама по себе показатель проблем. Больше людей,
                            испытывающих головне боли, предпочитают "заглушать" их таблетками, не задумываясь,
                            что подобная реакция организма сама по себе показатель проблем.</p>
                        <div class="date-link">
                            <div class="article-date">1 сентбря 2017</div>
                            <span class="btn-link">Подробнее</span>
                        </div>
                    </div>
                </a>
                <div class="article-border"></div>
            </article>
        </div>
        <div>
            <a href="{{ route('articles', ['loc'=>'ru']) }}" class="button-white">Больше статей</a>
        </div>
    </section>
    <!-- end Интересные СТАТЬИ -->
</div>