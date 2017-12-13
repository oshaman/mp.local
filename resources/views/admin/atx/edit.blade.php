<h1>Редактирование ATX</h1>

{!! Form::open(['url' => route('atx_update',['atx'=> $class->id]), 'class'=>'form-horizontal','method'=>'POST' ]) !!}
<div class="">
    <h2>ATX: {{ $class->class ?? '' }}</h2>
    <hr>
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
                    {!! Form::text('seo_title', old('seo_title') ? : ($class->seo->seo_title ?? ''),
                                    ['placeholder'=>'seo_title', 'id'=>'seo_title', 'class'=>'form-control']) !!}
                </div>
            </div>
            <div class="col-lg-6">
                {{ Form::label('seo_keywords', 'SEO_KEYWORDS') }}
                <div>
                    {!! Form::text('seo_keywords', old('seo_keywords') ? : ($class->seo->seo_keywords ?? ''),
                                    ['placeholder'=>'seo_keywords', 'id'=>'seo_keywords', 'class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="">
            <div class="col-lg-6">
                {{ Form::label('seo_description', 'SEO_DESCRIPTION') }}
                <div>
                    {!! Form::text('seo_description', old('seo_description') ? : ($class->seo->seo_description ?? ''),
                                    ['placeholder'=>'seo_description', 'id'=>'seo_description', 'class'=>'form-control']) !!}
                </div>
            </div>
            <div class="col-lg-6">
                {{ Form::label('og_image', 'OG_IMAGE') }}
                <div>
                    {!! Form::text('og_image', old('og_image') ? : ($class->seo->og_image ?? ''),
                                    ['placeholder'=>'og_image', 'id'=>'og_image', 'class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="">
            <div class="col-lg-6">
                {{ Form::label('og_title', 'OG_TITLE') }}
                <div>
                    {!! Form::text('og_title', old('og_title') ? : ($class->seo->og_title ?? ''),
                                    ['placeholder'=>'og_title', 'id'=>'og_title', 'class'=>'form-control']) !!}
                </div>
            </div>
            <div class="col-lg-6">
                {{ Form::label('og_description', 'OG_DESCRIPTION') }}
                <div>
                    {!! Form::text('og_description', old('og_description') ? : ($class->seo->og_description ?? ''),
                                ['placeholder'=>'og_description', 'id'=>'og_description', 'class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="">
            {{ Form::label('seo_text', 'SEO_TEXT') }}
            <div>
            <textarea name="seo_text" rows="20"
                      class="form-control">{!! old('seo_text') ? : ($class->seo->seo_text ?? '') !!}</textarea>
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
                    {!! Form::text('useo_title', old('useo_title') ? : ($class->seo->useo_title ?? ''),
                                ['placeholder'=>'seo_title', 'id'=>'useo_title', 'class'=>'form-control']) !!}
                </div>
            </div>
            <div class="col-lg-6">
                {{ Form::label('useo_keywords', 'SEO_KEYWORDS') }}
                <div>
                    {!! Form::text('useo_keywords', old('useo_keywords') ? : ($class->seo->useo_keywords ?? ''),
                                ['placeholder'=>'seo_keywords', 'id'=>'useo_keywords', 'class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="">
            <div class="col-lg-6">
                {{ Form::label('useo_description', 'SEO_DESCRIPTION') }}
                <div>
                    {!! Form::text('useo_description', old('useo_description') ? : ($class->seo->useo_description ?? ''),
                     ['placeholder'=>'seo_description', 'id'=>'useo_description', 'class'=>'form-control']) !!}
                </div>
            </div>
            <div class="col-lg-6">
                {{ Form::label('uog_image', 'OG_IMAGE') }}
                <div>
                    {!! Form::text('uog_image', old('uog_image') ? : ($class->seo->uog_image ?? ''),
                            ['placeholder'=>'og_image', 'id'=>'uog_image', 'class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="">
            <div class="col-lg-6">
                {{ Form::label('uog_title', 'OG_TITLE') }}
                <div>
                    {!! Form::text('uog_title', old('uog_title') ? : ($class->seo->uog_title ?? ''),
                            ['placeholder'=>'og_title', 'id'=>'uog_title', 'class'=>'form-control']) !!}
                </div>
            </div>
            <div class="col-lg-6">
                {{ Form::label('uog_description', 'OG_DESCRIPTION') }}
                <div>
                    {!! Form::text('uog_description', old('uog_description') ? : ($class->seo->uog_description ?? ''),
                            ['placeholder'=>'og_description', 'id'=>'uog_description', 'class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="">
            {{ Form::label('useo_text', 'SEO_TEXT') }}
            <div>
            <textarea name="useo_text" rows="20"
                      class="form-control">{!! old('useo_text') ? : ($class->seo->useo_text ?? '') !!}</textarea>
            </div>
        </div>
    </div>
    <!-- SEO -->
    <div class="">
        {!! Form::button('Сохранить', ['class' => 'btn btn-primary','type'=>'submit']) !!}
    </div>
    {!! Form::close() !!}
</div>