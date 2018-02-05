<footer>
    <div class="minzdrav">
        <img src="{{ asset('assets') }}/images/main/minzdrav.png">
    </div>

    <div class="footer-content">
        <div class="footer-column-reklama mobile-display-none">
            <div class="footer-banner-reklama">
                <a href="#!">
                    <img src="{{ asset('assets') }}/images/promotion/reklama-footer.jpg" alt="Диарея">
                </a>
            </div>
        </div>
        <div class="footer-column-copyright">
            <div class="footer-three-column">
                <div class="footer-column mobile-display-none">
                    <h6>Теги</h6>
                    <div class="meta-btn-footer">
                        @if(!empty($tags))
                            @foreach($tags as $tag)
                                <a href="{{ route('ua_articles_tag', ['tag_alias'=>$tag->alias]) }}"
                                   class="btn-meta">
                                    {{ $tag->uname }}
                                </a>
                            @endforeach
                        @endif
                    </div>
                    <div class="phone-footer">
                        <a href="tel:+380445455441">+38 (044) 545-5441</a>
                        <a href="tel:+380445455441">+38 (044) 545-5441</a>
                    </div>
                </div>
                <div class="footer-column">
                    <h6>Меню</h6>
                    <nav class="footer-menu">
                        @if(!empty($cats))
                            @foreach($cats as $cat)
                                @continue('top-stati' == $cat->alias)
                                @if('ua_articles_cat' == Route::currentRouteName() && $cat->alias == Request::segment(4))
                                    <a>{{ $cat->title }}</a>
                                @else
                                    <a href="{{ route('ua_articles_cat', ['cat'=>$cat->alias]) }}">{{ $cat->utitle }}</a>
                                @endif
                            @endforeach
                        @endif
                        @if('ua_about' == Route::currentRouteName())
                            <a>Про нас</a>
                        @else
                            <a href="{{ route('ua_about') }}">Про нас</a>
                        @endif
                        @if('ua_adv' == Route::currentRouteName())
                            <a>Реклама</a>
                        @else
                            <a href="{{ route('ua_adv') }}">Реклама</a>
                        @endif
                    </nav>
                    <div class="terms-email mobile-display-none">
                        @if('ua_conditions' == Route::currentRouteName())
                            <a>Умови використання сайту</a>
                        @else
                            <a href="{{ route('ua_conditions') }}">Умови використання сайту</a>
                        @endif
                        @if('ua_convention' == Route::currentRouteName())
                            <a>Угода про конфіденційність</a>
                        @else
                            <a href="{{ route('ua_convention') }}">Угода про конфіденційність</a>
                        @endif
                        <a href="mailto:info@medpravda.com.ua" class="e-mail">info@medpravda.com.ua</a>
                    </div>
                </div>
                <div class="footer-column">
                    <h6>Препарати</h6>
                    <div class="meta-btn-footer">
                        @if(!empty($med_tags))
                            @foreach($med_tags as $tag)
                                <a href="{{ route('medicine_ua', ['medicine'=>$tag->alias]) }}"
                                   class="btn-meta">
                                    {{ $tag->title }}
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-logo">
        <div class="copy-block logo">
            @if('main' == Route::currentRouteName())
                <img src="{{ asset('assets') }}/images/main/logo_ua.png" alt="Логотип МЕД правда"></a>
            @else
                <a href="{{ route('main') }}">
                    <img src="{{ asset('assets') }}/images/main/logo_ua.png" alt="Логотип МЕД правда"></a>
            @endif
        </div>
        <div class="copy-block copyright">
            @if(!empty($copyright))
                {!! $copyright->text !!}
            @endif
        </div>
        <div class="copy-block fresh">
            <div class="created">САЙТ РАЗРАБОТАН</div>
            <a href="http://freshweb.agency/?utm_source=our-sites&utm_medium=medpravda" target="_blank">
                <div class="fresh-logo">
                    <span>F</span><span>R</span><span>E</span><span>S</span><span>H</span></div>
            </a>
            <div class="creative">CREATIVE WEB AGENCY</div>
        </div>
    </div>
    <a class="totop totop-img">
        <img src="{{ asset('assets') }}/images/main/totop.png">
    </a>
    <div class="totop totop-color">
        <div class="totop-background">
            <div class="line"></div>
        </div>
    </div>

</footer>