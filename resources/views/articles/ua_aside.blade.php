<aside class="right-section">
    <div class="">
        <div class="banner-reklama order-first">
            <a href="#!"><img src="{{ asset('assets') }}/images/promotion/promo-aside-300-300.jpg" alt="Aloe vera"></a>
        </div>
        <div class="section-title-meta-icon border-top-none">
            @if(!empty($articles[0]) && (5 != $articles[0]->category_id))
                <h3>Інші статті</h3>
            @else
                <h3>Топ статті</h3>
            @endif
            <div class="section-meta-icon">
                <div class="section-icon">
                    <img src="{{ asset('assets') }}/images/title-icons/main-icon-4.png" alt="иконка Новости медицины">
                </div>
            </div>
        </div>
        <div class="news-med-arts">
            <div class="article-wrap big-news">
                @if(!empty($articles) && $articles->isNotEmpty())
                    @foreach($articles as $article)
                        @continue($loop->index>3)
                        <article class="news">
                            <a href="{{ route('ua_articles', ['ua_article_alias'=>$article->alias]) }}">
                                <div class="article-img">
                                    <img src="{{ asset('asset').'/images/articles/ua/middle/'.$article->image->path }}"
                                         alt="{{ $article->image->alt }}" title="{{ $article->image->title }}">
                                    <div class="views"><span>{{ $article->view }}</span></div>
                                </div>
                                <div class="article-info">
                                    <h4 class="article-title">{{ $article->title }}</h4>
                                    <p class="article-category">{{ str_limit($article->description, 24) }}</p>
                                    <div class="article-text">{{ $article->description }}</div>
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
                @if(!empty($articles[0]) && (5 != $articles[0]->category_id))
                    <a href="{{ route('ua_articles') }}" class="button-white">Всі новини</a>
                @else
                    <a href="{{ route('ua_top_articles') }}" class="button-white">Всі новини</a>
                @endif
            </div>
        </div>
    </div>
    <div class="banner-reklama order-fourth">
        <a href="#!"><img src="{{ asset('assets') }}/images/promotion/promo-aside-300-300.jpg" alt="Dentalcare"></a>
    </div>
    <div class="order-third">
        <div class="section-title-meta-icon">
            @if(!empty($articles[0]) && (5 != $articles[0]->category_id))
                <h3>Інші статті</h3>
            @else
                <h3>Топ статті</h3>
            @endif
            <div class="section-meta-icon">
                <div class="section-icon">
                    <img src="{{ asset('assets') }}/images/title-icons/main-icon-2.png" alt="иконка Топ статьи">
                </div>
            </div>
        </div>
        <div class="news-med-arts">
            <div class="article-wrap big-news">
                @if(!empty($articles) && $articles->isNotEmpty())
                    @foreach($articles as $article)
                        @continue($loop->index<4)
                        <article class="news">
                            <a href="{{ route('ua_articles', ['ua_article_alias'=>$article->alias]) }}">
                                <div class="article-img">
                                    <img src="{{ asset('asset').'/images/articles/ua/middle/'.$article->image->path }}"
                                         alt="{{ $article->image->alt }}" title="{{ $article->image->title }}">
                                    <div class="views"><span>{{ $article->view }}</span></div>
                                </div>
                                <div class="article-info">
                                    <h4 class="article-title">{{ $article->title }}</h4>
                                    <p class="article-category">{{ str_limit($article->description, 24) }}</p>
                                    <div class="article-text">{{ $article->description }}</div>
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
                @if(!empty($articles[0]) && (5 != $articles[0]->category_id))
                    <a href="{{ route('ua_articles') }}" class="button-white">Всі новини</a>
                @else
                    <a href="{{ route('ua_top_articles') }}" class="button-white">Всі новини</a>
                @endif
            </div>
        </div>
    </div>
    <div class="mobile-display-none">
        <div class="section-title-meta-icon">
            <h3>Популярні тематики</h3>
            <div class="section-meta-icon">
                <div class="section-icon">
                    <img src="{{ asset('assets') }}/images/title-icons/main-icon-6.png" alt="иконка Популярные теги">
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
    </div>
</aside>