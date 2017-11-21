<!-- HEADER -->
<header>
    <div class="wrap">
        <div class="logo">
            <a href="{{ route('main') }}"><img src="{{ asset('assets') }}/images/main/logo.png"
                                               alt="Логотип МЕД правда"></a>
        </div>
        <div class="search">
            <input type="search" name="search" id="search" placeholder="Поиск по сайту">
            <span class="img-search"></span>
        </div>
        <div class="main-menu">
            <nav class="mobile-display-none">
                <a href="{{ route('search') }}">Препараты</a>
                <a href="{{ route('articles') }}">Интересно</a>
                <a href="{{ route('articles') }}">Последние статьи</a>
                <a href="{{ route('articles') }}">Новости медицины</a>
                <a href="{{ route('articles') }}">Лечение</a>
            </nav>
            <a class="burgerBtn">
                <span></span>
            </a>
        </div>
        <div class="lang-menu mobile-display-none">
            <span class="active">Рус</span>
            <a href="#!">Укр</a>
        </div>
    </div>
</header>
<section class="top-meta-section">
    <div class="wrap">
        <div class="top-meta mobile-display-none">
            <span class="meta-title">Популярные теги:</span>
            <a href="#!" class="btn-meta">Аспирин</a>
            <a href="#!" class="btn-meta">Грипп</a>
            <a href="#!" class="btn-meta">Алергия</a>
            <a href="#!" class="btn-meta active">Беременность</a>
        </div>
        <div class="search">
            <form method="GET" action="{{ route('search') }}" accept-charset="UTF-8">
                <input type="search" name="search" id="search" placeholder="Поиск по сайту">
            </form>
            <span class="img-search"></span>
        </div>
    </div>
</section>
<!-- end HEADER -->