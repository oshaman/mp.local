<h2>Контент</h2>
<div class="panel-group" id="accordion">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                #1
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                    @if(!empty($loc))
                        Состав:
                    @else
                        Склад:
                    @endif
                </a>
            </h4>
        </div>
        <div id="collapse1" class="panel-collapse collapse">
            <div class="panel-body">
                <textarea name="consist" class="form-control editor">
                    {!! old('consist') ? : ($drug->consist ?? '') !!}
                </textarea>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                #2
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                    @if(!empty($loc))
                        Лекарственная форма:
                    @else
                        Лікарська форма:
                    @endif
                </a>
            </h4>
        </div>
        <div id="collapse2" class="panel-collapse collapse">
            <div class="panel-body">
                <textarea name="docs_form" class="form-control">
                    {!! old('docs_form') ? : ($drug->docs_form ?? '') !!}
                </textarea>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                #3
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                    @if(!empty($loc))
                        Основные физико-химические свойства:
                    @else
                        Основні фізико-хімічні властивості:
                    @endif
                </a>
            </h4>
        </div>
        <div id="collapse3" class="panel-collapse collapse">
            <div class="panel-body">
                <textarea name="physicochemical_char" class="form-control editor">
                    {!! old('physicochemical_char') ? : ($drug->physicochemical_char ?? '') !!}
                </textarea>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                #4
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                    @if(!empty($loc))
                        Производитель:
                    @else
                        Виробник:
                    @endif
                </a>
            </h4>
        </div>
        <div id="collapse4" class="panel-collapse collapse">
            <div class="panel-body">
                <textarea name="fabricator" class="form-control editor">
                    {!! old('fabricator') ? : ($drug->fabricator ?? '') !!}
                </textarea>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                #5
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                    @if(!empty($loc))
                        Местонахождение производителя:
                    @else
                        Місцезнаходження виробника:
                    @endif
                </a>
            </h4>
        </div>
        <div id="collapse5" class="panel-collapse collapse">
            <div class="panel-body">
                <textarea name="addr_fabricator" class="form-control editor">
                    {!! old('addr_fabricator') ? : ($drug->addr_fabricator ?? '') !!}
                </textarea>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                #6
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">
                    @if(!empty($loc))
                        Фармакотерапевтическая группа:
                    @else
                        Фармакотерапевтична група:
                    @endif
                </a>
            </h4>
        </div>
        <div id="collapse6" class="panel-collapse collapse">
            <div class="panel-body">
                <textarea name="pharm_group" class="form-control editor">
                    {!! old('pharm_group') ? : ($drug->pharm_group ?? '') !!}
                </textarea>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                #7
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse8">
                    @if(!empty($loc))
                        Фармакологические свойства:
                    @else
                        Фармакологічні властивості:
                    @endif
                </a>
            </h4>
        </div>
        <div id="collapse8" class="panel-collapse collapse">
            <div class="panel-body">
                <textarea name="pharm_prop" class="form-control editor">
                    {!! old('pharm_prop') ? : ($drug->pharm_prop ?? '') !!}
                </textarea>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                #8
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse7">
                    @if(!empty($loc))
                        Показания к применению:
                    @else
                        Показання до застосування:
                    @endif
                </a>
            </h4>
        </div>
        <div id="collapse7" class="panel-collapse collapse">
            <div class="panel-body">
                <textarea name="indications" class="form-control editor">
                    {!! old('indications') ? : ($drug->indications ?? '') !!}
                </textarea>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                #9
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse9">
                    @if(!empty($loc))
                        Противопоказания:
                    @else
                        Протипоказання:
                    @endif
                </a>
            </h4>
        </div>
        <div id="collapse9" class="panel-collapse collapse">
            <div class="panel-body">
                <textarea name="contraindications" class="form-control editor">
                    {!! old('contraindications') ? : ($drug->contraindications ?? '') !!}
                </textarea>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                #10
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse11">
                    @if(!empty($loc))
                        Особенности применения:
                    @else
                        Особливості застосування:
                    @endif
                </a>
            </h4>
        </div>
        <div id="collapse11" class="panel-collapse collapse">
            <div class="panel-body">
                <textarea name="application_features" class="form-control editor">
                    {!! old('application_features') ? : ($drug->application_features ?? '') !!}
                </textarea>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                #11
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse10">
                    @if(!empty($loc))
                        Надлежащие меры безопасности при применении:
                    @else
                        Міри безпеки:
                    @endif
                </a>
            </h4>
        </div>
        <div id="collapse10" class="panel-collapse collapse">
            <div class="panel-body">
                <textarea name="security" class="form-control editor">
                    {!! old('security') ? : ($drug->security ?? '') !!}
                </textarea>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                #12
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse12">
                    @if(!empty($loc))
                        Применение в период беременности или кормления грудью:
                    @else
                        Застосування в період вагітності або годування груддю:
                    @endif
                </a>
            </h4>
        </div>
        <div id="collapse12" class="panel-collapse collapse">
            <div class="panel-body">
                <textarea name="pregnancy" class="form-control editor">
                    {!! old('pregnancy') ? : ($drug->pregnancy ?? '') !!}
                </textarea>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                #13
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse13">
                    @if(!empty($loc))
                        Способность влиять на скорость реакции при управлении автотранспортом:
                    @else
                        Вплив на здатність керувати транспортними засобами і механізмами:
                    @endif
                </a>
            </h4>
        </div>
        <div id="collapse13" class="panel-collapse collapse">
            <div class="panel-body">
                <textarea name="cars" class="form-control">
                    {!! old('cars') ? : ($drug->cars ?? '') !!}
                </textarea>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                #14
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse14">
                    @if(!empty($loc))
                        Дети:
                    @else
                        Діти:
                    @endif
                </a>
            </h4>
        </div>
        <div id="collapse14" class="panel-collapse collapse">
            <div class="panel-body">
                <textarea name="children" class="form-control editor">
                    {!! old('children') ? : ($drug->children ?? '') !!}
                </textarea>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                #15
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse15">
                    @if(!empty($loc))
                        Способ применения и дозы:
                    @else
                        Спосіб застосування та дози:
                    @endif
                </a>
            </h4>
        </div>
        <div id="collapse15" class="panel-collapse collapse">
            <div class="panel-body">
                <textarea name="app_mode" class="form-control editor">
                    {!! old('app_mode') ? : ($drug->app_mode ?? '') !!}
                </textarea>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                #16
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse16">
                    @if(!empty($loc))
                        Передозировка:
                    @else
                        Передозування:
                    @endif
                </a>
            </h4>
        </div>
        <div id="collapse16" class="panel-collapse collapse">
            <div class="panel-body">
                <textarea name="overdose" class="form-control editor">
                    {!! old('overdose') ? : ($drug->overdose ?? '') !!}
                </textarea>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                #17
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse17">
                    @if(!empty($loc))
                        Побочные действия:
                    @else
                        Побічні дії:
                    @endif
                </a>
            </h4>
        </div>
        <div id="collapse17" class="panel-collapse collapse">
            <div class="panel-body">
                <textarea name="side_effects" class="form-control editor">
                    {!! old('side_effects') ? : ($drug->side_effects ?? '') !!}
                </textarea>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                #18
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse22">
                    @if(!empty($loc))
                        Лекарственное взаимодействие:
                    @else
                        Лікарська взаємодія:
                    @endif
                </a>
            </h4>
        </div>
        <div id="collapse22" class="panel-collapse collapse">
            <div class="panel-body">
                <textarea name="interaction" class="form-control editor">
                    {!! old('interaction') ? : ($drug->interaction ?? '') !!}
                </textarea>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                #19
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse18">
                    @if(!empty($loc))
                        Срок годности:
                    @else
                        Термін придатності:
                    @endif
                </a>
            </h4>
        </div>
        <div id="collapse18" class="panel-collapse collapse">
            <div class="panel-body">
                <textarea name="shelf_life" class="form-control">
                    {!! old('shelf_life') ? : ($drug->shelf_life ?? '') !!}
                </textarea>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                #20
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse19">
                    @if(!empty($loc))
                        Условия хранения:
                    @else
                        Умови зберігання:
                    @endif
                </a>
            </h4>
        </div>
        <div id="collapse19" class="panel-collapse collapse">
            <div class="panel-body">
                <textarea name="saving" class="form-control">
                    {!! old('saving') ? : ($drug->saving ?? '') !!}
                </textarea>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                #21
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse20">
                    @if(!empty($loc))
                        Упаковка:
                    @else
                        Упаковка:
                    @endif
                </a>
            </h4>
        </div>
        <div id="collapse20" class="panel-collapse collapse">
            <div class="panel-body">
                <textarea name="packaging" class="form-control">
                    {!! old('packaging') ? : ($drug->packaging ?? '') !!}
                </textarea>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                #22
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse21">
                    @if(!empty($loc))
                        Категория отпуска:
                    @else
                        Категорія відпуску:
                    @endif
                </a>
            </h4>
        </div>
        <div id="collapse21" class="panel-collapse collapse">
            <div class="panel-body">
                <textarea name="leave_cat" class="form-control">
                    {!! old('leave_cat') ? : ($drug->leave_cat ?? '') !!}
                </textarea>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                #23
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse23">
                    @if(!empty($loc))
                        Дополнительно:
                    @else
                        Додатково:
                    @endif
                </a>
            </h4>
        </div>
        <div id="collapse23" class="panel-collapse collapse">
            <div class="panel-body">
                <textarea name="additionally" class="form-control editor">
                    {!! old('additionally') ? : ($drug->additionally ?? '') !!}
                </textarea>
            </div>
        </div>
    </div>
</div>