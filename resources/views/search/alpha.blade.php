<section class="content">
    <div class="wrap">
        {{--BreadCrumbs--}}
        <div class="bread-crumbs breadcrumbs mobile-display-none" id="breadcrumbs" itemscope
             itemtype="http://schema.org/BreadcrumbList">
            <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                <a href="{{ route('main') }}" itemprop="item">Главная</a>
                <meta itemprop="position" content="1"/>
            </div>
            @if(!empty($letter))
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <a href="{{ route('search_alpha') }}" itemprop="item">Сортировка по алфавиту</a>
                    <meta itemprop="position" content="2"/>
                </div>
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <span>{{ $letter }}</span>
                    <meta itemprop="position" content="3"/>
                </div>
            @else
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <span itemprop="name" class="label1">Сортировка по алфавиту</span>
                    <meta itemprop="position" content="2"/>
                </div>
            @endif
        </div>
        {{--BreadCrumbs--}}
        <h1 class="product-title">Сортировка по:</h1>

        @include('search.nav')
    </div>
    <div class="section-title-meta-icon">
        <h3>
            Сортировка препаратов по алфавиту:&nbsp;
            @if(!empty($letter))
                <a>{{ $letter }}</a>
            @endif
        </h3>
        <div class="section-meta-icon">
            <div class="section-icon">
                <img src="{{ asset('assets') }}/images/title-icons/found.png" alt="иконка Также ищут">
            </div>
        </div>
    </div>
    <div class="wrap">
        <div class="product-analog">
            <div class="search-alfavit">
                <div class="search-alfavit-column">
                    <div class="search-left-content">
                        <div class="first-alfavit">
                            <a href="{{ route('search_alpha', ['val'=>'5']) }}"
                               class="nav-button-grey">5</a>
                            <a href="{{ route('search_alpha', ['val'=>'A']) }}"
                               class="nav-button-grey">A</a>
                            <a href="{{ route('search_alpha', ['val'=>'B']) }}"
                               class="nav-button-grey">B</a>
                            <a href="{{ route('search_alpha', ['val'=>'C']) }}"
                               class="nav-button-grey">C</a>
                            <a href="{{ route('search_alpha', ['val'=>'D']) }}"
                               class="nav-button-grey">D</a>
                            <a href="{{ route('search_alpha', ['val'=>'E']) }}"
                               class="nav-button-grey">E</a>
                            <a href="{{ route('search_alpha', ['val'=>'F']) }}"
                               class="nav-button-grey">F</a>
                            <a href="{{ route('search_alpha', ['val'=>'G']) }}"
                               class="nav-button-grey">G</a>
                            <a href="{{ route('search_alpha', ['val'=>'H']) }}"
                               class="nav-button-grey">H</a>
                            <a href="{{ route('search_alpha', ['val'=>'I']) }}"
                               class="nav-button-grey">I</a>
                            <a href="{{ route('search_alpha', ['val'=>'J']) }}"
                               class="nav-button-grey">J</a>
                            <a href="{{ route('search_alpha', ['val'=>'K']) }}"
                               class="nav-button-grey">K</a>
                            <a href="{{ route('search_alpha', ['val'=>'L']) }}"
                               class="nav-button-grey">L</a>
                            <a href="{{ route('search_alpha', ['val'=>'M']) }}"
                               class="nav-button-grey">M</a>
                            <a href="{{ route('search_alpha', ['val'=>'N']) }}"
                               class="nav-button-grey">N</a>
                            <a href="{{ route('search_alpha', ['val'=>'O']) }}"
                               class="nav-button-grey">O</a>
                            <a href="{{ route('search_alpha', ['val'=>'P']) }}"
                               class="nav-button-grey">P</a>
                            <a href="{{ route('search_alpha', ['val'=>'R']) }}"
                               class="nav-button-grey">R</a>
                            <a href="{{ route('search_alpha', ['val'=>'S']) }}"
                               class="nav-button-grey">S</a>
                            <a href="{{ route('search_alpha', ['val'=>'T']) }}"
                               class="nav-button-grey">T</a>
                            <a href="{{ route('search_alpha', ['val'=>'U']) }}"
                               class="nav-button-grey">U</a>
                            <a href="{{ route('search_alpha', ['val'=>'V']) }}"
                               class="nav-button-grey">V</a>
                            <a href="{{ route('search_alpha', ['val'=>'W']) }}"
                               class="nav-button-grey">W</a>
                        </div>
                        <div class="second-alfavit">
                            <a href="{{ route('search_alpha', ['val'=>'А']) }}"
                               class="nav-button-grey">А</a>
                            <a href="{{ route('search_alpha', ['val'=>'Б']) }}"
                               class="nav-button-grey">Б</a>
                            <a href="{{ route('search_alpha', ['val'=>'В']) }}"
                               class="nav-button-grey">В</a>
                            <a href="{{ route('search_alpha', ['val'=>'Г']) }}"
                               class="nav-button-grey">Г</a>
                            <a href="{{ route('search_alpha', ['val'=>'Д']) }}"
                               class="nav-button-grey">Д</a>
                            <a href="{{ route('search_alpha', ['val'=>'Е']) }}"
                               class="nav-button-grey">Е</a>
                            <a href="{{ route('search_alpha', ['val'=>'Ж']) }}"
                               class="nav-button-grey">Ж</a>
                            <a href="{{ route('search_alpha', ['val'=>'З']) }}"
                               class="nav-button-grey">З</a>
                            <a href="{{ route('search_alpha', ['val'=>'И']) }}"
                               class="nav-button-grey">И</a>
                            <a href="{{ route('search_alpha', ['val'=>'К']) }}"
                               class="nav-button-grey">К</a>
                            <a href="{{ route('search_alpha', ['val'=>'Л']) }}"
                               class="nav-button-grey">Л</a>
                            <a href="{{ route('search_alpha', ['val'=>'М']) }}"
                               class="nav-button-grey">М</a>
                            <a href="{{ route('search_alpha', ['val'=>'Н']) }}"
                               class="nav-button-grey">Н</a>
                            <a href="{{ route('search_alpha', ['val'=>'О']) }}"
                               class="nav-button-grey">О</a>
                            <a href="{{ route('search_alpha', ['val'=>'П']) }}"
                               class="nav-button-grey">П</a>
                            <a href="{{ route('search_alpha', ['val'=>'Р']) }}"
                               class="nav-button-grey">Р</a>
                            <a href="{{ route('search_alpha', ['val'=>'С']) }}"
                               class="nav-button-grey">С</a>
                            <a href="{{ route('search_alpha', ['val'=>'Т']) }}"
                               class="nav-button-grey">Т</a>
                            <a href="{{ route('search_alpha', ['val'=>'У']) }}"
                               class="nav-button-grey">У</a>
                            <a href="{{ route('search_alpha', ['val'=>'Ф']) }}"
                               class="nav-button-grey">Ф</a>
                            <a href="{{ route('search_alpha', ['val'=>'Х']) }}"
                               class="nav-button-grey">Х</a>
                            <a href="{{ route('search_alpha', ['val'=>'Ц']) }}"
                               class="nav-button-grey">Ц</a>
                            <a href="{{ route('search_alpha', ['val'=>'Ч']) }}"
                               class="nav-button-grey">Ч</a>
                            <a href="{{ route('search_alpha', ['val'=>'Ш']) }}"
                               class="nav-button-grey">Ш</a>
                            <a href="{{ route('search_alpha', ['val'=>'Э']) }}"
                               class="nav-button-grey">Э</a>
                            <a href="{{ route('search_alpha', ['val'=>'Ю']) }}"
                               class="nav-button-grey">Ю</a>
                            <a href="{{ route('search_alpha', ['val'=>'Я']) }}"
                               class="nav-button-grey">Я</a>
                        </div>
                        @if(!empty($letters))
                            <div class="second-alfavit">
                                @foreach($letters as $letter)
                                    <a href="{{ route('search_alpha', ['val'=>$letter]) }}"
                                       class="nav-button-grey">{{ $letter }}</a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @if(!empty($medicines))
                <div class="search-result">
                    @foreach($medicines as $medicine)
                        <a href="{{ route('medicine', ['medicine'=> $medicine->alias]) }}">
                            <h3>{{ $medicine->title }}</h3></a>
                @endforeach
                </div>
                @if(count($medicines)>10)
                    <a class="btn-link" id="show">Показать больше <i class="fa fa-angle-down"
                                                                     aria-hidden="true"></i></a>
                @endif
            @endif
        </div>
        <div class="SEO-text">
        </div>
    </div>
</section>