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
            <h3>Поиск препаратов:&nbsp;<a href="#!">{{ $search .' ('.count($titles ?? 0).')'}}</a></h3>
        @endif
        <div class="section-meta-icon">
            <div class="section-icon">
                <img src="{{ asset('assets') }}/images/title-icons/found.png" alt="иконка Также ищут">
            </div>
        </div>
    </div>
    <div class="wrap">
        <div class="product-analog">
            <h2 class="product-title">Сортировка препаратов по алфавиту</h2>
            <div class="product-nav product-nav-analog">
                <a href="{{ route('search_alpha', 'ru') }}" class="nav-button-grey">По алфавиту</a>
                <a href="{{ route('search_fabricator', 'ru') }}" class="nav-button-grey">По производителю</a>
                <a href="{{ route('search_mnn', 'ru') }}" class="nav-button-grey">По международному названию (МНН)</a>
                <a href="{{ route('search_atx', 'ru') }}" class="nav-button-grey">По АТХ-классификации</a>
                <a href="{{ route('search_farm', 'ru') }}" class="nav-button-grey">По фармакотерапевтической группе</a>
                <a href="{{ route('search_substance', 'ru') }}" class="nav-button-grey">По действующему веществу</a>
            </div>
        </div>

        @if(!empty($titles))
            @foreach($titles as $title)
                <div class="search-result">
                    <a href="{{ route('medicine', ['loc'=>'ru', 'medicine'=> $title->alias]) }}">
                        <h3>{{ $title->title }}</h3></a>
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
    @if(!empty($titles))
        <section>
            <div class="section-title-meta-icon">
                <h3>Поиск статей:&nbsp;<a href="#!">Ангина (1475)</a></h3>
                <div class="section-meta-icon">
                    <div class="section-icon">
                        <img src="{{ asset('assets') }}/images/title-icons/main-icon-7.png"
                             alt="иконка Коммерчиские статьи">
                    </div>
                </div>
            </div>
            <div class="two-column-articles article-wrap section-interest-art">
                <div class="two-big-news">
                    <article class="news">
                        <a href="#!">
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
                        <a href="#!">
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
                <div class="small-news">

                    <article class="news">
                        <a href="#!">
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
                        <a href="#!">
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
                        <a href="#!">
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
                        <a href="#!">
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
                        <a href="#!">
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
                        <a href="#!">
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
            <div>
                <a href="#!" class="button-white">Больше статей</a>
            </div>
        </section>
    @endif
</section>