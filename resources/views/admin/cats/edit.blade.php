<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            @if('cats' == Route::currentRouteName())
                <li><a class="btn btn-default">Категории</a></li>
            @else
                <li><a href="{{ route('cats') }}">Категории</a></li>
            @endif
            @if('create_article' == Route::currentRouteName())
                <li><a class="btn btn-default">UA-инструкция</a></li>
            @else
                <li><a href="{{ route('create_article') }}">Создать статью</a></li>
            @endif
        </ul>
    </div>
</nav>
<h1>Редактирование категории</h1>

{!! Form::open(['url' => route('edit_cats', $category->id), 'class'=>'form-horizontal','method'=>'POST' ]) !!}
<div class="">
    {{ Form::label('title', 'Название категории') }}
    <div class="">
        {!! Form::text('title', old('title') ? : ($category->title ?? ''),
            ['placeholder'=>'Психиатр...', 'id'=>'title', 'class'=>'form-control ru-title']) !!}
    </div>
    {{ Form::label('utitle', 'UA-Название категории') }}
    <div class="">
        {!! Form::text('utitle', old('utitle') ? : ($category->utitle ?? ''),
           ['placeholder'=>'Психиатр...', 'id'=>'utitle', 'class'=>'form-control']) !!}
    </div>
    {{ Form::label('title', 'URL категории') }}
    <div class="">
        {!! Form::text('alias', old('alias') ? : ($category->alias ?? ''),
            ['placeholder'=>'psihiatr...', 'id'=>'alias', 'class'=>'form-control eng-alias']) !!}
    </div>
    <!-- SEO -->
    <div class="panel-heading">
        <h2>
            <a data-toggle="collapse" href="#service" class="btn btn-info btn-block">SEO</a>
        </h2>
    </div>
    <div id="service" class="panel-collapse collapse ">
        <div class="">
            <div class="col-lg-6">
                {{ Form::label('seo_title', 'SEO_TITLE') }}
                <div>
                    {!! Form::text('seo_title', old('seo_title') ? : ($category->seo->seo_title ?? ''),
                                    ['placeholder'=>'seo_title', 'id'=>'seo_title', 'class'=>'form-control']) !!}
                </div>
            </div>
            <div class="col-lg-6">
                {{ Form::label('seo_keywords', 'SEO_KEYWORDS') }}
                <div>
                    {!! Form::text('seo_keywords', old('seo_keywords') ? : ($category->seo->seo_keywords ?? ''),
                                    ['placeholder'=>'seo_keywords', 'id'=>'seo_keywords', 'class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="">
            <div class="col-lg-6">
                {{ Form::label('seo_description', 'SEO_DESCRIPTION') }}
                <div>
                    {!! Form::text('seo_description', old('seo_description') ? : ($category->seo->seo_description ?? ''),
                                    ['placeholder'=>'seo_description', 'id'=>'seo_description', 'class'=>'form-control']) !!}
                </div>
            </div>
            <div class="col-lg-6">
                {{ Form::label('og_image', 'OG_IMAGE') }}
                <div>
                    {!! Form::text('og_image', old('og_image') ? : ($category->seo->og_image ?? ''),
                                    ['placeholder'=>'og_image', 'id'=>'og_image', 'class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="">
            <div class="col-lg-6">
                {{ Form::label('og_title', 'OG_TITLE') }}
                <div>
                    {!! Form::text('og_title', old('og_title') ? : ($category->seo->og_title ?? ''),
                                    ['placeholder'=>'og_title', 'id'=>'og_title', 'class'=>'form-control']) !!}
                </div>
            </div>
            <div class="col-lg-6">
                {{ Form::label('og_description', 'OG_DESCRIPTION') }}
                <div>
                    {!! Form::text('og_description', old('og_description') ? : ($category->seo->og_description ?? ''),
                                ['placeholder'=>'og_description', 'id'=>'og_description', 'class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="">
            {{ Form::label('seo_text', 'SEO_TEXT') }}
            <div>
            <textarea name="seo_text" rows="20"
                      class="form-control">{!! old('seo_text') ? : ($category->seo->seo_text ?? '') !!}</textarea>
            </div>
        </div>
    </div>
    <!-- SEO -->
    <!-- SEO -->
    <div class="panel-heading">
        <h2>
            <a data-toggle="collapse" href="#useo" class="btn btn-info btn-block">UA-SEO</a>
        </h2>
    </div>
    <div id="useo" class="panel-collapse collapse ">
        <div class="">
            <div class="col-lg-6">
                {{ Form::label('useo_title', 'SEO_TITLE') }}
                <div>
                    {!! Form::text('useo_title', old('useo_title') ? : ($category->seo->useo_title ?? ''),
                                ['placeholder'=>'seo_title', 'id'=>'useo_title', 'class'=>'form-control']) !!}
                </div>
            </div>
            <div class="col-lg-6">
                {{ Form::label('useo_keywords', 'SEO_KEYWORDS') }}
                <div>
                    {!! Form::text('useo_keywords', old('useo_keywords') ? : ($category->seo->useo_keywords ?? ''),
                                ['placeholder'=>'seo_keywords', 'id'=>'useo_keywords', 'class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="">
            <div class="col-lg-6">
                {{ Form::label('useo_description', 'SEO_DESCRIPTION') }}
                <div>
                    {!! Form::text('useo_description', old('useo_description') ? : ($category->seo->useo_description ?? ''),
                     ['placeholder'=>'seo_description', 'id'=>'useo_description', 'class'=>'form-control']) !!}
                </div>
            </div>
            <div class="col-lg-6">
                {{ Form::label('uog_image', 'OG_IMAGE') }}
                <div>
                    {!! Form::text('uog_image', old('uog_image') ? : ($category->seo->uog_image ?? ''),
                            ['placeholder'=>'og_image', 'id'=>'uog_image', 'class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="">
            <div class="col-lg-6">
                {{ Form::label('uog_title', 'OG_TITLE') }}
                <div>
                    {!! Form::text('uog_title', old('uog_title') ? : ($category->seo->uog_title ?? ''),
                            ['placeholder'=>'og_title', 'id'=>'uog_title', 'class'=>'form-control']) !!}
                </div>
            </div>
            <div class="col-lg-6">
                {{ Form::label('uog_description', 'OG_DESCRIPTION') }}
                <div>
                    {!! Form::text('uog_description', old('uog_description') ? : ($category->seo->uog_description ?? ''),
                            ['placeholder'=>'og_description', 'id'=>'uog_description', 'class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="">
            {{ Form::label('useo_text', 'SEO_TEXT') }}
            <div>
            <textarea name="useo_text" rows="20"
                      class="form-control">{!! old('useo_text') ? : ($category->seo->useo_text ?? '') !!}</textarea>
            </div>
        </div>
    </div>
    <!-- SEO -->
    <hr>
    <div class="">
        {!! Form::button('Сохранить', ['class' => 'btn btn-primary','type'=>'submit']) !!}
    </div>
    {!! Form::close() !!}
</div>