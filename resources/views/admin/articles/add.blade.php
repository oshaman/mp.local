<h2>Добавление статьи</h2>
{!! Form::open(['url'=>route('create_article'), 'method'=>'POST', 'class'=>'form-horizontal', 'files'=>true]) !!}
<div class="">
    {{ Form::label('title', 'Заголовок страницы') }}
    <div>
        {!! Form::text('title', old('title') ? : '' , ['placeholder'=>'Title', 'id'=>'title', 'class'=>'form-control ru-title']) !!}
    </div>
</div>
<div class="">
    {{ Form::label('alias', 'Псевдоним страницы') }}
    <div>
        {!! Form::text('alias', old('alias') ? : '' , ['placeholder'=>'psevdonim-stranici', 'id'=>'alias', 'class'=>'form-control eng-alias']) !!}
    </div>
</div>
<div class="">
    {{ Form::label('category_id', 'Категория') }}
    <div>
        {!! Form::select('category_id', $cats ?? [],
            old('category_id') ? : '' , [ 'class'=>'form-control', 'placeholder'=>'Категория'])
        !!}
    </div>
</div>
<div class="">
    {{ Form::label('img', 'Параметры картинки') }}
    <div class="">
        <div class="col-lg-6">
            {!! Form::text('imgalt', old('imgalt') ? : '' , ['placeholder'=>'Alt', 'id'=>'imgalt', 'class'=>'form-control']) !!}
        </div>
        <div class="col-lg-6">
            {!! Form::text('imgtitle', old('imgtitle') ? : '' , ['placeholder'=>'Title', 'id'=>'imgtitle', 'class'=>'form-control']) !!}
        </div>
    </div>
    {{ Form::label('img', 'Основное изображение') }}
    <div>
        {!! Form::file('img', ['accept'=>'image/*', 'id'=>'img', 'class'=>'form-control']) !!}
    </div>
</div>
<div class="">
    {{ Form::label('tags', 'Тэги') }}
    @if(!empty($tags))
        <div>
            <table class="table tags">
                @foreach($tags as $id=>$tag)
                    <td>
                        <input name="tags[]" type="checkbox"
                               @if(!empty(old('tags')))
                               @foreach(old('tags') as $val)
                               @if($val == $id)
                               checked
                               @endif
                               @endforeach
                               @endif
                               value="{{ $id }}"> {{ $tag }}
                    </td>
                @endforeach
            </table>
        </div>
    @endif
</div>
<!-- SEO -->
<div class="panel-heading">
    <h2>
        <a data-toggle="collapse" href="#service" class="btn btn-info btn-block">SEO</a>
    </h2>
</div>
<div id="service" class="panel-collapse collapse ">
    <h2>SEO</h2>
    <div class="">
        <div class="col-lg-6">
            {{ Form::label('seo_title', 'SEO_TITLE') }}
            <div>
                {!! Form::text('seo_title', old('seo_title') ? : '' , ['placeholder'=>'seo_title', 'id'=>'seo_title', 'class'=>'form-control']) !!}
            </div>
        </div>
        <div class="col-lg-6">
            {{ Form::label('seo_keywords', 'SEO_KEYWORDS') }}
            <div>
                {!! Form::text('seo_keywords', old('seo_keywords') ? : '' , ['placeholder'=>'seo_keywords', 'id'=>'seo_keywords', 'class'=>'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="">
        <div class="col-lg-6">
            {{ Form::label('seo_description', 'SEO_DESCRIPTION') }}
            <div>
                {!! Form::text('seo_description', old('seo_description') ? : '' , ['placeholder'=>'seo_description', 'id'=>'seo_description', 'class'=>'form-control']) !!}
            </div>
        </div>
        <div class="col-lg-6">
            {{ Form::label('og_image', 'OG_IMAGE') }}
            <div>
                {!! Form::text('og_image', old('og_image') ? : '' , ['placeholder'=>'og_image', 'id'=>'og_image', 'class'=>'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="">
        <div class="col-lg-6">
            {{ Form::label('og_title', 'OG_TITLE') }}
            <div>
                {!! Form::text('og_title', old('og_title') ? : '' , ['placeholder'=>'og_title', 'id'=>'og_title', 'class'=>'form-control']) !!}
            </div>
        </div>
        <div class="col-lg-6">
            {{ Form::label('og_description', 'OG_DESCRIPTION') }}
            <div>
                {!! Form::text('og_description', old('og_description') ? : '' , ['placeholder'=>'og_description', 'id'=>'og_description', 'class'=>'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="">
        {{ Form::label('seo_text', 'SEO_TEXT') }}
        <div>
            <textarea name="seo_text" class="form-control" rows="20">{!! old('seo_text') ? : '' !!}</textarea>
        </div>
    </div>
</div>
<!-- SEO -->
<div class="row">
    <!-- Approved -->
    <div class="col-lg-6">
        <label>
            <input type="checkbox" {{ old('confirmed') ? 'checked' : ''}} value="1" name="confirmed">
            В тираж
        </label>
    </div>
    <div class="col-lg-6">
        <h4>{!! Form::label('outputtime', 'Дата публикации') !!}</h4>
        <div class="input-prepend"><span class="add-on"><i class="icon-time"></i></span>
            <input type="text" name="outputtime" id="outputtime" value="{{ old('outputtime') ? : date('Y-m-d H:i') }}">
        </div>
    </div>
</div>
<hr>
<div class="row">
    <textarea name="content" class="form-control editor">{!! old('content') ? : '' !!}</textarea>
</div>
<div class="row">
    <hr>
    {!! Form::button('Сохранить', ['class' => 'btn btn-large btn-primary','type'=>'submit']) !!}
</div>
{!! Form::close() !!}
