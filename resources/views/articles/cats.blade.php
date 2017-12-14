<div class="wrap">
    {{--BreadCrumbs--}}
    <div class="bread-crumbs breadcrumbs mobile-display-none" id="breadcrumbs" itemscope
         itemtype="http://schema.org/BreadcrumbList">
        <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
            <a href="{{ route('main') }}" itemprop="item">Главная</a>
            <meta itemprop="position" content="1"/>
        </div>
        <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
            <span itemprop="name" class="label1">Категории</span>
            <meta itemprop="position" content="2"/>
        </div>
    </div>
    {{--BreadCrumbs--}}
    <h1 class="head-title blue-circle">Категории</h1>
</div>
@if(!empty($cats))
    @foreach($cats as $k=>$articles)
        <section>
            <div class="section-title-meta-icon">
                <h3>{{ $articles['cat'] }}</h3>
                <div class="section-meta-icon">

                </div>
            </div>
            <div class="section-interest-art wrap">
                @if(!empty($articles['articles']))
                    @foreach($articles['articles'] as $article)
                        <article class="article-articles">
                            <a href="{{ route('articles',
                                                    ['article_alias'=>$article->alias]) }}">
                                <div class="article-img">
                                    <img src="{{ asset('asset/images/articles/ru/middle').'/'.$article->image->path }}"
                                         alt="{{ $article->image->alt ?? '' }}"
                                         title="{{ $article->image->title ?? ($article->image->alt ?? '') }}">
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
                <a href="{{ route('articles_cat', ['cat_alias'=>$k]) }}"
                   class="button-white">Больше статей</a>
            </div>
        </section>
    @endforeach
@endif