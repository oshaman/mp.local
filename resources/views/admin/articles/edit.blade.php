<h2>Редактирование статьи</h2>
{!! Form::open(['url'=>route('edit_article', ['spec' => $spec , 'article' => $article->id]),
    'method'=>'POST', 'class'=>'form-horizontal', 'files'=>true]) !!}
{{ csrf_field() }}
<div class="">
    {{ Form::label('title', 'Заголовок страницы') }}
    <div>
        {!! Form::text('title', old('title') ? : ($article->title ?? '') , ['placeholder'=>'Title', 'id'=>'title', 'class'=>'form-control ru-title']) !!}
    </div>
</div>
<div class="">
    {{ Form::label('alias', 'Псевдоним страницы') }}
    <div>
        {!! Form::text('alias', old('alias') ? : ($article->alias ?? '') , ['placeholder'=>'psevdonim-stranici', 'id'=>'alias', 'class'=>'form-control eng-alias']) !!}
    </div>
</div>
<div class="">
    {{ Form::label('cats', 'Категория') }}
    <div>
        {!! Form::select('cats', $cats ?? [],
            old('cats') ? : ($article->category_id ?? '') , [ 'class'=>'form-control', 'placeholder'=>'Категория'])
        !!}
    </div>
</div>
<div class="">
    {{ Form::label('img', 'Основное изображение') }}
    @if(!empty($article->image))
        <div>
            {{ Html::image(asset('/asset/images/articles/'.$spec.'/main').'/'.$article->image->path, 'a picture', array('class' => 'thumb')) }}
        </div>
    @endif
    {{ Form::label('img', 'Параметры картинки') }}
    <div class="">
        <div class="col-lg-6">
            {!! Form::text('imgalt', old('imgalt') ? : ($article->image->alt ?? ''),
                ['placeholder'=>'Alt', 'id'=>'imgalt', 'class'=>'form-control']) !!}
        </div>
        <div class="col-lg-6">
            {!! Form::text('imgtitle', old('imgtitle') ? : ($article->image->title ?? ''),
                ['placeholder'=>'Title', 'id'=>'imgtitle', 'class'=>'form-control']) !!}
        </div>
    </div>
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
                               @elseif($article->hasTag($id))
                               checked
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
    <div class="">
        <div class="col-lg-6">
            {{ Form::label('seo_title', 'SEO_TITLE') }}
            <div>
                {!! Form::text('seo_title', old('seo_title') ? : ($article->seo->seo_title ?? '') , ['placeholder'=>'seo_title', 'id'=>'seo_title', 'class'=>'form-control']) !!}
            </div>
        </div>
        <div class="col-lg-6">
            {{ Form::label('seo_keywords', 'SEO_KEYWORDS') }}
            <div>
                {!! Form::text('seo_keywords', old('seo_keywords') ? : ($article->seo->seo_keywords ?? '') , ['placeholder'=>'seo_keywords', 'id'=>'seo_keywords', 'class'=>'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="">
        <div class="col-lg-6">
            {{ Form::label('seo_description', 'SEO_DESCRIPTION') }}
            <div>
                {!! Form::text('seo_description', old('seo_description') ? : ($article->seo->seo_description ?? '') , ['placeholder'=>'seo_description', 'id'=>'seo_description', 'class'=>'form-control']) !!}
            </div>
        </div>
        <div class="col-lg-6">
            {{ Form::label('og_image', 'OG_IMAGE') }}
            <div>
                {!! Form::text('og_image', old('og_image') ? : ($article->seo->og_image ?? '') , ['placeholder'=>'og_image', 'id'=>'og_image', 'class'=>'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="">
        <div class="col-lg-6">
            {{ Form::label('og_title', 'OG_TITLE') }}
            <div>
                {!! Form::text('og_title', old('og_title') ? : ($article->seo->og_title ?? '') , ['placeholder'=>'og_title', 'id'=>'og_title', 'class'=>'form-control']) !!}
            </div>
        </div>
        <div class="col-lg-6">
            {{ Form::label('og_description', 'OG_DESCRIPTION') }}
            <div>
                {!! Form::text('og_description', old('og_description') ? : ($article->seo->og_description ?? '') , ['placeholder'=>'og_description', 'id'=>'og_description', 'class'=>'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="">
        {{ Form::label('seo_text', 'SEO_TEXT') }}
        <div>
            <textarea name="seo_text" rows="20"
                      class="form-control">{!! old('seo_text') ? : ($article->seo->seo_text ?? '') !!}</textarea>
        </div>
    </div>
</div>
<!-- SEO -->

<div class="row">
    <div class="input-prepend col-lg-6"><span class="add-on"><i class="icon-time"></i></span>
        <h4>{!! Form::label('outputtime', 'Дата публикации') !!}</h4>
        <input type="text" name="outputtime" id="outputtime"
               value="{{ old('outputtime') ? : (date('Y-m-d H:i', strtotime($article->created_at)) ?? date('Y-m-d H:i')) }}">
    </div>
    {{--<div class="col-lg-6">
        <h4>{!! Form::label('view', 'Кол-во просмотров') !!}</h4>
        <div class="input-prepend col-lg-6">
            <input type="text" name="view" id="view"
                   value="{{ old('view') ? : $article->view }}">
        </div>
    </div>--}}
</div>
<div class="">
    <label>
        <input type="checkbox" {{ (old('confirmed') || !empty($article->approved)) ? 'checked' : '' }} value="1"
               name="confirmed"> В тираж</label>
</div>
<hr>
<div class="row">
    <textarea name="content" class="form-control editor">{!! old('content') ? : ($article->content ?? '') !!}</textarea>
    <hr>
    {!! Form::button('Сохранить', ['class' => 'btn btn-large btn-primary','type'=>'submit']) !!}
</div>
{!! Form::close() !!}
