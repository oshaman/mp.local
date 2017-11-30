<section class="content page-articles">
    <div class="wrap">
        {{--BreadCrumbs--}}
        <div class="bread-crumbs breadcrumbs mobile-display-none" id="breadcrumbs" itemscope
             itemtype="http://schema.org/BreadcrumbList">
            <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                <a href="{{ route('main') }}" itemprop="item">Главная</a>
                <meta itemprop="position" content="1"/>
            </div>
            <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                <span itemprop="name" class="label1">{{ $cat->title ?? ($tag->name ?? '') }}</span>
                <meta itemprop="position" content="2"/>
            </div>
        </div>
        {{--BreadCrumbs--}}
        <h1 class="head-title blue-circle">{{ $cat->title ?? ($tag->name ?? '') }}</h1>
    </div>
    @if(!empty($articles))
        <div class="big-news margin-minus all-big-news">
            <article class="news">
                <a href="{{ route('articles', ['loc'=>'ru', 'article_alias'=>$articles[0]->alias]) }}">
                    <div class="article-img">
                        @if(!empty($articles[0]->image->path))
                            <img src="{{ asset('asset').'/images/articles/ru/main/'.$articles[0]->image->path }}"
                                 alt="{{ $articles[0]->image->alt }}" title="{{ $articles[0]->image->title }}">
                        @else
                            <img src="{{ asset('asset')}}/images/articles/mp.png"
                                 alt="MedPravda" title="MedPravda">
                        @endif
                        <div class="views"><span>{{ $articles[0]->view }}</span></div>
                    </div>
                    <div class="article-info">
                        <h4 class="article-title">{{ $articles[0]->title }}</h4>
                        <p class="article-category">Статистика минздрава</p>
                        <div class="article-text">{!! str_limit($articles[0]->content, 312) !!}</div>
                        <div class="date-link">
                            <div class="article-date">
                                {{ $articles[0]->created_at->format('d')
                                        . ' '  . trans('ru.'.$articles[0]->created_at->format('m'))
                                        . ' '  . $articles[0]->created_at->format('Y')
                                }}
                            </div>
                            <span class="btn-link">
                                Подробнее
                            </span>
                        </div>
                    </div>
                </a>
            </article>
        </div>
        <div class="two-column-articles article-wrap section-interest-art">
            <div class="two-big-news">
                @foreach($articles as $article)
                    @continue($loop->first)
                    <article class="news">
                        <a href="{{ route('articles', ['loc'=>'ru', 'article_alias'=>$article->alias]) }}">
                            <div class="article-img">
                                @if(!empty($article->image->path))
                                    <img src="{{ asset('asset').'/images/articles/ru/middle/'.$article->image->path }}"
                                         alt="{{ $article->image->alt }}" title="{{ $article->image->title }}">
                                @else
                                    <img src="{{ asset('asset')}}/images/articles/mp.png"
                                         alt="MedPravda" title="MedPravda">
                                @endif
                                <div class="views"><span>{{ $article->view }}</span></div>
                            </div>

                            <div class="article-info">
                                <h4 class="article-title">{{ $article->title }}</h4>
                                <p class="article-category">Статистика минздрава</p>
                                <div class="article-text">{!! str_limit($article->content, 156) !!}</div>
                                <div class="date-link">
                                    <div class="article-date">
                                        {{ $article->created_at->format('d')
                                                . ' '  . trans('ru.'.$article->created_at->format('m'))
                                                . ' '  . $article->created_at->format('Y')
                                        }}
                                    </div>
                                    <span class="btn-link">
                                    Подробнее
                                </span>
                                </div>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>
        </div>
    @endif



    @if(is_object($articles) && !empty($articles->lastPage()) && $articles->lastPage() > 1)
        <div class="articles-pagination">
            @if($articles->lastPage() > 1)
                @if($articles->currentPage() !== 1)
                    <a href="{{ $articles->url(($articles->currentPage() - 1)) }}" class="back">Назад</a>
                @endif
                @if($articles->currentPage() >= 3)
                    <a href="{{ $articles->url($articles->url(1)) }}" class="pagin-number">1</a>
                @endif
                @if($articles->currentPage() >= 4)
                    <a>&nbsp;&nbsp;&nbsp;.&nbsp;.&nbsp;.&nbsp;&nbsp;&nbsp;</a>
                @endif
                @if($articles->currentPage() !== 1)
                    <a href="{{ $articles->url($articles->currentPage()-1) }}"
                       class="pagin-number">{{ $articles->currentPage()-1 }}</a>
                @endif
                <a class="active-pagin-number pagin-number">{{ $articles->currentPage() }}</a>
                @if($articles->currentPage() !== $articles->lastPage())
                    <a href="{{ $articles->url($articles->currentPage()+1) }}"
                       class="pagin-number">{{ $articles->currentPage()+1 }}</a>
                @endif
                @if($articles->currentPage() <= ($articles->lastPage()-3))
                    <a>&nbsp;&nbsp;&nbsp;.&nbsp;.&nbsp;.&nbsp;&nbsp;&nbsp;</a>
                @endif
                @if($articles->currentPage() <= ($articles->lastPage()-2))
                    <a href="{{ $articles->url($articles->lastPage()) }}"
                       class="pagin-number">{{ $articles->lastPage() }}</a>
                @endif
                @if($articles->currentPage() !== $articles->lastPage())
                    <a rel="next" href="{{ $articles->url(($articles->currentPage() + 1)) }}" class="forward">
                        Вперед
                    </a>
                @endif

            @endif
        </div>
    @endif

    <div class="SEO-text">

    </div>
</section>