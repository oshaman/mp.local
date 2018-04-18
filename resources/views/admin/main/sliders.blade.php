@include('admin.main.nav')
@if(!empty($sliders))
    <div class="panel-group" id="accordion">
        @foreach($sliders as $slider)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-question">
                        <a data-toggle="collapse"
                           data-parent="#accordion" href="#collapse{{ $loop->iteration }}">
                            # @if('ua' == $slider->loc) UA-вариант - @endif {{ $slider->description }}:</a>
                    </h4>
                </div>
                <div id="collapse{{ $loop->iteration }}" class="panel-collapse collapse">
                    <div class="panel-body">
                        {!! Form::open(['url'=>route('main_slider', $slider->id), 'method'=>'post', 'class'=>'form-horizontal', 'files'=>true]) !!}
                        <div class="">
                            {{ Form::label('description', 'Заголовок') }}
                            <div>
                                {!! Form::text('description', $slider->description ?? '',
                                 ['placeholder'=>'Заголовок', 'class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="">
                            {{ Form::label('text', 'Текст (160 символов)') }}
                            <div>
                                {!! Form::text('text', $slider->text ?? '',
                                 ['placeholder'=>'Текст', 'class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="">
                            {{ Form::label('link', 'Ссылка') }}
                            <div>
                                {!! Form::text('link', $slider->link ?? '',
                                 ['placeholder'=>'Ссылка', 'class'=>'form-control']) !!}
                            </div>
                        </div>
                        {{--Image--}}
                        <div class="">
                            {{ Form::label('img', 'Основное изображение') }}
                            @if(!empty($slider->path))
                                <div>
                                    {{ Html::image(asset('/asset/images/slider/').'/'.$slider->path, 'a picture', array('class' => 'thumb')) }}
                                </div>
                            @endif
                            {{ Form::label('img', 'Параметры картинки') }}
                            <div class="">
                                <div class="col-lg-6">
                                    {!! Form::text('alt', $slider->alt ?? '',
                                        ['placeholder'=>'Alt', 'id'=>'alt', 'class'=>'form-control']) !!}
                                </div>
                                <div class="col-lg-6">
                                    {!! Form::text('title', $slider->title ?? '',
                                        ['placeholder'=>'Title', 'id'=>'title', 'class'=>'form-control']) !!}
                                </div>
                            </div>
                            <div>
                                {!! Form::file('img', ['accept'=>'image/*', 'id'=>'img', 'class'=>'form-control']) !!}
                            </div>
                        </div>
                        {{--Image--}}
                        <div class="">
                            <label>
                                <input type="checkbox"
                                       {{ !empty($slider->approved) ? 'checked' : '' }} value="1"
                                       name="approved"> Опубликовать</label>
                        </div>
                        <hr>
                        {!! Form::button('Сохранить', ['class' => 'btn btn-large btn-primary','type'=>'submit']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            @if(0 == $loop->iteration%2)
                <hr> @endif
        @endforeach
    </div>
@endif