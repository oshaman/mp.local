<aside class="right-section">
    <div class="banner-reklama order-first">
        <a href="promotion.html"><img class="mobile-display-none"
                                      src="{{ asset('assets') }}/images/promotion/banner1.jpg" alt="Aloe vera">
            <img class="banner-reklama-mobile" src="{{ asset('assets') }}/images/promotion/promo-aside-300-300.jpg"
                 alt="Aloe vera"></a>
    </div>
    <div class="desktop-display-none search-too-aside order-second">

        <div class="section-title-meta-icon desktop-display-none">
            <h3>Також шукають</h3>
            <div class="section-meta-icon">
                <div class="section-icon">
                </div>
            </div>
        </div>
        <div class="wrap">
            @if(!empty($medicines) && $medicines->isNotEmpty())
                @foreach($medicines as $medicine)
                    <article class="article-products">
                        <a href="{{ route('medicine_ua', ['medicine'=>$medicine->alias]) }}">
                            <div class="article-img">
                                @if(!empty($medicine->image[0]->path))
                                    <img src="{{ asset('asset/images/medicine/main_ukr/').'/'.$medicine->image[0]->path }}"
                                         alt="{{ $medicine->image[0]->alt or '' }}"
                                         title="{{ $medicine->image[0]->title or '' }}">
                                @else
                                    <img src="{{ asset('asset/images/mp.png') }}"
                                         alt="Med Pravda" title="Med Pravda">
                                @endif
                            </div>
                            <div class="article-info">
                                <h4 class="article-title">{{ $medicine->title }}</h4>
                                <div class="date-link">
                                    <span class="btn-link">Докладніше</span>
                                </div>
                            </div>
                        </a>
                    </article>
                @endforeach
            @endif
            <div>
                <a href="{{ route('sort') }}" class="button-white">Більше препаратів</a>
            </div>
        </div>
    </div>

    <div class="article-wrap order-second">
        <div class="section-title-meta-icon desktop-display-none">
            <h3>Топ статті</h3>

        </div>
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
                            <div class="article-text">{!! str_limit($article->content, 312) !!}</div>
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
    <div class="banner-reklama order-fourth">
        <a href="promotion.html"><img class="mobile-display-none"
                                      src="{{ asset('assets') }}/images/promotion/banner2.jpg"
                                      alt="Aloe vera">
            <img class="banner-reklama-mobile" src="{{ asset('assets') }}/images/promotion/promo-aside-300-300.jpg"
                 alt="Aloe vera"></a>
    </div>
    <div class="article-wrap order-third">
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
                            <div class="article-text">{!! str_limit($article->content, 312) !!}</div>
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
</aside>