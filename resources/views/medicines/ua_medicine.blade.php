@if(!empty($medicine))
    <section class="content">
        <div class="wrap">
            {{--BreadCrumbs--}}
            <div class="bread-crumbs breadcrumbs mobile-display-none" id="breadcrumbs"
                 itemscope itemtype="http://schema.org/BreadcrumbList">
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <a href="{{ route('main', ['loc'=>'ua']) }}" itemprop="item">
                        <span itemprop="name" class="label1">Головна</span>
                        <meta itemprop="position" content="1"/>
                    </a>
                </div>
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <a href="{{ route('search_alpha_u') }}" itemprop="item">
                        <span itemprop="name" class="label1">Пошук препаратів</span>
                        <meta itemprop="position" content="2"/>
                    </a>
                </div>
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <span itemprop="name" class="label1">{{ $medicine->title }}</span>
                    <meta itemprop="position" content="3"/>
                </div>
            </div>
            {{--BreadCrumbs--}}
            <h1 class="head-title">{{ $medicine->title }} - Інструкція</h1>
            <div class="clone-to" data-number="3"></div>
            <div class="product-nav">
                <a class="nav-button-grey active">Офіційна інструкція</a>
                <a href="{{ route('medicine_ua', ['medicine'=>$medicine->alias]) }}"
                   class="nav-button-grey">Адаптована інструкція</a>
                <a href="{{ route('medicine_analog_ua', ['medicine'=>$medicine->alias]) }}"
                   class="nav-button-grey">Аналоги</a>
                <a href="{{ route('medicine_faq_ua', ['medicine'=>$medicine->alias]) }}"
                   class="nav-button-grey">Запитання</a>
            </div>
            <div class="product-nav-img">
                <div class="product-nav-block">
                    <a href="{{ route('medicine_official', ['medicine'=>$medicine->alias]) }}"
                       class="button-blue">Перекласти</a>

                    @include('medicines.ua_anchor', $medicine)

                </div>
                @if($medicine->image->isNotEmpty())
                    <div class="product-slider clone-from" data-number="3">
                        <div class="product-slider-go">
                            @foreach($medicine->image as $image)
                                <div>
                                    <img src="{{ asset('asset/images/medicine/main_ukr/').'/'.$image->path }}"
                                         alt="{{ $image->alt ?? '' }}" title="{{ $image->title ?? '' }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="product-slider clone-from" data-number="3">
                        <div class="product-slider-go">
                            <div>
                                <img src="{{ asset('asset/images/mp.png') }}"
                                     alt="Med Pravda" title="Med Pravda">
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            @include('medicines.ua_content', $medicine)


            <div class="print">
                <a href="{{ route('toprint', ['medicine'=>$medicine->alias, 'vr'=>'adaptive']) }}">
                    <img src="{{ asset('assets') }}/images/main/icons.png" alt="Версія для друку">
                    Версія для друку
                </a>
            </div>
            <div class="product-info-down">
                @if(!empty($medicine->dose))
                    <div id="dozirovka">
                        <h5>Дозування:</h5>
                        <p>{{ $medicine->dose }}</p>
                    </div>
                @endif
                @if(!empty($medicine->fabricator_name->utitle))
                    <div id="proizvoditel">
                        <h5>Виробник:</h5>
                        <a href="{{ route('search_fabricator_u',
                        ['val'=>'A', 'fabricator'=> $medicine->fabricator_name->alias]) }}">
                            <p>{{ $medicine->fabricator_name->utitle }}</p>
                        </a>
                    </div>
                @endif
                @if(!empty($medicine->innname->title))
                    <div id="mhh">
                        <h5>МНН:</h5>
                        <a href="{{ route('search_mnn_u', ['val'=> $medicine->innname->alias]) }}">
                            <p>{{ $medicine->innname->title }}</p>
                        </a>
                    </div>
                @endif
                @if(!empty($medicine->pharmagroup->utitle))
                    <div id="farm-group">
                        <h5>Фарм. група:</h5>
                        <a href="{{ route('search_farm_u', ['val'=>$medicine->pharmagroup->alias]) }}">
                            <p>{{ $medicine->pharmagroup->utitle }}</p>
                        </a>
                    </div>
                @endif
                @if(!empty($medicine->reg))
                    <div id="reg">
                        <h5>Реєстрація:</h5>
                        <p>{{ $medicine->reg }}</p>
                    </div>
                @endif
                @if(!empty($classes))
                    <div id="kod-atx">
                        <h5>Код АТХ:</h5>
                        @foreach($classes as $class=>$name)
                            <a href="{{ route('search_atx_u', ['val'=>$name['class'] ]) }}">
                                <p>{{ $class .' - '. $name['uname'] }}</p>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="SEO-text">

            </div>
        </div>
    </section>
@endif