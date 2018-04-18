@include('admin.static.nav')
<div class="panel-group accordion2" id="accordion">
    @if(is_object($advs) && $advs->isNotEmpty())
        @foreach($advs as $adv)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $loop->index }}">
                            # {{ $adv->title }}</a>
                    </h4>
                </div>
                <div id="collapse{{ $loop->index }}" class="panel-collapse collapse">
                    <div class="panel-body">
                        {!! Form::open(['url' => route('adv_admin', $adv->id), 'method' => 'post', 'class' => 'form-horizontal', 'files' => true]) !!}
                        <div class="row">
                            <div class="col-lg-6">
                                {{ Form::label('title', 'RU-Заголовок') }}
                                <div>
                                    {!! Form::text('title', $adv->title ?? '',
                                     ['placeholder'=>'Баннеры', 'class'=>'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                {{ Form::label('utitle', 'UA-Заголовок') }}
                                <div>
                                    {!! Form::text('utitle', $adv->utitle ?? '',
                                     ['placeholder'=>'Баннеры', 'class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-6">
                                {{ Html::image(asset('/asset/images/rk/ru').'/'.$adv->path, 'ru picture', array('class' => 'img-thumbnail')) }}
                                @if(!empty($adv->path))
                                    <span class="pull-right">
                                        <button type="button" class="btn btn-danger remove-image"
                                                data-img="{{ $adv->id }}" data-src="ru">-</button>
                                    </span>
                                @endif
                            </div>
                            <div class="col-lg-6">
                                {{ Html::image(asset('/asset/images/rk/ua').'/'.$adv->upath, 'ua picture', array('class' => 'img-thumbnail')) }}
                                @if(!empty($adv->upath))
                                    <span class="pull-right">
                                        <button type="button" class="btn btn-danger remove-image"
                                                data-img="{{ $adv->id }}" data-src="ua">-</button>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                {{ Form::label('image', 'картинка') }}
                                {!! Form::file('image', ['accept'=>'image/*', 'class'=>'form-control']) !!}
                            </div>
                            <div class="col-lg-6">
                                {{ Form::label('uimage', 'UA-картинка') }}
                                {!! Form::file('uimage', ['accept'=>'image/*', 'class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                {{ Form::label('imgalt', 'Параметры картинки') }}
                                <div class="">
                                    <div class="col-lg-6">
                                        {!! Form::text('imgalt', $adv->img_alt ?? '',
                                                        ['placeholder'=>'Alt', 'id'=>'imgalt', 'class'=>'form-control']) !!}
                                    </div>
                                    <div class="col-lg-6">
                                        {!! Form::text('imgtitle', $adv->img_title ?? '',
                                                        ['placeholder'=>'Title', 'id'=>'imgtitle', 'class'=>'form-control']) !!}
                                    </div>
                                    <hr>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                {{ Form::label('uimgalt', 'Параметры картинки') }}
                                <div class="">
                                    <div class="col-lg-6">
                                        {!! Form::text('uimgalt', $adv->uimg_alt ?? '',
                                                        ['placeholder'=>'Alt', 'id'=>'uimgalt', 'class'=>'form-control']) !!}
                                    </div>
                                    <div class="col-lg-6">
                                        {!! Form::text('uimgtitle', $adv->uimg_title ?? '',
                                                        ['placeholder'=>'Title', 'id'=>'uimgtitle', 'class'=>'form-control']) !!}
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-6">
                                {{ Form::label('text', 'RU-текст') }}
                                {{ Form::textarea('text', $adv->text ?? '', ['placeholder'=>'RU-Text', 'class'=>'form-control editor']) }}
                            </div>
                            <div class="col-lg-6">
                                {{ Form::label('utext', 'UA-текст') }}
                                {{ Form::textarea('utext', $adv->utext ?? '', ['placeholder'=>'UA-Text', 'class'=>'form-control editor']) }}
                            </div>
                        </div>
                        <hr>
                        <div class="">
                            <label>
                                <input type="checkbox"
                                       {{ old('confirmed') ? 'checked' : ($adv->approved ? 'checked' : '')}} value="1"
                                       name="confirmed">
                                Опубликовать
                            </label>
                        </div>

                        <span class="remove-this pull-right"><button type="button"
                                                                     class="btn btn-danger">-</button></span>
                        {!! Form::button('Сохранить', ['class' => 'btn btn-primary','type'=>'submit']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
<hr>
<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapsenew">
                # Новый</a>
        </h4>
    </div>
    <div id="collapsenew" class="panel-collapse collapse">
        <div class="panel-body">

            {!! Form::open(['url' => route('adv_admin'), 'method' => 'post', 'class' => 'form-horizontal', 'files'=>true]) !!}
            <div class="row">
                <div class="col-lg-6">
                    {{ Form::label('title', 'RU-Заголовок') }}
                    <div>
                        {!! Form::text('title', old('title') ?? '',
                         ['placeholder'=>'Баннеры', 'class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="col-lg-6">
                    {{ Form::label('utitle', 'UA-Заголовок') }}
                    <div>
                        {!! Form::text('utitle', old('utitle') ?? '',
                         ['placeholder'=>'Баннеры', 'class'=>'form-control']) !!}
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-6">
                    {{ Form::label('image', 'картинка') }}
                    {!! Form::file('image', ['accept'=>'image/*', 'class'=>'form-control']) !!}
                </div>
                <div class="col-lg-6">
                    {{ Form::label('uimage', 'UA-картинка') }}
                    {!! Form::file('uimage', ['accept'=>'image/*', 'class'=>'form-control']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    {{ Form::label('imgalt', 'Параметры картинки') }}
                    <div class="">
                        <div class="col-lg-6">
                            {!! Form::text('imgalt', old('imgalt') ?? '',
                                            ['placeholder'=>'Alt', 'id'=>'imgalt', 'class'=>'form-control']) !!}
                        </div>
                        <div class="col-lg-6">
                            {!! Form::text('imgtitle', old('imgtitle') ?? '',
                                            ['placeholder'=>'Title', 'id'=>'imgtitle', 'class'=>'form-control']) !!}
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="col-lg-6">
                    {{ Form::label('uimgalt', 'Параметры картинки') }}
                    <div class="">
                        <div class="col-lg-6">
                            {!! Form::text('uimgalt', old('uimgalt') ?? '',
                                            ['placeholder'=>'Alt', 'id'=>'uimgalt', 'class'=>'form-control']) !!}
                        </div>
                        <div class="col-lg-6">
                            {!! Form::text('uimgtitle', old('uimgtitle') ?? '',
                                            ['placeholder'=>'Title', 'id'=>'uimgtitle', 'class'=>'form-control']) !!}
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-6">
                    {{ Form::label('uimgalt', 'RU-текст') }}
                    {{ Form::textarea('text', old('text') ?? '', ['placeholder'=>'RU-Text', 'class'=>'form-control editor']) }}
                </div>
                <div class="col-lg-6">
                    {{ Form::label('uimgalt', 'UA-текст') }}
                    {{ Form::textarea('utext', old('utext') ?? '', ['placeholder'=>'UA-Text', 'class'=>'form-control editor']) }}
                </div>
            </div>
            <hr>
            <div class="">
                <label>
                    <input type="checkbox" {{ old('confirmed') ? 'checked' : ''}} value="1" name="confirmed">
                    Опубликовать
                </label>
            </div>
            {!! Form::button('Сохранить', ['class' => 'btn btn-primary','type'=>'submit']) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>