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
    <a href="javascript:window.print();" class="btn-print">Распечатать</a>
    <div class="from">ИНФОРМАЦИЯ С САЙТА MEDPRAVDA.COM.UA - ВСЯ ПРАВДА О ПРЕПАРАТАХ</div>
    <h1 class="head-title">{{ $medicine->title }} инструкция и цена в аптеках</h1>
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
                <a href="#"><p>{{ $medicine->fabricator_name->title }}</p></a>
            </div>
        @endif
        @if(!empty($medicine->innname->title))
            <div id="mhh">
                <h5>МНН:</h5>
                <a href="#"><p>{{ $medicine->innname->title }}</p></a>
            </div>
        @endif
        @if(!empty($medicine->pharmagroup->title))
            <div id="farm-group">
                <h5>Фарм. группа:</h5>
                <a href="#"><p>{{ $medicine->pharmagroup->title }}</p></a>
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
                    <a href="#">
                        <p>{{ $class .' - '. $name['name'] }}</p>
                    </a>
                @endforeach
            </div>
        @endif
    </div>


    @if(!empty($medicine->consist))
        <div id="sostav" class="top-product-nav-info">
            <div class="title-product-info">
                <h5>Состав</h5>
            </div>
            {!! $medicine->consist !!}
        </div>
    @endif
    @if(!empty($medicine->docs_form))
        <div id="lekforma" class="top-product-nav-info">
            <div class="title-product-info">
                <h5>Лекарственная форма</h5>
            </div>
            {!! $medicine->docs_form !!}
        </div>
    @endif
    @if(!empty($medicine->physicochemical_char))
        <div id="fizhimsvoistva" class="top-product-nav-info">
            <div class="title-product-info">
                <h5>Основные физико-химические свойства</h5>
            </div>
            {!! $medicine->physicochemical_char !!}
        </div>
    @endif
    @if(!empty($medicine->fabricator))
        <div id="proizvoditel" class="top-product-nav-info">
            <div class="title-product-info">
                <h5>Производитель</h5>
            </div>
            {!! $medicine->fabricator !!}
        </div>
    @endif
    @if(!empty($medicine->addr_fabricator))
        <div id="adresproizvoditelya" class="top-product-nav-info">
            <div class="title-product-info">
                <h5>Местонахождение производителя</h5>
            </div>
            {!! $medicine->addr_fabricator !!}
        </div>
    @endif
    @if(!empty($medicine->pharm_group))
        <div id="farmgruppa" class="top-product-nav-info">
            <div class="title-product-info">
                <h5>Фармакотерапевтическая группа</h5>
            </div>
            {!! $medicine->pharm_group !!}
        </div>
    @endif
    @if(!empty($medicine->pharm_prop))
        <div id="farmsvoistva" class="top-product-nav-info">
            <div class="title-product-info">
                <h5>Фармакологические свойства</h5>
            </div>
            {!! $medicine->pharm_prop !!}
        </div>
    @endif
    @if(!empty($medicine->indications))
        <div id="pokazanij" class="top-product-nav-info">
            <div class="title-product-info">
                <h5>Показания к прменению</h5>
            </div>
            {!! $medicine->indications !!}
        </div>
    @endif
    @if(!empty($medicine->contraindications))
        <div id="protivipokazaniya" class="top-product-nav-info">
            <div class="title-product-info">
                <h5>Противопоказания</h5>
            </div>
            {!! $medicine->contraindications !!}
        </div>
    @endif

    <div class="clone-to" data-number="1"></div>


    @if(!empty($medicine->security))
        <div id="bezopastnost" class="top-product-nav-info">
            <div class="title-product-info">
                <h5>Надлежащие меры безопасности при применении</h5>
            </div>
            {!! $medicine->security !!}
        </div>
    @endif
    @if(!empty($medicine->application_features))
        <div id="osobennostprimeneniya" class="top-product-nav-info">
            <div class="title-product-info">
                <h5>Особенности применения</h5>
            </div>
            {!! $medicine->application_features !!}
        </div>
    @endif
    @if(!empty($medicine->pregnancy))
        <div id="beremennost" class="top-product-nav-info">
            <div class="title-product-info">
                <h5>Применение в период беременности или кормления грудью</h5>
            </div>
            {!! $medicine->pregnancy !!}
        </div>
    @endif
    @if(!empty($medicine->cars))
        <div id="avto" class="top-product-nav-info">
            <div class="title-product-info">
                <h5>Способность влиять на скорость реакции при управлении автотранспортом</h5>
            </div>
            {!! $medicine->cars !!}
        </div>
    @endif
    @if(!empty($medicine->children))
        <div id="deti" class="top-product-nav-info">
            <div class="title-product-info">
                <h5>Дети</h5>
            </div>
            {!! $medicine->children !!}
        </div>
    @endif
    @if(!empty($medicine->app_mode))
        <div id="premenenieidosa" class="top-product-nav-info">
            <div class="title-product-info">
                <h5>Способ применения и дозы</h5>
            </div>
            {!! $medicine->app_mode !!}
        </div>
    @endif
    @if(!empty($medicine->overdose))
        <div id="peredoz" class="top-product-nav-info">
            <div class="title-product-info">
                <h5>Передозировка</h5>
            </div>
            {!! $medicine->overdose !!}
        </div>
    @endif
    @if(!empty($medicine->side_effects))
        <div id="pobochnie" class="top-product-nav-info">
            <div class="title-product-info">
                <h5>Побочные действия</h5>
            </div>
            {!! $medicine->side_effects !!}
        </div>
    @endif
    @if(!empty($medicine->interaction))
        <div id="vzaimodeistvie" class="top-product-nav-info">
            <div class="title-product-info">
                <h5>Лекарственное взаимодействие</h5>
            </div>
            {!! $medicine->interaction !!}
        </div>
    @endif
    @if(!empty($medicine->shelf_life))
        <div id="srokgodnosti" class="top-product-nav-info">
            <div class="title-product-info">
                <h5>Срок годности</h5>
            </div>
            {!! $medicine->shelf_life !!}
        </div>
    @endif
    @if(!empty($medicine->saving))
        <div id="usloviyahraneniya" class="top-product-nav-info">
            <div class="title-product-info">
                <h5>Условия хранения</h5>
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
                <h5>Категория отпуска</h5>
            </div>
            {!! $medicine->leave_cat !!}
        </div>
    @endif
    @if(!empty($medicine->additionally))
        <div id="dopolnitelno" class="top-product-nav-info">
            <div class="title-product-info">
                <h5>Дополнительно</h5>
            </div>
            {!! $medicine->additionally !!}
        </div>
    @endif

    <a href="javascript:window.print();" class="btn-print">Распечатать</a>
</div>

</body>
</html>