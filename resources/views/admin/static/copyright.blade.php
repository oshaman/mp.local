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
                    {!! Form::open(['url' => route('footer_copyright_admin'),
                                'method' => 'post', 'class' => 'form-horizontal']) !!}
                    <div>
                        {{ Form::label('text', 'Текст') }}
                        {{ Form::textarea('text', $abouts{0}->text ?? '',
                                ['placeholder'=>'RU-Text', 'class'=>'form-control editor']) }}
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
                    {!! Form::open(['url' => route('footer_copyright_admin'),
                                'method' => 'post', 'class' => 'form-horizontal']) !!}
                    <div>
                        {{ Form::label('text', 'Текст') }}
                        {{ Form::textarea('text', $abouts{1}->text ?? '',
                                ['placeholder'=>'RU-Text', 'class'=>'form-control editor']) }}
                    </div>
                    {{ Form::hidden('loc', 'ua') }}
                    {!! Form::button('Сохранить', ['class' => 'btn btn-primary','type'=>'submit']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    @endif
</div>