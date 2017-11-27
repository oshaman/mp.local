@include('admin.main.nav')
<div class="panel-group" id="accordion">
    @foreach($blocks as $block)
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-question">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $loop->iteration }}">
                        # {{ $block->title }}:</a>
                </h4>
            </div>
            <div id="collapse{{ $loop->iteration }}" class="panel-collapse collapse">
                <div class="panel-body">
                    {!! Form::open(['url'=>route('blocks', $block->id), 'method'=>'post', 'class'=>'form-horizontal']) !!}
                    <div class="row">
                        <div class="col-lg-6">
                            {{ Form::label('title', 'Заголовок') }}
                            <div>
                                {!! Form::text('title', $block->title ?? '',
                                 ['placeholder'=>'Популярные тэги', 'class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            {{ Form::label('utitle', 'UA-Заголовок') }}
                            <div>
                                {!! Form::text('utitle', $block->utitle ?? '',
                                 ['placeholder'=>'Популярные тэги', 'class'=>'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            {{ Form::label('first', 'Тэг-1') }}
                            <div>
                                {!! Form::text('first', $block->first ?? '',
                                 ['placeholder'=>'Морфин', 'class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            {{ Form::label('second', 'Тэг-2') }}
                            <div>
                                {!! Form::text('second', $block->second ?? '',
                                 ['placeholder'=>'Морфин', 'class'=>'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            {{ Form::label('third', 'Тэг-3') }}
                            <div>
                                {!! Form::text('third', $block->third ?? '',
                                 ['placeholder'=>'Морфин', 'class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            {{ Form::label('fourth', 'Тэг-4') }}
                            <div>
                                {!! Form::text('fourth', $block->fourth ?? '',
                                 ['placeholder'=>'Морфин', 'class'=>'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            {{ Form::label('fifth', 'Тэг-5') }}
                            <div>
                                {!! Form::text('fifth', $block->fifth ?? '',
                                 ['placeholder'=>'Морфин', 'class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            {{ Form::label('sixth', 'Тэг-6') }}
                            <div>
                                {!! Form::text('sixth', $block->sixth ?? '',
                                 ['placeholder'=>'Морфин', 'class'=>'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <hr>
                    {!! Form::button('Сохранить', ['class' => 'btn btn-large btn-primary','type'=>'submit']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    @endforeach
</div>
