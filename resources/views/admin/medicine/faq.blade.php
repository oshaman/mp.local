<h2>Частые вопросы</h2>
{!! Form::open(['url' => route('faq', ['medicine'=>$drug->alias, 'spec'=>$spec]), 'method' => 'post', 'class' => 'form-horizontal']) !!}
@if($drug->questions->isNotEmpty())
    @foreach($drug->questions as $faq)
        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-question">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $loop->index }}">
                            #{{ $loop->index }}:</a>
                    </h4>
                </div>
                <div id="collapse{{ $loop->index }}" class="panel-collapse collapse">
                    <div class="panel-body">
                        {{ Form::label('question', 'Вопрос(не больше 255 символов)') }}
                        <div>
                            {!! Form::text('question[]', $faq->question ?? '',
                             ['placeholder'=>'aspirin', 'class'=>'form-control']) !!}
                        </div>
                        {{ Form::label('answer', 'Ответ') }}
                        <textarea name="answer[]" class="form-control editor">
                            {{ $faq->answer ?? '' }}
                        </textarea>
                    </div>
                </div>
            </div>
            <span class="remove-this"><button type="button" class="btn btn-danger">-</button></span>
        </div>
    @endforeach
@endif
<div class="panel-group" id="accordion">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-question">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapsenew">
                    #Новый(если не используется - удалить):</a>
            </h4>
        </div>
        <div id="collapsenew" class="panel-collapse collapse">
            <div class="panel-body">
                {{ Form::label('question', 'Вопрос(не больше 255 символов)') }}
                <div>
                    {!! Form::text('question[]', null,
                     ['placeholder'=>'aspirin', 'class'=>'form-control']) !!}
                </div>
                {{ Form::label('answer', 'Ответ') }}
                <textarea name="answer[]" class="form-control editor">
                        {{--{!! old('faq') ? : ($drug->packaging ?? '') !!}--}}
                    </textarea>
            </div>
        </div>
    </div>
    <span class="remove-this"><button type="button" class="btn btn-danger">-</button></span>
</div>
<hr>
{!! Form::button('Редактировать', ['class' => 'btn btn-primary','type'=>'submit']) !!}
{!! Form::close() !!}