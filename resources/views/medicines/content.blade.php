@if(!empty($medicine->consist))
    <div id="sostav" class="top-product-nav-info admin-content">
        <div class="title-product-info">
            <img src="{{ asset('assets') }}/images/product-icon/black/1_sostav.png" alt="Состав">
            <h4>Состав</h4>
        </div>
        {!! $medicine->consist !!}
    </div>
@endif
<div class="banner-reklama order-first desktop-display-none">
    <a href="promotion.html"><img class="mobile-display-none"
                                  src="{{ asset('assets') }}/images/promotion/banner1.jpg" alt="Aloe vera">
        <img class="banner-reklama-mobile" src="{{ asset('assets') }}/images/promotion/promo-aside-300-300.jpg"
             alt="Aloe vera"></a>
</div>
@if(!empty($medicine->docs_form))
    <div id="lekforma" class="top-product-nav-info admin-content">
        <div class="title-product-info">
            <img src="{{ asset('assets') }}/images/product-icon/black/19_lek_forma.png" alt="Лекарственная форма">
            <h4>Лекарственная форма</h4>
        </div>
        {!! $medicine->docs_form !!}
    </div>
@endif
@if(!empty($medicine->physicochemical_char))
    <div id="fizhimsvoistva" class="top-product-nav-info admin-content">
        <div class="title-product-info">
            <img src="{{ asset('assets') }}/images/product-icon/black/11_svoystva.png"
                 alt="Основные физико-химические свойства">
            <h4>Основные физико-химические свойства</h4>
        </div>
        {!! $medicine->physicochemical_char !!}
    </div>
@endif
@if(!empty($medicine->fabricator))
    <div id="proizvoditel" class="top-product-nav-info admin-content">
        <div class="title-product-info">
            <img src="{{ asset('assets') }}/images/product-icon/black/20_proizvoditel.png" alt="Категория отпуска">
            <h4>Производитель</h4>
        </div>
        {!! $medicine->fabricator !!}
    </div>
@endif
@if(!empty($medicine->addr_fabricator))
    <div id="adresproizvoditelya" class="top-product-nav-info admin-content">
        <div class="title-product-info">
            <img src="{{ asset('assets') }}/images/product-icon/black/21_mesto_proizvoditelya.png"
                 alt="Местонахождение производителя">
            <h4>Местонахождение производителя</h4>
        </div>
        {!! $medicine->addr_fabricator !!}
    </div>
@endif
@if(!empty($medicine->pharm_group))
    <div id="farmgruppa" class="top-product-nav-info admin-content">
        <div class="title-product-info">
            <img src="{{ asset('assets') }}/images/product-icon/black/18_farm_gruppa.png"
                 alt="Фармакотерапевтическая группа">
            <h4>Фармакотерапевтическая группа</h4>
        </div>
        {!! $medicine->pharm_group !!}
    </div>
@endif
@if(!empty($medicine->pharm_prop))
    <div id="farmsvoistva" class="top-product-nav-info admin-content">
        <div class="title-product-info">
            <img src="{{ asset('assets') }}/images/product-icon/black/2_svoystva.png" alt="Фармакологические свойства">
            <h4>Фармакологические свойства</h4>
        </div>
        {!! $medicine->pharm_prop !!}
    </div>
@endif
@if(!empty($medicine->indications))
    <div id="pokazanij" class="top-product-nav-info admin-content">
        <div class="title-product-info">
            <img src="{{ asset('assets') }}/images/product-icon/black/3_pokazaniya.png" alt="Показания к применению">
            <h4>Показания к применению</h4>
        </div>
        {!! $medicine->indications !!}
    </div>
@endif
@if(!empty($medicine->contraindications))
    <div id="protivipokazaniya" class="top-product-nav-info admin-content">
        <div class="title-product-info">
            <img src="{{ asset('assets') }}/images/product-icon/black/6_protivopokazaniya.png" alt="Противопоказания">
            <h4>Противопоказания</h4>
        </div>
        {!! $medicine->contraindications !!}
    </div>
@endif
</div>
<div class="clone-to" data-number="1"></div>
    <div class="wrap">

@if(!empty($medicine->security))
    <div id="bezopastnost" class="top-product-nav-info admin-content">
        <div class="title-product-info">
            <img src="{{ asset('assets') }}/images/product-icon/black/12_mery_bezopasnosti.png"
                 alt="Надлежащие меры безопасности при применении">
            <h4>Надлежащие меры безопасности при применении</h4>
        </div>
        {!! $medicine->security !!}
    </div>
@endif
@if(!empty($medicine->application_features))
    <div id="osobennostprimeneniya" class="top-product-nav-info admin-content">
        <div class="title-product-info">
            <img src="{{ asset('assets') }}/images/product-icon/black/4_ primenenie.png" alt="Особенности применения">
            <h4>Особенности применения</h4>
        </div>
        {!! $medicine->application_features !!}
    </div>
@endif
@if(!empty($medicine->pregnancy))
    <div id="beremennost" class="top-product-nav-info admin-content">
        <div class="title-product-info">
            <img src="{{ asset('assets') }}/images/product-icon/black/7_beremennost.png"
                 alt="Применение в период беременности или кормления грудью">
            <h4>Применение в период беременности или кормления грудью</h4>
        </div>
        {!! $medicine->pregnancy !!}
    </div>
@endif
@if(!empty($medicine->cars))
    <div id="avto" class="top-product-nav-info admin-content">
        <div class="title-product-info">
            <img src="{{ asset('assets') }}/images/product-icon/black/17_avto.png"
                 alt="Способность влиять на скорость реакции при управлении автотранспортом">
            <h4>Способность влиять на скорость реакции при управлении автотранспортом</h4>
        </div>
        {!! $medicine->cars !!}
    </div>
@endif
@if(!empty($medicine->children))
    <div id="deti" class="top-product-nav-info admin-content">
        <div class="title-product-info">
            <img src="{{ asset('assets') }}/images/product-icon/black/13_deti.png" alt="Дети">
            <h4>Дети</h4>
        </div>
        {!! $medicine->children !!}
    </div>
@endif
@if(!empty($medicine->app_mode))
    <div id="premenenieidosa" class="top-product-nav-info admin-content">
        <div class="title-product-info">
            <img src="{{ asset('assets') }}/images/product-icon/black/23_sposob_primineniya.png"
                 alt="Способ применения и дозы">
            <h4>Способ применения и дозы</h4>
        </div>
        {!! $medicine->app_mode !!}
    </div>
@endif
@if(!empty($medicine->overdose))
    <div id="peredoz" class="top-product-nav-info admin-content">
        <div class="title-product-info">
            <img src="{{ asset('assets') }}/images/product-icon/black/9_peredozirovka.png" alt="Передозировка">
            <h4>Передозировка</h4>
        </div>
        {!! $medicine->overdose !!}
    </div>
@endif
@if(!empty($medicine->side_effects))
    <div id="pobochnie" class="top-product-nav-info admin-content">
        <div class="title-product-info">
            <img src="{{ asset('assets') }}/images/product-icon/black/5_pobochnie.png" alt="Побочные действия">
            <h4>Побочные действия</h4>
        </div>
        {!! $medicine->side_effects !!}
    </div>
@endif
@if(!empty($medicine->interaction))
    <div id="vzaimodeistvie" class="top-product-nav-info admin-content">
        <div class="title-product-info">
            <img src="{{ asset('assets') }}/images/product-icon/black/8_vzabmodeystvie.png"
                 alt="Лекарственное взаимодействие">
            <h4>Лекарственное взаимодействие</h4>
        </div>
        {!! $medicine->interaction !!}
    </div>
@endif
@if(!empty($medicine->shelf_life))
    <div id="srokgodnosti" class="top-product-nav-info admin-content">
        <div class="title-product-info">
            <img src="{{ asset('assets') }}/images/product-icon/black/14_srok.png" alt="Срок годности">
            <h4>Срок годности</h4>
        </div>
        {!! $medicine->shelf_life !!}
    </div>
@endif
@if(!empty($medicine->saving))
    <div id="usloviyahraneniya" class="top-product-nav-info admin-content">
        <div class="title-product-info">
            <img src="{{ asset('assets') }}/images/product-icon/black/15_hranenie.png" alt="Условия хранения">
            <h4>Условия хранения</h4>
        </div>
        {!! $medicine->saving !!}
    </div>
@endif
@if(!empty($medicine->packaging))
    <div id="upakovka" class="top-product-nav-info admin-content">
        <div class="title-product-info">
            <img src="{{ asset('assets') }}/images/product-icon/black/16_upakovka.png" alt="Упаковка">
            <h4>Упаковка</h4>
        </div>
        {!! $medicine->packaging !!}
    </div>
@endif
@if(!empty($medicine->leave_cat))
    <div id="kategoriyaotpuska" class="top-product-nav-info admin-content">
        <div class="title-product-info">
            <img src="{{ asset('assets') }}/images/product-icon/black/10_kategoriya.png" alt="Категория отпуска">
            <h4>Категория отпуска</h4>
        </div>
        {!! $medicine->leave_cat !!}
    </div>
@endif
@if(!empty($medicine->additionally))
    <div id="dopolnitelno" class="top-product-nav-info admin-content">
        <div class="title-product-info">
            <img src="{{ asset('assets') }}/images/product-icon/black/22_dopolnitelno.png" alt="Дополнительно">
            <h4>Дополнительно</h4>
        </div>
        {!! $medicine->additionally !!}
    </div>
@endif
    </div>
<div class="clone-to" data-number="1"></div>
    <div class="wrap">