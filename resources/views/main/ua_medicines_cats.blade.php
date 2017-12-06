@if(!empty($med_cats))
    @foreach($med_cats as $cat)
        <div class="product-search-column">
            <div class="product-search-column-title">
                <img src="{{ asset('asset') .'/images/showcase/'. $cat->path }}"
                     alt="{{ $cat->alt }}" title="{{ $cat->imgtitle }}">
                <h3>{{ $cat->utitle }}</h3>
            </div>
            @if(!empty($cat->alias_1[0]))
                <article class="article-products">
                    <a href="{{ route('medicine_ua', ['medicine'=>$cat->alias_1[0]->alias]) }}">
                        <div class="article-img">
                            @if(!empty($cat->alias_1[0]->image[0]->path))
                                <img src="{{ asset('asset/images/medicine/main/').'/'.$cat->alias_1[0]->image[0]->path }}"
                                     alt="{{ $cat->alias_1[0]->image[0]->alt or '' }}"
                                     title="{{ $cat->alias_1[0]->image[0]->title or '' }}">
                            @endif
                        </div>
                        <div class="article-info">
                            <h4 class="article-title">{{ $cat->alias_1[0]->title }}</h4>
                        </div>
                    </a>
                </article>
            @endif
            @if(!empty($cat->alias2[0]))
                <article class="article-products mobile-display-none">
                    <a href="{{ route('medicine_ua', ['medicine'=>$cat->alias_2[0]->alias]) }}">
                        <div class="article-img">
                            @if(!empty($cat->alias_2[0]->image[0]->path))
                                <img src="{{ asset('asset/images/medicine/main/').'/'.$cat->alias_2[0]->image[0]->path }}"
                                     alt="{{ $cat->alias_2[0]->image[0]->alt or '' }}"
                                     title="{{ $cat->alias_2[0]->image[0]->title or '' }}">
                            @endif
                        </div>
                        <div class="article-info">
                            <h4 class="article-title">{{ $cat->alias_2[0]->title }}</h4>
                        </div>
                    </a>
                </article>
            @endif
            @if(!empty($cat->alias_3[0]))
                <article class="article-products mobile-display-none">
                    <a href="{{ route('medicine_ua', ['medicine'=>$cat->alias_3[0]->alias]) }}">
                        <div class="article-img">
                            @if(!empty($cat->alias_3[0]->image[0]->path))
                                <img src="{{ asset('asset/images/medicine/main/').'/'.$cat->alias_3[0]->image[0]->path }}"
                                     alt="{{ $cat->alias_3[0]->image[0]->alt or '' }}"
                                     title="{{ $cat->alias_3[0]->image[0]->title or '' }}">
                            @endif
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