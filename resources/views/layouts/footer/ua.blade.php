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
                                @if('ua_articles_cat' == Route::currentRouteName() && $cat->alias == Request::segment(2))
                                    <a>{{ $cat->title }}</a>
                                @else
                                    <a href="{{ route('ua_articles_cat', ['cat'=>$cat->alias]) }}">{{ $cat->utitle }}</a>
                                @endif
                            @endforeach
                        @endif
                        @if('about' == Route::currentRouteName())
                            <a>Про нас</a>
                        @else
                            <a href="{{ route('about', ['loc'=>'ua']) }}">Про нас</a>
                        @endif
                        @if('adv' == Route::currentRouteName())
                            <a>Реклама</a>
                        @else
                            <a href="{{ route('adv', ['loc'=>'ua']) }}">Реклама</a>
                        @endif
                        {{--@if('conditions' == Route::currentRouteName())
                            <a>Условия использования сайта</a>
                        @else
                            <a href="{{ route('conditions') }}">Условия использования сайта</a>
                        @endif
                        @if('conditions' == Route::currentRouteName())
                            <a>Соглашение о конфиденциальности</a>
                        @else
                            <a href="{{ route('convention') }}">Соглашение о конфиденциальности</a>
                        @endif--}}
                    </nav>
                    <div class="terms-email mobile-display-none">
                        <a>Условия использования сайта</a>
                        <a>Соглашение о конфиденциальности</a>
                        <a href="mailto:info@medpravda.com.ua" class="e-mail">info@medpravda.com.ua</a>
                    </div>
                </div>
                <div class="footer-column">
                    <h6>Препарати</h6>
                    <div class="meta-btn-footer">
                        @if(!empty($tags))
                            @foreach($tags as $tag)
                                <a href="{{ route('ua_articles_tag', ['tag_alias'=>$tag->alias]) }}"
                                   class="btn-meta">
                                    {{ $tag->name }}
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
            <a href="http://medpravda.com.ua">
                <img src="http://medpravda.com.ua/assets/images/main/logo.png" alt="Логотип МЕД правда"></a>
        </div>
        <div class="copy-block copyright">
            <p>Mедправда это стандартизированным Интернет-изданием, предназначенным для врачей и других
                профессиональных медицинских работников</p>
            <p>Сайт является стандартизированным Интернет-изданием, предназначенным для врачей и других
                профессиональных медицинских работников</p>
            <p>Copyright @ 2010 - 2017 “Ассоциация независимых разработчиков”</p>
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