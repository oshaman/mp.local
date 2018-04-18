<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="{{ asset('/') }}favicon.png" rel="shortcut icon">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/style.css">
    <title>{{ $medicine->title }}</title>
</head>
<body>
<div class="for-print">
    <a href="javascript:window.print();" class="btn-print">Друкувати</a>
    <div class="from">ІНФОРМАЦІЯ З САЙТУ MEDPRAVDA.COM.UA - ВСЯ ПРАВДА ПРО ПРЕПАРАТИ</div>
    <h1 class="head-title">{{ $medicine->title }} инструкція та ціна в аптеках</h1>
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
                <a href="#"><p>{{ $medicine->fabricator_name->utitle }}</p></a>
            </div>
        @endif
        @if(!empty($medicine->innname->title))
            <div id="mhh">
                <h5>МНН:</h5>
                <a href="#"><p>{{ $medicine->innname->title }}</p></a>
            </div>
        @endif
        @if(!empty($medicine->pharmagroup->utitle))
            <div id="farm-group">
                <h5>Фарм. група:</h5>
                <a href="#"><p>{{ $medicine->pharmagroup->utitle }}</p></a>
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
                    <a href="#">
                        <p>{{ $class .' - '. $name['uname'] }}</p>
                    </a>
                @endforeach
            </div>
        @endif
    </div>


    @if(!empty($medicine->consist))
        <div id="sostav" class="top-product-nav-info">
            <div class="title-product-info">
                <h5>Склад</h5>
            </div>
            {!! $medicine->consist !!}
        </div>
    @endif
    @if(!empty($medicine->docs_form))
        <div id="lekforma" class="top-product-nav-info">
            <div class="title-product-info">
                <h5>Лікарська форма</h5>
            </div>
            {!! $medicine->docs_form !!}
        </div>
    @endif
    @if(!empty($medicine->physicochemical_char))
        <div id="fizhimsvoistva" class="top-product-nav-info">
            <div class="title-product-info">
                <h5>Основні фізико-хімічні властивості</h5>
            </div>
            {!! $medicine->physicochemical_char !!}
        </div>
    @endif
    @if(!empty($medicine->fabricator))
        <div id="proizvoditel" class="top-product-nav-info">
            <div class="title-product-info">
                <h5>Виробник</h5>
            </div>
            {!! $medicine->fabricator !!}
        </div>
    @endif
    @if(!empty($medicine->addr_fabricator))
        <div id="adresproizvoditelya" class="top-product-nav-info">
            <div class="title-product-info">
                <h5>Місцезнаходження виробника</h5>
            </div>
            {!! $medicine->addr_fabricator !!}
        </div>
    @endif
    @if(!empty($medicine->pharm_group))
        <div id="farmgruppa" class="top-product-nav-info">
            <div class="title-product-info">
                <h5>Фармакотерапевтична група</h5>
            </div>
            {!! $medicine->pharm_group !!}
        </div>
    @endif
    @if(!empty($medicine->pharm_prop))
        <div id="farmsvoistva" class="top-product-nav-info">
            <div class="title-product-info">
                <h5>Фармакологічні властивості</h5>
            </div>
            {!! $medicine->pharm_prop !!}
        </div>
    @endif
    @if(!empty($medicine->indications))
        <div id="pokazanij" class="top-product-nav-info">
            <div class="title-product-info">
                <h5>Показання</h5>
            </div>
            {!! $medicine->indications !!}
        </div>
    @endif
    @if(!empty($medicine->contraindications))
        <div id="protivipokazaniya" class="top-product-nav-info">
            <div class="title-product-info">
                <h5>Протипоказання</h5>
            </div>
            {!! $medicine->contraindications !!}
        </div>
    @endif

    <div class="clone-to" data-number="1"></div>


    @if(!empty($medicine->security))
        <div id="bezopastnost" class="top-product-nav-info">
            <div class="title-product-info">
                <h5>Міри безпеки</h5>
            </div>
            {!! $medicine->security !!}
        </div>
    @endif
    @if(!empty($medicine->application_features))
        <div id="osobennostprimeneniya" class="top-product-nav-info">
            <div class="title-product-info">
                <h5>Особливості застосування</h5>
            </div>
            {!! $medicine->application_features !!}
        </div>
    @endif
    @if(!empty($medicine->pregnancy))
        <div id="beremennost" class="top-product-nav-info">
            <div class="title-product-info">
                <h5>Застосування у період вагітності або годування груддю</h5>
            </div>
            {!! $medicine->pregnancy !!}
        </div>
    @endif
    @if(!empty($medicine->cars))
        <div id="avto" class="top-product-nav-info">
            <div class="title-product-info">
                <h5>Вплив на здатність керувати транспортними засобами і механізмами</h5>
            </div>
            {!! $medicine->cars !!}
        </div>
    @endif
    @if(!empty($medicine->children))
        <div id="deti" class="top-product-nav-info">
            <div class="title-product-info">
                <h5>Діти</h5>
            </div>
            {!! $medicine->children !!}
        </div>
    @endif
    @if(!empty($medicine->app_mode))
        <div id="premenenieidosa" class="top-product-nav-info">
            <div class="title-product-info">
                <h5>Спосіб застосування та дози</h5>
            </div>
            {!! $medicine->app_mode !!}
        </div>
    @endif
    @if(!empty($medicine->overdose))
        <div id="peredoz" class="top-product-nav-info">
            <div class="title-product-info">
                <h5>Передозування</h5>
            </div>
            {!! $medicine->overdose !!}
        </div>
    @endif
    @if(!empty($medicine->side_effects))
        <div id="pobochnie" class="top-product-nav-info">
            <div class="title-product-info">
                <h5>Побічні ефекти</h5>
            </div>
            {!! $medicine->side_effects !!}
        </div>
    @endif
    @if(!empty($medicine->interaction))
        <div id="vzaimodeistvie" class="top-product-nav-info">
            <div class="title-product-info">
                <h5>Лікарська взаємодія</h5>
            </div>
            {!! $medicine->interaction !!}
        </div>
    @endif
    @if(!empty($medicine->shelf_life))
        <div id="srokgodnosti" class="top-product-nav-info">
            <div class="title-product-info">
                <h5>Термін придатності</h5>
            </div>
            {!! $medicine->shelf_life !!}
        </div>
    @endif
    @if(!empty($medicine->saving))
        <div id="usloviyahraneniya" class="top-product-nav-info">
            <div class="title-product-info">
                <h5>Умови зберігання</h5>
            </div>
            {!! $medicine->saving !!}
        </div>
    @endif
    @if(!empty($medicine->packaging))
        <div id="upakovka" class="top-product-nav-info">
            <div class="title-product-info">
                <h5>Упаковка</h5>
            </div>
            {!! $medicine->packaging !!}
        </div>
    @endif
    @if(!empty($medicine->leave_cat))
        <div id="kategoriyaotpuska" class="top-product-nav-info">
            <div class="title-product-info">
                <h5>Категорія відпуску</h5>
            </div>
            {!! $medicine->leave_cat !!}
        </div>
    @endif
    @if(!empty($medicine->additionally))
        <div id="dopolnitelno" class="top-product-nav-info">
            <div class="title-product-info">
                <h5>Додатково</h5>
            </div>
            {!! $medicine->additionally !!}
        </div>
    @endif

    <a href="javascript:window.print();" class="btn-print">Роздрукувати</a>
</div>

</body>
</html>