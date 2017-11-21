<h2>Создание препарата:</h2>
{!! Form::open(['url'=>route('medicine_create'),
                    'method' => 'post', 'class' => 'form-horizontal', 'files'=>true]) !!}
<div class="">
    {{ Form::label('title', 'Название') }}
    {!! Form::text('title', old('title') ? : '',
                    ['placeholder' => 'Название преперата', 'id'=>'title', 'class'=>'form-control ru-title']) !!}
</div>
<div class="panel-heading">
    <h2>
        <a data-toggle="collapse" href="#general" class="btn btn-info btn-block">Общее</a>
    </h2>
</div>
<div id="general" class="panel-collapse collapse ">

    <hr>
    <div class="panel panel-info">
        <div class="panel-heading">Общее</div>
        <div class="panel-body">
            {{ Form::label('alias', 'Псевдоним страницы') }}
            <div>
                {!! Form::text('alias', old('alias') ? : '',
                 ['placeholder'=>'aspirin', 'id'=>'alias', 'class'=>'form-control eng-alias']) !!}
            </div>
        </div>
        <hr>
        <div class="panel-body">
            <label>
                <input type="checkbox" {{ old('approved') ? 'checked' : '' }} value="1"
                       name="approved"> Опубликовать</label>
        </div>
        <div class="panel-body">
            <div class="col-lg-6">
                {{ Form::label('form', 'Форма выпуска   ') }}
                {!! Form::text('form', old('form') ? : '',
                 ['placeholder'=>'ATX', 'id'=>'form', 'class'=>'form-control', 'data-id'=>'']) !!}
            </div>
            <div class="col-lg-6">
                {{ Form::label('innname', 'Международное название') }}
                {!! Form::text('innname', old('innname') ? : '',
                 ['placeholder'=>'...', 'id'=>'innname', 'class'=>'form-control', 'data-id'=>'']) !!}
            </div>
        </div>
        <hr>
        <div class="panel-body">
            <div class="col-lg-6">
                {{ Form::label('classification', 'Классификация') }}
                {!! Form::text('classification', old('classification') ? : '',
                 ['placeholder'=>'ATX', 'id'=>'classification', 'class'=>'form-control', 'data-id'=>'']) !!}
            </div>
            <div class="col-lg-6">
                {{ Form::label('pharmagroup_id', 'Фарм. группа') }}
                {!! Form::text('pharmagroup_id', old('pharmagroup_id') ? : '',
                 ['placeholder'=>'Фарм. группа', 'id'=>'pharmagroup_id', 'class'=>'form-control', 'data-id'=>'']) !!}
            </div>
        </div>
        <hr>
        <div class="panel-body">
            <div>
                {{ Form::label('fabricator_name', 'Производитель') }}
                {!! Form::text('fabricator_name', old('fabricator_name') ? : '',
                 ['placeholder'=>'...', 'id'=>'fabricator_name', 'class'=>'form-control', 'data-id'=>'']) !!}
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-lg-6">
        {{ Form::label('reg', 'Регистрация') }}
        {!! Form::text('reg', old('reg') ? : '',
                        ['placeholder' => 'Регистрация', 'id'=>'reg', 'class'=>'form-control']) !!}
    </div>
    <div class="col-lg-6">
        {{ Form::label('dose', 'Дозировка') }}
        {!! Form::text('dose', old('dose') ? : '',
                        ['placeholder' => 'Дозировка', 'id'=>'dose', 'class'=>'form-control']) !!}
    </div>
</div>
<hr>


{{--Content--}}
@include('admin.medicine.sections')
{{--Content--}}
{{-- Слайдер --}}
@include('admin.medicine.slider')
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
                {!! Form::text('seo_title', old('seo_title') ? : '',
                 ['placeholder'=>'seo_title', 'id'=>'seo_title', 'class'=>'form-control']) !!}
            </div>
        </div>
        <div class="col-lg-6">
            {{ Form::label('seo_keywords', 'SEO_KEYWORDS') }}
            <div>
                {!! Form::text('seo_keywords', old('seo_keywords') ? : '',
                        ['placeholder'=>'seo_keywords', 'id'=>'seo_keywords', 'class'=>'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="">
        <div class="col-lg-6">
            {{ Form::label('seo_description', 'SEO_DESCRIPTION') }}
            <div>
                {!! Form::text('seo_description', old('seo_description') ? : '',
                 ['placeholder'=>'seo_description', 'id'=>'seo_description', 'class'=>'form-control']) !!}
            </div>
        </div>
        <div class="col-lg-6">
            {{ Form::label('og_image', 'OG_IMAGE') }}
            <div>
                {!! Form::text('og_image', old('og_image') ? : '',
                 ['placeholder'=>'og_image', 'id'=>'og_image', 'class'=>'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="">
        <div class="col-lg-6">
            {{ Form::label('og_title', 'OG_TITLE') }}
            <div>
                {!! Form::text('og_title', old('og_title') ? :'',
                 ['placeholder'=>'og_title', 'id'=>'og_title', 'class'=>'form-control']) !!}
            </div>
        </div>
        <div class="col-lg-6">
            {{ Form::label('og_description', 'OG_DESCRIPTION') }}
            <div>
                {!! Form::text('og_description', old('og_description') ? : '',
                 ['placeholder'=>'og_description', 'id'=>'og_description', 'class'=>'form-control', 'rows'=>20]) !!}
            </div>
        </div>
    </div>
    <div class="">
        {{ Form::label('seo_text', 'SEO_TEXT') }}
        <div>
            <textarea name="seo_text" class="form-control"
                      rows="20">{!! old('seo_text') ? : '' !!}</textarea>
        </div>
    </div>
</div>
<hr>
<!-- SEO -->
{!! Form::button('Создать', ['class' => 'btn btn-primary','type'=>'submit']) !!}
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