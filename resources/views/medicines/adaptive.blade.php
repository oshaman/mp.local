@if(!empty($medicine))
    <section class="content">
        <div class="wrap">
            {{--BreadCrumbs--}}
            <div class="bread-crumbs breadcrumbs mobile-display-none" id="breadcrumbs"
                 itemscope itemtype="http://schema.org/BreadcrumbList">
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <a href="{{ route('main') }}" itemprop="item">
                        <span itemprop="name" class="label1">Главная</span>
                        <meta itemprop="position" content="1"/>
                    </a>
                </div>
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <a href="{{ route('search') }}" itemprop="item">
                        <span itemprop="name" class="label1">Поиск препаратов</span>
                        <meta itemprop="position" content="2"/>
                    </a>
                </div>
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <a href="{{ route('medicine', ['loc'=>'ru', 'medicine'=>$medicine->alias]) }}" itemprop="item">
                        <span itemprop="name" class="label1">{{ $medicine->title }}</span>
                        <meta itemprop="position" content="3"/>
                    </a>
                </div>
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <span itemprop="name" class="label1">Адаптированная инструкция</span>
                    <meta itemprop="position" content="4"/>
                </div>
            </div>
            {{--BreadCrumbs--}}
            <h1 class="head-title">{{ $medicine->title }} инструкция и цена в аптеках</h1>
            <div class="clone-to" data-number="3"></div>
            <div class="product-nav">
                <a href="{{ route('medicine', ['loc'=>'ru', 'medicine'=>$medicine->alias]) }}" class="nav-button-grey">
                    Официальная инструкция
                </a>
                <a class="nav-button-grey active">Адаптированная инструкция</a>
                <a href="{{ route('medicine_analog', ['medicine'=>$medicine->alias, 'loc'=>'ru']) }}"
                   class="nav-button-grey">Аналоги</a>
                <a href="{{ route('medicine_faq', ['medicine'=>$medicine->alias, 'loc'=>'ru']) }}"
                   class="nav-button-grey">Вопросы</a>
            </div>
            <div class="product-nav-img">
                <div class="product-nav-block">
                    <h2 class="product-title">{{ $medicine->title }} инструкция и цена в аптеках</h2>
                    <a href="{{ route('medicine', ['loc'=>'ua', 'medicine'=>$medicine->alias]) }}" class="button-blue">Перевести</a>
                    <ul class="top-product-nav">
                        @if(!empty($medicine->consist))
                            <li>
                                <img src="{{ asset('assets') }}/images/product-icon/blue-sostav.png" alt="Состав">
                                <a href="#sostav">Состав</a>
                            </li>
                        @endif
                        @if(!empty($medicine->docs_form))
                            <li>
                                <img src="{{ asset('assets') }}/images/product-icon/blue-farm-deistvie.png"
                                     alt="Лекарственная форма">
                                <a href="#lekforma">Лекарственная форма</a>
                            </li>
                        @endif
                        @if(!empty($medicine->physicochemical_char))
                            <li>
                                <img src="{{ asset('assets') }}/images/product-icon/blue-farm-deistvie.png"
                                     alt="Основные физико-химические свойства">
                                <a href="#fizhimsvoistva">Основные физико-химические свойства</a>
                            </li>
                        @endif
                        @if(!empty($medicine->fabricator))
                            <li>
                                <img src="{{ asset('assets') }}/images/product-icon/blue-farm-deistvie.png"
                                     alt="Производитель">
                                <a href="#proizvoditel">Производитель</a>
                            </li>
                        @endif
                        @if(!empty($medicine->addr_fabricator))
                            <li>
                                <img src="{{ asset('assets') }}/images/product-icon/blue-farm-deistvie.png"
                                     alt="Местонахождение производителя">
                                <a href="#adresproizvoditelya">Местонахождение производителя</a>
                            </li>
                        @endif
                        @if(!empty($medicine->pharm_group))
                            <li>
                                <img src="{{ asset('assets') }}/images/product-icon/blue-farm-deistvie.png"
                                     alt="Фармакотерапевтическая группа">
                                <a href="#farmgruppa">Фармакотерапевтическая группа</a>
                            </li>
                        @endif
                        @if(!empty($medicine->pharm_prop))
                            <li>
                                <img src="{{ asset('assets') }}/images/product-icon/blue-farm-deistvie.png"
                                     alt="Фармакологические свойства">
                                <a href="#farmsvoistva">Фармакологические свойства</a>
                            </li>
                        @endif
                        @if(!empty($medicine->indications))
                            <li>
                                <img src="{{ asset('assets') }}/images/product-icon/blue-pokazanie-primemenia.png"
                                     alt="Показания к прменению">
                                <a href="#pokazanij">Показания к применению</a>
                            </li>
                        @endif
                        @if(!empty($medicine->contraindications))
                            <li>
                                <img src="{{ asset('assets') }}/images/product-icon/blue-protivopokazanie.png"
                                     alt="Противопоказания">
                                <a href="#protivipokazaniya">Противопоказания</a>
                            </li>
                        @endif
                        @if(!empty($medicine->security))
                            <li>
                                <img src="{{ asset('assets') }}/images/product-icon/blue-protivopokazanie.png"
                                     alt="Надлежащие меры безопасности при применении">
                                <a href="#bezopastnost">Надлежащие меры безопасности при применении</a>
                            </li>
                        @endif
                        @if(!empty($medicine->application_features))
                            <li>
                                <img src="{{ asset('assets') }}/images/product-icon/blue-protivopokazanie.png"
                                     alt="Особенности применения">
                                <a href="#osobennostprimeneniya">Особенности применения</a>
                            </li>
                        @endif
                        @if(!empty($medicine->pregnancy))
                            <li>
                                <img src="{{ asset('assets') }}/images/product-icon/blue-protivopokazanie.png"
                                     alt="Применение в период беременности или кормления грудью">
                                <a href="#beremennost">Применение в период беременности или кормления грудью</a>
                            </li>
                        @endif
                        @if(!empty($medicine->cars))
                            <li>
                                <img src="{{ asset('assets') }}/images/product-icon/blue-protivopokazanie.png"
                                     alt="Способность влиять на скорость реакции при управлении автотранспортом">
                                <a href="#avto">Способность влиять на скорость реакции при управлении
                                    автотранспортом</a>
                            </li>
                        @endif
                        @if(!empty($medicine->children))
                            <li>
                                <img src="{{ asset('assets') }}/images/product-icon/blue-protivopokazanie.png"
                                     alt="Дети">
                                <a href="#deti">Дети</a>
                            </li>
                        @endif
                        @if(!empty($medicine->app_mode))
                            <li>
                                <img src="{{ asset('assets') }}/images/product-icon/blue-protivopokazanie.png"
                                     alt="Способ применения и дозы">
                                <a href="#premenenieidosa">Способ применения и дозы</a>
                            </li>
                        @endif
                        @if(!empty($medicine->overdose))
                            <li>
                                <img src="{{ asset('assets') }}/images/product-icon/blue-peredoz.png"
                                     alt="Передозировка">
                                <a href="#peredoz">Передозировка</a>
                            </li>
                        @endif
                        @if(!empty($medicine->side_effects))
                            <li>
                                <img src="{{ asset('assets') }}/images/product-icon/blue-pobochnue-deistvie.png"
                                     alt="Побочные действия">
                                <a href="#pobochnie">Побочные действия</a>
                            </li>
                        @endif
                        @if(!empty($medicine->interaction))
                            <li>
                                <img src="{{ asset('assets') }}/images/product-icon/blue-lekarstv-vzaimodeistvie.png"
                                     alt="Лекарственное взаимодействие">
                                <a href="#vzaimodeistvie">Лекарственное взаимодействие</a>
                            </li>
                        @endif
                        @if(!empty($medicine->shelf_life))
                            <li>
                                <img src="{{ asset('assets') }}/images/product-icon/blue-lekarstv-vzaimodeistvie.png"
                                     alt="Срок годности">
                                <a href="#srokgodnosti">Срок годности</a>
                            </li>
                        @endif
                        @if(!empty($medicine->saving))
                            <li>
                                <img src="{{ asset('assets') }}/images/product-icon/blue-lekarstv-vzaimodeistvie.png"
                                     alt="Условия хранения">
                                <a href="#usloviyahraneniya">Условия хранения</a>
                            </li>
                        @endif
                        @if(!empty($medicine->packaging))
                            <li>
                                <img src="{{ asset('assets') }}/images/product-icon/blue-lekarstv-vzaimodeistvie.png"
                                     alt="Упаковка">
                                <a href="#upakovka">Упаковка</a>
                            </li>
                        @endif
                        @if(!empty($medicine->leave_cat))
                            <li>
                                <img src="{{ asset('assets') }}/images/product-icon/blue-lekarstv-vzaimodeistvie.png"
                                     alt="Категория отпуска">
                                <a href="#kategoriyaotpuska">Категория отпуска</a>
                            </li>
                        @endif
                        @if(!empty($medicine->additionally))
                            <li>
                                <img src="{{ asset('assets') }}/images/product-icon/blue-lekarstv-vzaimodeistvie.png"
                                     alt="Дополнительно">
                                <a href="#dopolnitelno">Дополнительно</a>
                            </li>
                        @endif
                    </ul>
                </div>
                @if($medicine->image->isNotEmpty())
                    <div class="product-slider clone-from" data-number="3">
                        <div class="product-slider-go">
                            @foreach($medicine->image as $image)
                                <div>
                                    <img src="{{ asset('asset/images/medicine/main_a/').'/'.$image->path }}"
                                         alt="{{ $image->alt ?? '' }}" title="{{ $image->title ?? '' }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            @include('medicines.content', $medicine)


            <div class="print">
                <a href="#"><img src="{{ asset('assets') }}/images/main/icons.png" alt="Версия для печати">Версия для
                    печати</a>
            </div>
            <div class="product-info-down">
                @if(!empty($medicine->dose))
                    <div id="dozirovka">
                        <h5>Дозировка:</h5>
                        <p>{{ $medicine->dose }}</p>
                    </div>
                @endif
                @if(!empty($medicine->fabricator_name->title))
                    <div id="proizvoditel">
                        <h5>Производитель:</h5>
                        <a href="{{ route('search_fabricator',
                        ['loc'=>'ru', 'val'=>'A', 'fabricator'=> $medicine->fabricator_name->alias]) }}">
                            <p>{{ $medicine->fabricator_name->title }}</p>
                        </a>
                    </div>
                @endif
                @if(!empty($medicine->innname->title))
                    <div id="mhh">
                        <h5>МНН:</h5>
                        <a href="{{ route('search_mnn', ['loc'=>'ru', 'val'=> $medicine->innname->alias]) }}">
                            <p>{{ $medicine->innname->title }}</p>
                        </a>
                    </div>
                @endif
                @if(!empty($medicine->pharmagroup->title))
                    <div id="farm-group">
                        <h5>Фарм. группа:</h5>
                        <a href="{{ route('search_farm', ['loc'=>'ru', 'val'=>$medicine->pharmagroup->alias]) }}">
                            <p>{{ $medicine->pharmagroup->title }}</p>
                        </a>
                    </div>
                @endif
                @if(!empty($medicine->reg))
                    <div id="reg">
                        <h5>Регистрация:</h5>
                        <p>{{ $medicine->reg }}</p>
                    </div>
                @endif
                @if(!empty($classes))
                    <div id="kod-atx">
                        <h5>Код АТХ:</h5>
                        @foreach($classes as $class=>$name)
                            <a href="{{ route('search_atx', ['loc'=>'ru', 'val'=>$name['class'] ]) }}">
                                <p>{{ $class .' - '. $name['name'] }}</p>
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