<h1>Редактирование категории</h1>

{!! Form::open(['url' => route('edit_tags', $tag->id), 'class'=>'form-horizontal','method'=>'POST' ]) !!}
<div class="">
    {{ Form::label('tag', 'Название тэга') }}
    <div class="">
        {!! Form::text('tag', old('tag') ? : ($tag->name ?? '') , ['placeholder'=>'Психиатрия...', 'id'=>'tag', 'class'=>'form-control ru-title']) !!}
    </div>
    {{ Form::label('utag', 'UA-Название тэга') }}
    <div class="">
        {!! Form::text('utag', old('utag') ? : ($tag->uname ?? '') , ['placeholder'=>'Психиатрiя...', 'id'=>'utag', 'class'=>'form-control']) !!}
    </div>
    <div class="">
        {!! Form::text('alias', old('alias') ? : ($tag->alias ?? '') , ['placeholder'=>'psihiatr...', 'id'=>'cat', 'class'=>'form-control eng-alias']) !!}
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
                    {!! Form::text('seo_title', old('seo_title') ? : ($tag->seo->seo_title ?? '') , ['placeholder'=>'seo_title', 'id'=>'seo_title', 'class'=>'form-control']) !!}
                </div>
            </div>
            <div class="col-lg-6">
                {{ Form::label('seo_keywords', 'SEO_KEYWORDS') }}
                <div>
                    {!! Form::text('seo_keywords', old('seo_keywords') ? : ($tag->seo->seo_keywords ?? '') , ['placeholder'=>'seo_keywords', 'id'=>'seo_keywords', 'class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="">
            <div class="col-lg-6">
                {{ Form::label('seo_description', 'SEO_DESCRIPTION') }}
                <div>
                    {!! Form::text('seo_description', old('seo_description') ? : ($tag->seo->seo_description ?? '') , ['placeholder'=>'seo_description', 'id'=>'seo_description', 'class'=>'form-control']) !!}
                </div>
            </div>
            <div class="col-lg-6">
                {{ Form::label('og_image', 'OG_IMAGE') }}
                <div>
                    {!! Form::text('og_image', old('og_image') ? : ($tag->seo->og_image ?? '') , ['placeholder'=>'og_image', 'id'=>'og_image', 'class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="">
            <div class="col-lg-6">
                {{ Form::label('og_title', 'OG_TITLE') }}
                <div>
                    {!! Form::text('og_title', old('og_title') ? : ($tag->seo->og_title ?? '') , ['placeholder'=>'og_title', 'id'=>'og_title', 'class'=>'form-control']) !!}
                </div>
            </div>
            <div class="col-lg-6">
                {{ Form::label('og_description', 'OG_DESCRIPTION') }}
                <div>
                    {!! Form::text('og_description', old('og_description') ? : ($tag->seo->og_description ?? '') , ['placeholder'=>'og_description', 'id'=>'og_description', 'class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="">
            {{ Form::label('seo_text', 'SEO_TEXT') }}
            <div>
            <textarea name="seo_text" rows="20"
                      class="form-control">{!! old('seo_text') ? : ($tag->seo->seo_text ?? '') !!}</textarea>
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
                    {!! Form::text('useo_title', old('useo_title') ? : ($tag->useo->useo_title ?? ''),
                                ['placeholder'=>'seo_title', 'id'=>'useo_title', 'class'=>'form-control']) !!}
                </div>
            </div>
            <div class="col-lg-6">
                {{ Form::label('useo_keywords', 'SEO_KEYWORDS') }}
                <div>
                    {!! Form::text('useo_keywords', old('useo_keywords') ? : ($tag->useo->useo_keywords ?? ''),
                                ['placeholder'=>'seo_keywords', 'id'=>'useo_keywords', 'class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="">
            <div class="col-lg-6">
                {{ Form::label('useo_description', 'SEO_DESCRIPTION') }}
                <div>
                    {!! Form::text('useo_description', old('useo_description') ? : ($tag->useo->useo_description ?? ''),
                     ['placeholder'=>'seo_description', 'id'=>'useo_description', 'class'=>'form-control']) !!}
                </div>
            </div>
            <div class="col-lg-6">
                {{ Form::label('uog_image', 'OG_IMAGE') }}
                <div>
                    {!! Form::text('uog_image', old('uog_image') ? : ($tag->useo->uog_image ?? ''),
                            ['placeholder'=>'og_image', 'id'=>'uog_image', 'class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="">
            <div class="col-lg-6">
                {{ Form::label('uog_title', 'OG_TITLE') }}
                <div>
                    {!! Form::text('uog_title', old('uog_title') ? : ($tag->useo->uog_title ?? ''),
                            ['placeholder'=>'og_title', 'id'=>'uog_title', 'class'=>'form-control']) !!}
                </div>
            </div>
            <div class="col-lg-6">
                {{ Form::label('uog_description', 'OG_DESCRIPTION') }}
                <div>
                    {!! Form::text('uog_description', old('uog_description') ? : ($tag->useo->uog_description ?? ''),
                            ['placeholder'=>'og_description', 'id'=>'uog_description', 'class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="">
            {{ Form::label('useo_text', 'SEO_TEXT') }}
            <div>
            <textarea name="useo_text" rows="20"
                      class="form-control">{!! old('useo_text') ? : ($tag->useo->useo_text ?? '') !!}</textarea>
            </div>
        </div>
    </div>
    <!-- SEO -->
    <div class="">
        {!! Form::button('Сохранить', ['class' => 'btn btn-primary','type'=>'submit']) !!}
    </div>
    {!! Form::close() !!}
</div>