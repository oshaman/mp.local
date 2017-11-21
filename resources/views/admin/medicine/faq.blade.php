<h2>Частые вопросы</h2>
<div class="panel-group block-to-add" id="accordion">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                    #1:</a>
            </h4>
        </div>
        <div id="collapse1" class="panel-collapse collapse">
            <div class="panel-body">
                {{ Form::label('title', 'Вопрос') }}
                <div>
                    {!! Form::text('title', old('title') ? : ($faq->title ?? '') ,
                     ['placeholder'=>'aspirin', 'class'=>'form-control']) !!}
                </div>
                {{ Form::label('text', 'Ответ') }}
                <textarea name="text" class="form-control editor">
                        {{--{!! old('faq') ? : ($drug->packaging ?? '') !!}--}}
                    </textarea>
            </div>
        </div>
    </div>
</div>
<div class="add-new">
    <button type="button" class="btn btn-primary">+</button>
</div>
<div class="shablon panel-item" style="display:none">
    <div>
        <hr>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="panel-open" data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                        #Новый:</a>
                </h4>
            </div>
            <div id="collapse1" class="panel-collapse collapse">
                <div class="panel-body">
                    {{ Form::label('title', 'Вопрос') }}
                    <div>
                        {!! Form::text('title', null,
                         ['placeholder'=>'aspirin', 'class'=>'form-control']) !!}
                    </div>
                    {{ Form::label('text', 'Ответ') }}
                    <textarea name="text" class="form-control editor">
                        {{--{!! old('faq') ? : ($drug->packaging ?? '') !!}--}}
                    </textarea>
                </div>
            </div>
        </div>
        <span class="remove-this"><button type="button" class="btn btn-danger">-</button></span>
    </div>
</div>