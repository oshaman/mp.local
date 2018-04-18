@if(!empty($drug))
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <ul class="nav navbar-nav">
                @if('ru' == $spec)
                    <li><a class="btn btn-default">RU-инструкция</a></li>
                @else
                    <li>
                        <a href="{{ route('medicine_edit',['spec'=>'ru', 'medicine'=> $drug->alias]) }}">RU-инструкция</a>
                    </li>
                @endif
                @if('ua' == $spec)
                    <li><a class="btn btn-default">UA-инструкция</a></li>
                @else
                    <li>
                        <a href="{{ route('medicine_edit',['spec'=>'ua', 'medicine'=> $drug->alias]) }}">UA-инструкция</a>
                    </li>
                @endif
                @if('aru' == $spec)
                    <li><a class="btn btn-default">RU-адаптированная инструкция</a></li>
                @else
                    <li><a href="{{ route('medicine_edit',['spec'=>'aru', 'medicine'=> $drug->alias]) }}">RU-адаптированная
                            инструкция</a></li>
                @endif
                @if('aua' == $spec)
                    <li><a class="btn btn-default">UA-адаптированная инструкция</a></li>
                @else
                    <li><a href="{{ route('medicine_edit',['spec'=>'aua', 'medicine'=> $drug->alias]) }}">UA-адаптированная
                            инструкция</a></li>
                @endif
            </ul>
        </div>
    </nav>
@endif
<h2>{{ $drug->title }}</h2>
@if('ru' === $spec || 'ua' === $spec )
    <a href="{{ route('faq', ['spec'=>$spec, 'medicine'=>$drug->alias]) }}" class="btn btn-success">FAQ</a>
@endif
<hr>
{!! Form::open(['url'=>route('medicine_edit',['spec'=>$spec, 'medicine'=> $drug->alias]),
                    'method' => 'post', 'class' => 'form-horizontal', 'files'=>true]) !!}
<div class="">
    {{ Form::label('title', 'Название') }}
    {!! Form::text('title', old('title') ? : $drug->title,
                    ['placeholder' => 'Название преперата', 'id'=>'title', 'class'=>'form-control ru-title']) !!}
</div>

@if('ru' == $spec)
    <div class="panel-heading">
        <h2>
            <a data-toggle="collapse" href="#general" class="btn btn-info btn-block">Общее</a>
        </h2>
    </div>
    <div id="general" class="panel-collapse collapse ">
        <hr>
        <div class="panel panel-info alert alert-info">
            <div class="panel-heading">Общее</div>
            <div class="panel-body">
                {{ Form::label('alias', 'URL страницы') }}
                <div>
                    {!! Form::text('alias', old('alias') ? : ($drug->alias ?? '') ,
                     ['placeholder'=>'aspirin', 'id'=>'alias', 'class'=>'form-control eng-alias']) !!}
                </div>
            </div>
            <hr>
            <div class="panel-body">
                <div class="col-lg-4">
                    {{ Form::label('backcolor', 'Фон страницы') }}
                    <div>
                        #{!! Form::text('backcolor', old('backcolor') ? : ($drug->backcolor ?? '') ,
                         ['placeholder'=>'FFF000', 'id'=>'backcolor', 'class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="col-lg-4">
                    <label>
                        <input type="checkbox"
                               {{ (old('approved') || !empty($drug->approved)) ? 'checked' : '' }} value="1"
                               name="approved"> Опубликовать</label>
                </div>
                <div class="col-lg-4">
                    <label>
                        <input type="checkbox"
                               {{ (old('certified') || !empty($drug->certified)) ? 'checked' : '' }} value="1"
                               name="certified"> Сертифицирован</label>
                </div>
            </div>
            <hr>
            <div class="panel-body">
                <div class="col-lg-6">
                    {{ Form::label('form', 'Форма выпуска   ') }}
                    {!! Form::text('form', old('form') ? : ($drug->form->name ?? '') ,
                     ['placeholder'=>'ATX', 'id'=>'form', 'class'=>'form-control autocomplete',
                       'autocomplete'=>'off', 'data-id'=>$drug->form->id]) !!}
                    {!! Form::hidden('form_id', old('form_id') ? : $drug->form->id, ['id'=>'form_id']) !!}
                </div>
                <div class="col-lg-6">
                    {{ Form::label('innname', 'Международное название') }}
                    {!! Form::text('innname', old('innname') ? : ($drug->innname->title ?? '') ,
                     ['placeholder'=>'...', 'id'=>'innname', 'autocomplete'=>'off',
                        'class'=>'form-control autocomplete', 'data-id'=>$drug->innname->id]) !!}
                    {!! Form::hidden('innname_id', old('innname_id') ? : $drug->innname->id, ['id'=>'innname_id']) !!}
                </div>
            </div>
            <hr>
            <div class="panel-body">
                <div class="col-lg-6">
                    {{ Form::label('classification', 'Классификация') }}
                    {!! Form::text('classification', old('classification') ? : ($drug->classification->class ?? '') ,
                     ['placeholder'=>'ATX', 'id'=>'classification', 'class'=>'form-control autocomplete',
                       'autocomplete'=>'off', 'data-id'=>$drug->classification->class]) !!}
                    {!! Form::hidden('classification_id', old('classification_id') ? : $drug->classification->id, ['id'=>'classification_id']) !!}
                </div>
                <div class="col-lg-6">
                    {{ Form::label('pharmagroup_name', 'Фарм. группа') }}
                    {!! Form::text('pharmagroup_name', old('pharmagroup_name') ? : ($drug->pharmagroup->title ?? '') ,
                     ['placeholder'=>'Фарм. группа', 'id'=>'pharmagroup_name', 'class'=>'form-control autocomplete',
                       'autocomplete'=>'off','data-id'=>$drug->pharmagroup->title]) !!}
                    {!! Form::hidden('pharmagroup_name_id', old('pharmagroup_name_id') ? : $drug->pharmagroup->id, ['id'=>'pharmagroup_name_id']) !!}
                </div>
            </div>
            <hr>
            <div class="panel-body">
                <div>
                    {{ Form::label('fabricator_name', 'Производитель') }}
                    {!! Form::text('fabricator_name', old('fabricator_name') ? : ($drug->fabricator_name->title ?? '') ,
                     ['placeholder'=>'...', 'id'=>'fabricator_name', 'class'=>'form-control autocomplete',
                       'autocomplete'=>'off', 'data-id'=>$drug->fabricator_name->id]) !!}
                    {!! Form::hidden('fabricator_name_id', old('fabricator_name_id') ? : $drug->fabricator_name->id, ['id'=>'fabricator_name_id']) !!}
                </div>
            </div>
            <hr>
            <div class="panel-body">
                <div class="block-to-add-substance">
                    {{ Form::label('substance', 'Действующее вещество') }}
                    @if(is_object($drug->substance) && $drug->substance->isNotEmpty())
                        @foreach($drug->substance as $substance)
                            <div>
                                {!! Form::text('substance[]', old('substance') ? : ($substance->title ?? '') ,
                             ['placeholder'=>'...', 'id'=>'substance', 'class'=>'form-control autocomplete',
                               'autocomplete'=>'off', 'data-id'=>$substance->id]) !!}
                                {!! Form::hidden('substance_id[]', old('substance_id') ? : $substance->id, ['id'=>'substance_id']) !!}
                                <span class="remove-this"><button type="button" class="btn btn-danger">-</button></span>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="add-new-substance">
                    <button type="button" class="btn btn-primary">+</button>
                </div>
            </div>
        </div>
    </div>
@endif
<hr>
<div class="row">
    <div class="col-lg-6">
        {{ Form::label('reg', 'Регистрация') }}
        {!! Form::text('reg', old('reg') ? : ($drug->reg ?? ''),
                        ['placeholder' => 'Регистрация', 'id'=>'reg', 'class'=>'form-control']) !!}
    </div>
    <div class="col-lg-6">
        {{ Form::label('dose', 'Дозировка') }}
        {!! Form::text('dose', old('dose') ? : ($drug->dose ?? ''),
                        ['placeholder' => 'Дозировка', 'id'=>'dose', 'class'=>'form-control']) !!}
    </div>
</div>
<hr>


{{--Content--}}
@if(('ru' == $spec) || ('aru' == $spec))
    @include('admin.medicine.sections', ['drug'=>$drug, 'loc'=>true])
@else
    @include('admin.medicine.sections', $drug)
@endif
{{--Content--}}
{{-- Слайдер --}}
@include('admin.medicine.slider', [$drug, $spec])
{{-- Слайдер --}}

<hr>
<!-- SEO -->
<div class="panel-heading">
    <h2>
        <a data-toggle="collapse" href="#service" class="btn btn-info btn-block">SEO</a>
    </h2>
</div>
<div id="service" class="panel-collapse collapse "><h2>SEO</h2>
    <div class="">
        <div class="col-lg-6">
            {{ Form::label('seo_title', 'SEO_TITLE') }}
            <div>
                {!! Form::text('seo_title', old('seo_title') ? : ($drug->seo->seo_title ?? '') , ['placeholder'=>'seo_title', 'id'=>'seo_title', 'class'=>'form-control']) !!}
            </div>
        </div>
        <div class="col-lg-6">
            {{ Form::label('seo_keywords', 'SEO_KEYWORDS') }}
            <div>
                {!! Form::text('seo_keywords', old('seo_keywords') ? : ($drug->seo->seo_keywords ?? '') , ['placeholder'=>'seo_keywords', 'id'=>'seo_keywords', 'class'=>'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="">
        <div class="col-lg-6">
            {{ Form::label('seo_description', 'SEO_DESCRIPTION') }}
            <div>
                {!! Form::text('seo_description', old('seo_description') ? : ($drug->seo->seo_description ?? '') , ['placeholder'=>'seo_description', 'id'=>'seo_description', 'class'=>'form-control']) !!}
            </div>
        </div>
        <div class="col-lg-6">
            {{ Form::label('og_image', 'OG_IMAGE') }}
            <div>
                {!! Form::text('og_image', old('og_image') ? : ($drug->seo->seo_image ?? '') , ['placeholder'=>'og_image', 'id'=>'og_image', 'class'=>'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="">
        <div class="col-lg-6">
            {{ Form::label('og_title', 'OG_TITLE') }}
            <div>
                {!! Form::text('og_title', old('og_title') ? : ($drug->seo->og_title ?? '') , ['placeholder'=>'og_title', 'id'=>'og_title', 'class'=>'form-control']) !!}
            </div>
        </div>
        <div class="col-lg-6">
            {{ Form::label('og_description', 'OG_DESCRIPTION') }}
            <div>
                {!! Form::text('og_description', old('og_description') ? : ($drug->seo->og_description ?? '') ,
                 ['placeholder'=>'og_description', 'id'=>'og_description', 'class'=>'form-control', 'rows'=>20]) !!}
            </div>
        </div>
    </div>
    <div class="">
        {{ Form::label('seo_text', 'SEO_TEXT') }}
        <div>
            <textarea name="seo_text" class="form-control"
                      rows="20">{!! old('seo_text') ? : ($drug->seo->seo_text ?? '') !!}</textarea>
        </div>
    </div>
</div>
<hr>
<!-- SEO -->
{!! Form::button('Сохранить', ['class' => 'btn btn-primary buttn-save','type'=>'submit']) !!}
<hr>
{!! Form::close() !!}
<div class="shablon" style="display:none">
    <div>
        {!! Form::file('slider[]', ['accept'=>'image/*', 'class'=>'form-control']) !!}
        <span class="remove-this"><button type="button" class="btn btn-danger">-</button></span>
        {{ Form::label('imgalt', 'Параметры картинки') }}
        <div class="">
            <div class="col-lg-6">
                {!! Form::text('imgalt[]', null,
                                ['placeholder'=>'Alt', 'id'=>'imgalt', 'class'=>'form-control']) !!}
            </div>
            <div class="col-lg-6">
                {!! Form::text('imgtitle[]', null,
                                ['placeholder'=>'Title', 'id'=>'imgtitle', 'class'=>'form-control']) !!}
            </div>
            <hr>
        </div>
    </div>
    <hr>
</div>
<div class="shablon-substance" style="display:none">
    <div>
        {!! Form::text('substance[]', null, ['placeholder'=>'...', 'class'=>'form-control autocomplete',
              'autocomplete'=>'off']) !!}
        {!! Form::hidden('substance_id[]') !!}
        <span class="remove-this"><button type="button" class="btn btn-danger">-</button></span>
    </div>
</div>
