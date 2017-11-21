@if(!empty($med_cats))
    @foreach($med_cats as $cat)
        <div class="product-search-column">
            <div class="product-search-column-title">
                @switch($loop->iteration)
                    @case(1)
                    <img src="{{ asset('assets') }}/images/title-icons/main-icon-blue-allerg.png">
                    @break

                    @case(2)
                    <img src="{{ asset('assets') }}/images/title-icons/main-icon-blue-gastr.png">
                    @break
                    @case(3)
                    <img src="{{ asset('assets') }}/images/title-icons/main-icon-blue-pain.png">
                    @break
                    @case(4)
                    <img src="{{ asset('assets') }}/images/title-icons/main-icon-blue-allerg.png">
                    @break
                    @case(5)
                    <img src="{{ asset('assets') }}/images/title-icons/main-icon-blue-gastr.png">
                    @break

                    @default
                    <img src="{{ asset('assets') }}/images/title-icons/main-icon-blue-pain.png">
                @endswitch
                <h3>{{ $cat->title }}</h3>
            </div>
            @if(!empty($cat->alias_1[0]))
                <article class="article-products">
                    <a href="{{ route('medicine', ['loc'=>'ru', 'medicine'=>$cat->alias_1[0]->alias]) }}">
                        <div class="article-img">
                            @if(!empty($cat->alias_1[0]->image[0]->path))
                                <img src="{{ asset('asset/images/medicine/main/').'/'.$cat->alias_1[0]->image[0]->path }}"
                                     alt="{{ $cat->alias_1[0]->image[0]->alt or '' }}"
                                     title="{{ $cat->alias_1[0]->image[0]->title or '' }}">
                            @endif
                            <div class="views"><span>{{ $cat->alias_1[0]->view }}</span></div>
                        </div>
                        <div class="article-info">
                            <h4 class="article-title">{{ $cat->alias_1[0]->title }}</h4>
                            {{--<p class="article-category">Статистика минздрава</p>
                            <p class="article-text">Больше людей, испытывающих головне боли, предпочитают "заглушать" их
                                таблетками, не
                                задумываясь,
                                что подобная реакция организма сама по себе показатель проблем. Больше людей,
                                испытывающих головне боли, предпочитают "заглушать" их таблетками, не задумываясь,
                                что подобная реакция организма сама по себе показатель проблем.</p>
                            <div class="date-link">
                                <div class="article-date">1 сентбря 2017</div>
                                <span class="btn-link">Подробнее</span>
                            </div>--}}
                        </div>
                    </a>
                </article>
            @endif
            @if(!empty($cat->alias2[0]))
                <article class="article-products">
                    <a href="{{ route('medicine', ['loc'=>'ru', 'medicine'=>$cat->alias_2[0]->alias]) }}">
                        <div class="article-img">
                            @if(!empty($cat->alias_2[0]->image[0]->path))
                                <img src="{{ asset('asset/images/medicine/main/').'/'.$cat->alias_2[0]->image[0]->path }}"
                                     alt="{{ $cat->alias_2[0]->image[0]->alt or '' }}"
                                     title="{{ $cat->alias_2[0]->image[0]->title or '' }}">
                            @endif
                            <div class="views"><span>{{ $cat->alias_2[0]->view }}</span></div>
                        </div>
                        <div class="article-info">
                            <h4 class="article-title">{{ $cat->alias_2[0]->title }}</h4>
                        </div>
                    </a>
                </article>
            @endif
            @if(!empty($cat->alias_3[0]))
                <article class="article-products">
                    <a href="{{ route('medicine', ['loc'=>'ru', 'medicine'=>$cat->alias_3[0]->alias]) }}">
                        <div class="article-img">
                            @if(!empty($cat->alias_3[0]->image[0]->path))
                                <img src="{{ asset('asset/images/medicine/main/').'/'.$cat->alias_3[0]->image[0]->path }}"
                                     alt="{{ $cat->alias_3[0]->image[0]->alt or '' }}"
                                     title="{{ $cat->alias_3[0]->image[0]->title or '' }}">
                            @endif
                            <div class="views"><span>{{ $cat->alias_3[0]->view }}</span></div>
                        </div>
                        <div class="article-info">
                            <h4 class="article-title">{{ $cat->alias_3[0]->title }}</h4>
                        </div>
                    </a>
                </article>
            @endif
        </div>
    @endforeach
@endif