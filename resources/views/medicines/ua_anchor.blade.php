<ul class="top-product-nav">
    @if(!empty($medicine->consist))
        <li>
            <img src="{{ asset('assets') }}/images/product-icon/1_sostav.png" alt="Состав">
            <a href="#sostav">Склад</a>
        </li>
    @endif
    @if(!empty($medicine->docs_form))
        <li>
            <img src="{{ asset('assets') }}/images/product-icon/19_lek_forma.png"
                 alt="Лікарська форма">
            <a href="#lekforma">Лікарська форма</a>
        </li>
    @endif
    @if(!empty($medicine->physicochemical_char))
        <li>
            <img src="{{ asset('assets') }}/images/product-icon/11_svoystva.png"
                 alt="Основні фізико-хімічні властивості">
            <a href="#fizhimsvoistva">Основні фізико-хімічні властивості</a>
        </li>
    @endif
    @if(!empty($medicine->fabricator))
        <li>
            <img src="{{ asset('assets') }}/images/product-icon/20_proizvoditel.png"
                 alt="Производитель">
            <a href="#proizvoditel">Виробник</a>
        </li>
    @endif
    @if(!empty($medicine->addr_fabricator))
        <li>
            <img src="{{ asset('assets') }}/images/product-icon/21_mesto_proizvoditelya.png"
                 alt="Местонахождение производителя">
            <a href="#adresproizvoditelya">Місцезнаходження виробника</a>
        </li>
    @endif
    @if(!empty($medicine->pharm_group))
        <li>
            <img src="{{ asset('assets') }}/images/product-icon/18_farm_gruppa.png"
                 alt="Фармакотерапевтична група">
            <a href="#farmgruppa">Фармакотерапевтична група</a>
        </li>
    @endif
    @if(!empty($medicine->pharm_prop))
        <li>
            <img src="{{ asset('assets') }}/images/product-icon/2_svoystva.png"
                 alt="Фармакологічні властивості">
            <a href="#farmsvoistva">Фармакологічні властивості</a>
        </li>
    @endif
    @if(!empty($medicine->indications))
        <li>
            <img src="{{ asset('assets') }}/images/product-icon/3_pokazaniya.png"
                 alt="Показання">
            <a href="#pokazanij">Показання</a>
        </li>
    @endif
    @if(!empty($medicine->contraindications))
        <li>
            <img src="{{ asset('assets') }}/images/product-icon/6_protivopokazaniya.png"
                 alt="Протипоказання">
            <a href="#protivipokazaniya">Протипоказання</a>
        </li>
    @endif
    @if(!empty($medicine->security))
        <li>
            <img src="{{ asset('assets') }}/images/product-icon/12_mery_bezopasnosti.png"
                 alt="Міри безпеки">
            <a href="#bezopastnost">Міри безпеки</a>
        </li>
    @endif
    @if(!empty($medicine->application_features))
        <li>
            <img src="{{ asset('assets') }}/images/product-icon/4_ primenenie.png"
                 alt="Особливості застосування">
            <a href="#osobennostprimeneniya">Особливості застосування</a>
        </li>
    @endif
    @if(!empty($medicine->pregnancy))
        <li>
            <img src="{{ asset('assets') }}/images/product-icon/7_beremennost.png"
                 alt="Застосування у період вагітності або годування груддю">
            <a href="#beremennost">Застосування у період вагітності або годування груддю</a>
        </li>
    @endif
    @if(!empty($medicine->cars))
        <li>
            <img src="{{ asset('assets') }}/images/product-icon/17_avto.png"
                 alt="Вплив на здатність керувати транспортними засобами і механізмами">
            <a href="#avto">Вплив на здатність керувати транспортними засобами і механізмами</a>
        </li>
    @endif
    @if(!empty($medicine->children))
        <li>
            <img src="{{ asset('assets') }}/images/product-icon/13_deti.png"
                 alt="Діти">
            <a href="#deti">Діти</a>
        </li>
    @endif
    @if(!empty($medicine->app_mode))
        <li>
            <img src="{{ asset('assets') }}/images/product-icon/23_sposob_primineniya.png"
                 alt="Спосіб застосування та дози">
            <a href="#premenenieidosa">Спосіб застосування та дози</a>
        </li>
    @endif
    @if(!empty($medicine->overdose))
        <li>
            <img src="{{ asset('assets') }}/images/product-icon/9_peredozirovka.png"
                 alt="Передозування">
            <a href="#peredoz">Передозування</a>
        </li>
    @endif
    @if(!empty($medicine->side_effects))
        <li>
            <img src="{{ asset('assets') }}/images/product-icon/5_pobochnie.png"
                 alt="Побічні ефекти">
            <a href="#pobochnie">Побічні ефекти</a>
        </li>
    @endif
    @if(!empty($medicine->interaction))
        <li>
            <img src="{{ asset('assets') }}/images/product-icon/8_vzabmodeystvie.png"
                 alt="Лікарська взаємодія">
            <a href="#vzaimodeistvie">Лікарська взаємодія</a>
        </li>
    @endif
    @if(!empty($medicine->shelf_life))
        <li>
            <img src="{{ asset('assets') }}/images/product-icon/14_srok.png"
                 alt="Термін придатності">
            <a href="#srokgodnosti">Термін придатності</a>
        </li>
    @endif
    @if(!empty($medicine->saving))
        <li>
            <img src="{{ asset('assets') }}/images/product-icon/15_hranenie.png"
                 alt="Умови зберігання">
            <a href="#usloviyahraneniya">Умови зберігання</a>
        </li>
    @endif
    @if(!empty($medicine->packaging))
        <li>
            <img src="{{ asset('assets') }}/images/product-icon/16_upakovka.png"
                 alt="Упаковка">
            <a href="#upakovka">Упаковка</a>
        </li>
    @endif
    @if(!empty($medicine->leave_cat))
        <li>
            <img src="{{ asset('assets') }}/images/product-icon/10_kategoriya.png"
                 alt="Категорія відпуску">
            <a href="#kategoriyaotpuska">Категорія відпуску</a>
        </li>
    @endif
    @if(!empty($medicine->additionally))
        <li>
            <img src="{{ asset('assets') }}/images/product-icon/22_dopolnitelno.png"
                 alt="Додатково">
            <a href="#dopolnitelno">Додатково</a>
        </li>
    @endif
</ul>