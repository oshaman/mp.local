@if(!empty($medicine->consist))
    <div id="sostav" class="top-product-nav-info admin-content">
        <div class="title-product-info">
            <img src="{{ asset('assets') }}/images/product-icon/black/1_sostav.png" alt="Склад">
            <h4>Склад</h4>
        </div>
        {!! $medicine->consist !!}
    </div>
@endif
@if(!empty($medicine->docs_form))
    <div id="lekforma" class="top-product-nav-info admin-content">
        <div class="title-product-info">
            <img src="{{ asset('assets') }}/images/product-icon/black/19_lek_forma.png" alt="Лікарська форма">
            <h4>Лікарська форма</h4>
        </div>
        {!! $medicine->docs_form !!}
    </div>
@endif
@if(!empty($medicine->physicochemical_char))
    <div id="fizhimsvoistva" class="top-product-nav-info admin-content">
        <div class="title-product-info">
            <img src="{{ asset('assets') }}/images/product-icon/black/11_svoystva.png"
                 alt="Основні фізико-хімічні властивості">
            <h4>Основные Основні фізико-хімічні властивості свойства</h4>
        </div>
        {!! $medicine->physicochemical_char !!}
    </div>
@endif
@if(!empty($medicine->fabricator))
    <div id="proizvoditel" class="top-product-nav-info admin-content">
        <div class="title-product-info">
            <img src="{{ asset('assets') }}/images/product-icon/black/20_proizvoditel.png" alt="Виробник">
            <h4>Виробник</h4>
        </div>
        {!! $medicine->fabricator !!}
    </div>
@endif
@if(!empty($medicine->addr_fabricator))
    <div id="adresproizvoditelya" class="top-product-nav-info admin-content">
        <div class="title-product-info">
            <img src="{{ asset('assets') }}/images/product-icon/black/21_mesto_proizvoditelya.png"
                 alt="Місцезнаходження виробника">
            <h4>Місцезнаходження виробника</h4>
        </div>
        {!! $medicine->addr_fabricator !!}
    </div>
@endif
@if(!empty($medicine->pharm_group))
    <div id="farmgruppa" class="top-product-nav-info admin-content">
        <div class="title-product-info">
            <img src="{{ asset('assets') }}/images/product-icon/black/18_farm_gruppa.png"
                 alt="Фармакотерапевтична група">
            <h4>Фармакотерапевтична група</h4>
        </div>
        {!! $medicine->pharm_group !!}
    </div>
@endif
@if(!empty($medicine->pharm_prop))
    <div id="farmsvoistva" class="top-product-nav-info admin-content">
        <div class="title-product-info">
            <img src="{{ asset('assets') }}/images/product-icon/black/2_svoystva.png" alt="властивості">
            <h4>Фармакологічні властивості</h4>
        </div>
        {!! $medicine->pharm_prop !!}
    </div>
@endif
@if(!empty($medicine->indications))
    <div id="pokazanij" class="top-product-nav-info admin-content">
        <div class="title-product-info">
            <img src="{{ asset('assets') }}/images/product-icon/black/3_pokazaniya.png" alt="Показання">
            <h4>Показання</h4>
        </div>
        {!! $medicine->indications !!}
    </div>
@endif
@if(!empty($medicine->contraindications))
    <div id="protivipokazaniya" class="top-product-nav-info admin-content">
        <div class="title-product-info">
            <img src="{{ asset('assets') }}/images/product-icon/black/6_protivopokazaniya.png" alt="Протипоказання">
            <h4>Протипоказання</h4>
        </div>
        {!! $medicine->contraindications !!}
    </div>
@endif

<div class="clone-to" data-number="1"></div>


@if(!empty($medicine->security))
    <div id="bezopastnost" class="top-product-nav-info admin-content">
        <div class="title-product-info">
            <img src="{{ asset('assets') }}/images/product-icon/black/12_mery_bezopasnosti.png"
                 alt="Міри безпеки">
            <h4>Міри безпеки</h4>
        </div>
        {!! $medicine->security !!}
    </div>
@endif
@if(!empty($medicine->application_features))
    <div id="osobennostprimeneniya" class="top-product-nav-info admin-content">
        <div class="title-product-info">
            <img src="{{ asset('assets') }}/images/product-icon/black/4_ primenenie.png" alt="Особливості застосування">
            <h4>Особливості застосування</h4>
        </div>
        {!! $medicine->application_features !!}
    </div>
@endif
@if(!empty($medicine->pregnancy))
    <div id="beremennost" class="top-product-nav-info admin-content">
        <div class="title-product-info">
            <img src="{{ asset('assets') }}/images/product-icon/black/7_beremennost.png"
                 alt="Застосування у період вагітності або годування груддю">
            <h4>Застосування у період вагітності або годування груддю</h4>
        </div>
        {!! $medicine->pregnancy !!}
    </div>
@endif
@if(!empty($medicine->cars))
    <div id="avto" class="top-product-nav-info admin-content">
        <div class="title-product-info">
            <img src="{{ asset('assets') }}/images/product-icon/black/17_avto.png"
                 alt="Вплив на здатність керувати транспортними засобами і механізмами">
            <h4>Вплив на здатність керувати транспортними засобами і механізмами</h4>
        </div>
        {!! $medicine->cars !!}
    </div>
@endif
@if(!empty($medicine->children))
    <div id="deti" class="top-product-nav-info admin-content">
        <div class="title-product-info">
            <img src="{{ asset('assets') }}/images/product-icon/black/13_deti.png" alt="Діти">
            <h4>Діти</h4>
        </div>
        {!! $medicine->children !!}
    </div>
@endif
@if(!empty($medicine->app_mode))
    <div id="premenenieidosa" class="top-product-nav-info admin-content">
        <div class="title-product-info">
            <img src="{{ asset('assets') }}/images/product-icon/black/23_sposob_primineniya.png"
                 alt="Спосіб застосування та дози">
            <h4>Спосіб застосування та дози</h4>
        </div>
        {!! $medicine->app_mode !!}
    </div>
@endif
@if(!empty($medicine->overdose))
    <div id="peredoz" class="top-product-nav-info admin-content">
        <div class="title-product-info">
            <img src="{{ asset('assets') }}/images/product-icon/black/9_peredozirovka.png" alt="Передозування">
            <h4>Передозування</h4>
        </div>
        {!! $medicine->overdose !!}
    </div>
@endif
@if(!empty($medicine->side_effects))
    <div id="pobochnie" class="top-product-nav-info admin-content">
        <div class="title-product-info">
            <img src="{{ asset('assets') }}/images/product-icon/black/5_pobochnie.png" alt="Побічні ефекти">
            <h4>Побічні ефекти</h4>
        </div>
        {!! $medicine->side_effects !!}
    </div>
@endif
@if(!empty($medicine->interaction))
    <div id="vzaimodeistvie" class="top-product-nav-info admin-content">
        <div class="title-product-info">
            <img src="{{ asset('assets') }}/images/product-icon/black/8_vzabmodeystvie.png"
                 alt="Взаємодія з іншими лікарськими засобами">
            <h4>Взаємодія з іншими лікарськими засобами</h4>
        </div>
        {!! $medicine->interaction !!}
    </div>
@endif
@if(!empty($medicine->shelf_life))
    <div id="srokgodnosti" class="top-product-nav-info admin-content">
        <div class="title-product-info">
            <img src="{{ asset('assets') }}/images/product-icon/black/14_srok.png" alt="Термін придатності">
            <h4>Термін придатності</h4>
        </div>
        {!! $medicine->shelf_life !!}
    </div>
@endif
@if(!empty($medicine->saving))
    <div id="usloviyahraneniya" class="top-product-nav-info admin-content">
        <div class="title-product-info">
            <img src="{{ asset('assets') }}/images/product-icon/black/15_hranenie.png" alt="зберігання">
            <h4>Умови зберігання</h4>
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
            <img src="{{ asset('assets') }}/images/product-icon/black/10_kategoriya.png" alt="Категорія відпуску">
            <h4>Категорія відпуску</h4>
        </div>
        {!! $medicine->leave_cat !!}
    </div>
@endif
@if(!empty($medicine->additionally))
    <div id="dopolnitelno" class="top-product-nav-info admin-content">
        <div class="title-product-info">
            <img src="{{ asset('assets') }}/images/product-icon/black/22_dopolnitelno.png" alt="Додатково">
            <h4>Додатково</h4>
        </div>
        {!! $medicine->additionally !!}
    </div>
@endif
<div class="clone-to" data-number="1"></div>