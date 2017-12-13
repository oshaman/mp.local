<h2>Редактирование темы</h2>
{!! Form::open(['url'=>route('themes_update', ['theme' => $theme->id]),
    'method'=>'POST', 'class'=>'form-horizontal', 'files'=>true]) !!}
<div class="">
    {{ Form::label('title', 'Название') }}
    <div>
        {!! Form::text('title', old('title') ? : ($theme->title ?? ''),
                            ['placeholder'=>'Title', 'id'=>'title', 'class'=>'form-control']) !!}
    </div>
</div>
<div class="">
    {{ Form::label('img', 'Основное изображение') }}
    @if(!empty($theme->path))
        <div>
            {{ Html::image(asset('/asset/images/theme').'/'.$theme->path, 'a picture', array('class' => 'img-thumbnail')) }}
        </div>
    @endif
    {{ Form::label('img', 'Параметры картинки') }}
    <div class="">
        <div class="col-lg-6">
            {!! Form::text('alt', old('alt') ? : ($theme->alt ?? ''),
                            ['placeholder'=>'Alt', 'id'=>'alt', 'class'=>'form-control']) !!}
        </div>
        <div class="col-lg-6">
            {!! Form::text('imgtitle', old('imgtitle') ? : ($theme->imgtitle ?? ''),
                        ['placeholder'=>'Title', 'id'=>'imgtitle', 'class'=>'form-control']) !!}
        </div>
    </div>
    {{ Form::label('img', 'Основное изображение') }}
    <div>
        {!! Form::file('img', ['accept'=>'image/*', 'id'=>'img', 'class'=>'form-control']) !!}
    </div>
</div>
<div class="">
    {{ Form::label('description', 'Описание темы') }}
    <div>
        {!! Form::text('description', old('description') ? : ($theme->description ?? ''),
                    ['placeholder'=>'description', 'id'=>'description', 'class'=>'form-control']) !!}
    </div>
</div>
<div class="">
    {{ Form::label('link', 'URL') }}
    <div>
        {!! Form::text('link', old('link') ? : ($theme->link ?? ''),
                   ['placeholder'=>'link', 'id'=>'link', 'class'=>'form-control']) !!}
    </div>
</div>
<div class="">
    {{ Form::label('priority', 'Приоритет(0-255)') }}
    <div>
        {!! Form::number('priority', old('priority') ? : ($theme->priority ?? ''),
         ['id'=>'priority', 'class'=>'form-control']) !!}
    </div>
</div>
<div class="row">
    <!-- Approved -->
    <div class="col-lg-6">
        <label>
            Опубликовать
        </label>
        <input type="checkbox" {{ (old('approved') || !empty($theme->approved)) ? 'checked' : ''}}
        value="1" name="approved">
    </div>
    <div class="col-lg-6">
        {!! Form::label('loc', 'Локализация') !!}
        <div>
            {!! Form::select('loc', [1=>'RU', 2=>'UA'],
                old('loc') ? : ($theme->loc_id ?? ''), [ 'class'=>'form-control', 'placeholder'=>'RU\UA'])
            !!}
        </div>
    </div>
</div>
<div class="row">
    <hr>
    {!! Form::button('Сохранить', ['class' => 'btn btn-large btn-primary','type'=>'submit']) !!}
</div>
{!! Form::close() !!}
