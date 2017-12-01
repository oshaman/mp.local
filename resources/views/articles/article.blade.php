@if(!empty($article))
    {{--{{ dump($article) }}--}}
    <section class="content">
        <div class="wrap">
            {{--BreadCrumbs--}}
            <div class="bread-crumbs breadcrumbs mobile-display-none" id="breadcrumbs" itemscope
                 itemtype="http://schema.org/BreadcrumbList">
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <a href="{{ route('main') }}" itemprop="item">Главная</a>
                    <meta itemprop="position" content="1"/>
                </div>
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <a href="{{ route('articles_cat', ['cat_alias'=>$article->category->alias]) }}"
                       itemprop="item">{{ $article->category->title }}</a>
                    <meta itemprop="position" content="2"/>
                </div>
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <span itemprop="name" class="label1">{{ $article->title ?? '' }}</span>
                    <meta itemprop="position" content="3"/>
                </div>
            </div>
            {{--BreadCrumbs--}}
            <div class="single-article-info">
                <h1 class="head-title blue-circle">{{ $article->title ?? '' }}</h1>
                <div class="date-link">
                    <div class="article-date">
                        {{ $article->created_at->format('d')
                                        . ' '  . trans('ru.'.$article->created_at->format('m'))
                                        . ' '  . $article->created_at->format('Y')
                                }}
                    </div>
                    <div class="views"><span>{{ $article->view ?? '' }}</span></div>
                </div>
                <div class="admin-content">
                    <div class="full-width-image">
                        <img src="{{ asset('asset').'/images/articles/ru/middle/'.$article->image->path }}"
                             alt="{{ $article->image->alt }}" title="{{ $article->image->title }}">
                    </div>
                    {{--Main Content--}}
                    {!! $article->content !!}
                    {{--Main Content--}}
                </div>
            </div>
            <div class="down-meta-share">
                <div class="top-meta">
                    <span class="meta-title">Популярные теги:</span>
                    @if(!empty($article->tags) && $article->tags->isNotEmpty())
                        @foreach($article->tags as $tag)
                            <a href="{{ route('articles_tag', ['tag_alias'=>$tag->alias]) }}"
                               class="btn-meta">
                                {{ $tag->name }}
                            </a>
                        @endforeach
                    @endif
                </div>
                <div class="share">
                    <span>Поделится</span>
                    <a href="!#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
                    <a href="!#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></div>
            </div>
        </div>
        <section class="section-last-arts">
            <div class="section-title-meta-icon">
                <h3>Другие статьи</h3>
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
                    @if(null != $same[0])
                        <div class="left-column big-news">
                            <article class="news">
                                <a href="{{ route('articles', ['article_alias'=>$same[0]->alias]) }}">
                                    <div class="article-img">
                                        <img src="{{ asset('asset').'/images/articles/ru/middle/'.$same[0]->image->path }}"
                                             alt="{{ $same[0]->image->alt }}" title="{{ $same[0]->image->title }}">
                                        <div class="views"><span>{{ $same[0]->view }}</span></div>
                                    </div>
                                    <div class="article-info">
                                        <h4 class="article-title">{{ $same[0]->title }}</h4>
                                        <div class="article-text">{!!  str_limit($same[0]->content, 256) !!}</div>
                                        <div class="date-link">
                                            <div class="article-date">
                                                {{ $same[0]->created_at->format('d')
                                                    . ' '  . trans('ru.'.$same[0]->created_at->format('m'))
                                                    . ' '  . $same[0]->created_at->format('Y')
                                                }}
                                            </div>
                                            <span class="btn-link">Подробнее</span>
                                        </div>
                                    </div>
                                </a>
                                <div class="article-border"></div>
                            </article>
                        </div>
                    @endif
                    <div class="right-column">
                        @if(null != $same[0])
                            @foreach($same as $item)
                                @continue($loop->first)
                                <article class="news">
                                    <a href="{{ route('articles', ['article_alias'=>$item->alias]) }}">
                                        <div class="article-img">
                                            <img src="{{ asset('asset').'/images/articles/ru/small/'.$item->image->path }}"
                                                 alt="{{ $item->image->alt }}" title="{{ $item->image->title }}">
                                            <div class="views"><span>{{ $item->view }}</span></div>
                                        </div>
                                        <div class="article-info">
                                            <h4 class="article-title">{{ $item->title }}</h4>
                                            {{--<div class="article-text"></div>--}}
                                            <div class="date-link">
                                                <div class="article-date">
                                                    {{ $item->created_at->format('d')
                                                        . ' '  . trans('ru.'.$item->created_at->format('m'))
                                                        . ' '  . $item->created_at->format('Y')
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
                <a href="{{ route('articles_cat', ['cat_alias'=>$article->category->alias]) }}"
                   class="button-white">Больше статей</a>
            </div>
        </section>
        <div class="SEO-text">

        </div>

    </section>
@endif