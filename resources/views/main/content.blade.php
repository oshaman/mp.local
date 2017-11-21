<!-- SLIDER -->
<section class="main-slider">
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
                <a href="search.html" class="button-blue">Подробнее</a>
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
                <a href="search.html" class="button-blue">Подробнее</a>
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
                <a href="search.html" class="button-blue">Подробнее</a>
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
                <a href="search.html" class="button-blue">Все партнеры</a>
            </div>
        </div>
    </div>
</section>
<!-- end НА САЙТЕ -->

<!-- Поиск препаратов -->
<section class="section-product-search">
    <div class="section-title-meta-icon">
        <h3>Поиск препаратов</h3>
        <div class="section-meta-icon">
            <a href="#!">Болеутоляющие</a>
            <a href="#!">Популярные</a>
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
<section>
    <div class="section-title-meta-icon">
        <h3>Топ статьи</h3>
        <div class="section-meta-icon">
            <a href="#!">Аллергия</a>
            <a href="#!">Болеутоляющие</a>
            <a href="#!">Простата</a>
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
        <a href="articles.html" class="button-white">Больше статей</a>
    </div>
</section>
<!-- end ТОП СТАТЬИ -->

<!-- НОВОСТИ -->
<div class="news-aside">
    <div class="content last-commercial">
        <section class="section-last-arts">
            <div class="section-title-meta-icon">
                <h3>Последние статьи</h3>
                <div class="section-meta-icon">
                    <a href="#!">Новости</a>
                    <a href="#!">Препараты</a>
                    <a href="#!">Минздрав</a>
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
                <a href="articles.html" class="button-white">Больше статей</a>
            </div>
        </section>
        <section class="section-commercial-arts">
            <div class="section-title-meta-icon">
                <h3>Коммерчиские статьи</h3>
                <div class="section-meta-icon">
                    <a href="#!">Новости</a>
                    <a href="#!">Препараты</a>
                    <a href="#!">Минздрав</a>
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
                <a href="articles.html" class="button-white">Больше статей</a>
            </div>
        </section>
    </div>
    <aside class="news-med">
        <div class="section-title-meta-icon">
            <h3>Новости медицины</h3>
            <div class="section-meta-icon">
                <div class="section-icon">
                    <img src="{{ asset('assets') }}/images/title-icons/main-icon-4.png" alt="иконка Новости медицины">
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
                    <img src="{{ asset('assets') }}/images/title-icons/main-icon-6.png" alt="иконка Популярные теги">
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
            <a href="promotion.html">
                <img src="{{ asset('assets') }}/images/promotion/main-reclama.jpg">
            </a>
        </div>

    </aside>

</div>
<!-- end НОВОСТИ -->

<!-- Нижний слайдер -->
<section class="section-down-slider">
    <div>
        <img src="{{ asset('assets') }}/images/index/down-slider.jpg" style="width: 100%; height: 100%; display: flex;">
    </div>
    <div>
        <img src="{{ asset('assets') }}/images/index/down-slider.jpg" style="width: 100%; height: 100%; display: flex;">
    </div>


</section>
<!-- end Нижний слайдер -->


<!-- Интересные СТАТЬИ -->
<section>
    <div class="section-title-meta-icon">
        <h3>Интересные статьи</h3>
        <div class="section-meta-icon">
            <a href="#!">Аллергия</a>
            <a href="#!">Беременность</a>
            <a href="#!">Простата</a>
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
        <a href="articles.html" class="button-white">Больше статей</a>
    </div>
</section>
<!-- end Интересные СТАТЬИ -->