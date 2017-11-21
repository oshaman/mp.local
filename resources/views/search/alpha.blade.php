<section class="content">
    <div class="wrap">
        {{--BreadCrumbs--}}
        <div class="bread-crumbs breadcrumbs mobile-display-none" id="breadcrumbs" itemscope
             itemtype="http://schema.org/BreadcrumbList">
            <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                <a href="{{ route('main') }}" itemprop="item">Главная</a>
                <meta itemprop="position" content="1"/>
            </div>
            @if(!empty($search))
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <span>Поиск по алфавиту</span>
                    <meta itemprop="position" content="2"/>
                </div>
            @else
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <span itemprop="name" class="label1">Поиск по алфавиту</span>
                    <meta itemprop="position" content="2"/>
                </div>
            @endif
        </div>
        {{--BreadCrumbs--}}
        <h1 class="head-title">Результаты поиска по алфавиту:&nbsp;</h1>
    </div>

    <div class="section-title-meta-icon">
        <div class="section-meta-icon">
            <div class="section-icon">
                <img src="{{ asset('assets') }}/images/title-icons/found.png" alt="иконка Также ищут">
            </div>
        </div>
    </div>
    <div class="wrap">
        <div class="product-analog">
            <h2 class="product-title">Поиск препаратов по алфавиту</h2>

            @include('search.nav')

            <div class="search-alfavit">
                <h2 class="product-title">Поиск препаратов по алфавиту</h2>
                <div class="search-alfavit-column">
                    <div class="search-left-content">
                        <div class="first-alfavit">
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'5']) }}"
                               class="nav-button-grey">5</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'A']) }}"
                               class="nav-button-grey">A</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'B']) }}"
                               class="nav-button-grey">B</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'C']) }}"
                               class="nav-button-grey">C</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'D']) }}"
                               class="nav-button-grey">D</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'E']) }}"
                               class="nav-button-grey">E</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'F']) }}"
                               class="nav-button-grey">F</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'G']) }}"
                               class="nav-button-grey">G</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'H']) }}"
                               class="nav-button-grey">H</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'I']) }}"
                               class="nav-button-grey">I</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'J']) }}"
                               class="nav-button-grey">J</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'K']) }}"
                               class="nav-button-grey">K</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'L']) }}"
                               class="nav-button-grey">L</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'M']) }}"
                               class="nav-button-grey">M</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'N']) }}"
                               class="nav-button-grey">N</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'O']) }}"
                               class="nav-button-grey">O</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'P']) }}"
                               class="nav-button-grey">P</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'R']) }}"
                               class="nav-button-grey">R</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'S']) }}"
                               class="nav-button-grey">S</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'T']) }}"
                               class="nav-button-grey">T</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'U']) }}"
                               class="nav-button-grey">U</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'V']) }}"
                               class="nav-button-grey">V</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'W']) }}"
                               class="nav-button-grey">W</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'А']) }}"
                               class="nav-button-grey">А</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'Б']) }}"
                               class="nav-button-grey">Б</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'В']) }}"
                               class="nav-button-grey">В</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'Г']) }}"
                               class="nav-button-grey">Г</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'Д']) }}"
                               class="nav-button-grey">Д</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'Е']) }}"
                               class="nav-button-grey">Е</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'Ж']) }}"
                               class="nav-button-grey">Ж</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'З']) }}"
                               class="nav-button-grey">З</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'И']) }}"
                               class="nav-button-grey">И</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'К']) }}"
                               class="nav-button-grey">К</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'Л']) }}"
                               class="nav-button-grey">Л</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'М']) }}"
                               class="nav-button-grey">М</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'Н']) }}"
                               class="nav-button-grey">Н</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'О']) }}"
                               class="nav-button-grey">О</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'П']) }}"
                               class="nav-button-grey">П</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'Р']) }}"
                               class="nav-button-grey">Р</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'С']) }}"
                               class="nav-button-grey">С</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'Т']) }}"
                               class="nav-button-grey">Т</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'У']) }}"
                               class="nav-button-grey">У</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'Ф']) }}"
                               class="nav-button-grey">Ф</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'Х']) }}"
                               class="nav-button-grey">Х</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'Ц']) }}"
                               class="nav-button-grey">Ц</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'Ч']) }}"
                               class="nav-button-grey">Ч</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'Ш']) }}"
                               class="nav-button-grey">Ш</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'Э']) }}"
                               class="nav-button-grey">Э</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'Ю']) }}"
                               class="nav-button-grey">Ю</a>
                            <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>'Я']) }}"
                               class="nav-button-grey">Я</a>
                        </div>
                        @if(!empty($letters))
                            <div class="second-alfavit">
                                @foreach($letters as $letter)
                                    <a href="{{ route('search_alpha', ['loc'=>'ru', 'val'=>$letter]) }}"
                                       class="nav-button-grey">{{ $letter }}</a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @if(!empty($medicines))
                @foreach($medicines as $medicine)
                    <div class="search-result">
                        <a href="{{ route('medicine', ['loc'=>'ru', 'medicine'=> $medicine->alias]) }}">
                            <h3>{{ $medicine->title }}</h3></a>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="SEO-text">

        </div>
    </div>
</section>