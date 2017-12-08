@include('admin.static.nav')
<div class="panel-group" id="accordion">
    @if(is_object($abouts) && $abouts->isNotEmpty())
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#ru">
                        # RU</a>
                </h4>
            </div>
            <div id="ru" class="panel-collapse collapse">
                <div class="panel-body">
                    @if('about_admin' == Route::CurrentRouteName())
                        {!! Form::open(['url' => route('about_admin'), 'method' => 'post', 'class' => 'form-horizontal', 'files' => true]) !!}
                    @elseif('convention_admin' == Route::CurrentRouteName())
                        {!! Form::open(['url' => route('convention_admin'), 'method' => 'post', 'class' => 'form-horizontal', 'files' => true]) !!}
                    @endif
                    <div>
                        {{ Form::label('title', 'Заголовок') }}
                        <div>
                            {!! Form::text('title', $abouts{0}->title ?? '',
                             ['placeholder'=>'О портале', 'class'=>'form-control']) !!}
                        </div>
                    </div>
                    <hr>
                    <div>
                        {{ Html::image(asset('/asset/images/about/ru').'/'.$abouts{0}->path, 'ru picture', array('class' => 'img-thumbnail')) }}
                    </div>
                    <div>
                        {{ Form::label('image', 'картинка') }}
                        {!! Form::file('image', ['accept'=>'image/*', 'class'=>'form-control']) !!}
                    </div>
                    <div>
                        {{ Form::label('alt', 'Параметры картинки') }}
                        <div class="">
                            <div class="col-lg-6">
                                {!! Form::text('alt', $abouts{0}->alt ?? '',
                                                ['placeholder'=>'Alt', 'id'=>'alt', 'class'=>'form-control']) !!}
                            </div>
                            <div class="col-lg-6">
                                {!! Form::text('imgtitle', $abouts{0}->img_title ?? '',
                                                ['placeholder'=>'Title', 'id'=>'imgtitle', 'class'=>'form-control']) !!}
                            </div>
                            <hr>
                        </div>
                    </div>
                    <hr>
                    <div>
                        {{ Form::label('text', 'Текст') }}
                        {{ Form::textarea('text', $abouts{0}->text ?? '', ['placeholder'=>'RU-Text', 'class'=>'form-control editor']) }}
                    </div>
                    {{ Form::hidden('loc', 'ru') }}
                    {!! Form::button('Сохранить', ['class' => 'btn btn-primary','type'=>'submit']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#ua">
                        # UA</a>
                </h4>
            </div>
            <div id="ua" class="panel-collapse collapse">
                <div class="panel-body">
                    @if('about_admin' == Route::CurrentRouteName())
                        {!! Form::open(['url' => route('about_admin'), 'method' => 'post', 'class' => 'form-horizontal', 'files' => true]) !!}
                    @elseif('convention_admin' == Route::CurrentRouteName())
                        {!! Form::open(['url' => route('convention_admin'), 'method' => 'post', 'class' => 'form-horizontal', 'files' => true]) !!}
                    @else
                        {!! Form::open(['url' => route('conditions_admin'), 'method' => 'post', 'class' => 'form-horizontal', 'files' => true]) !!}
                    @endif
                    <div>
                        {{ Form::label('title', 'Заголовок') }}
                        <div>
                            {!! Form::text('title', $abouts{1}->title ?? '',
                             ['placeholder'=>'О портале', 'class'=>'form-control']) !!}
                        </div>
                    </div>
                    <hr>
                    <div>
                        {{ Html::image(asset('/asset/images/about/ua').'/'.$abouts{1}->path, 'ru picture', array('class' => 'img-thumbnail')) }}
                    </div>
                    <div>
                        {{ Form::label('image', 'картинка') }}
                        {!! Form::file('image', ['accept'=>'image/*', 'class'=>'form-control']) !!}
                    </div>
                    <div>
                        {{ Form::label('alt', 'Параметры картинки') }}
                        <div class="">
                            <div class="col-lg-6">
                                {!! Form::text('alt', $abouts{1}->alt ?? '',
                                                ['placeholder'=>'Alt', 'id'=>'alt', 'class'=>'form-control']) !!}
                            </div>
                            <div class="col-lg-6">
                                {!! Form::text('imgtitle', $abouts{1}->img_title ?? '',
                                                ['placeholder'=>'Title', 'id'=>'imgtitle', 'class'=>'form-control']) !!}
                            </div>
                            <hr>
                        </div>
                    </div>
                    <hr>
                    <div>
                        {{ Form::label('text', 'Текст') }}
                        {{ Form::textarea('text', $abouts{1}->text ?? '', ['placeholder'=>'RU-Text', 'class'=>'form-control editor']) }}
                    </div>
                    {{ Form::hidden('loc', 'ua') }}
                    {!! Form::button('Сохранить', ['class' => 'btn btn-primary','type'=>'submit']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    @endif
</div>