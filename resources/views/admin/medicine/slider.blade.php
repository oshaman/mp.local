@if(!empty($drug) && $drug->image->isNotEmpty())
    @foreach($drug->image as $pic)
        <div class="thumbnail" data-id="{{ $pic->id }}" data-spec="{{ $spec }}">
            @switch($spec)
                @case('ru')
                {{ Html::image(asset('/asset/images/medicine/main').'/'.$pic->path, 'a picture', array('class' => 'img-thumbnail')) }}
                @break

                @case('ua')
                {{ Html::image(asset('/asset/images/medicine/main_ukr').'/'.$pic->path, 'a picture', array('class' => 'img-thumbnail')) }}
                @break

                @case('aua')
                {{ Html::image(asset('/asset/images/medicine/main_ukr').'/'.$pic->path, 'a picture', array('class' => 'img-thumbnail')) }}
                @break

                @case('aru')
                {{ Html::image(asset('/asset/images/medicine/main_ukr').'/'.$pic->path, 'a picture', array('class' => 'img-thumbnail')) }}
                @break

                @default
                {{ Html::image(asset('/asset/images/medicine/main_ukr').'/'.$pic->path, 'a picture', array('class' => 'img-thumbnail')) }}
            @endswitch
            <span class="remove-slider"><button type="button" class="btn btn-danger">-</button></span>
        </div>
    @endforeach
@endif
<div id="msg"></div>
{{ Form::label('slider', 'Фото для слайдера') }}
<div class="">
    <div class="block-to-add">
        <div>
            {!! Form::file('slider[]', ['accept'=>'image/*', 'class'=>'form-control']) !!}
            <span class="remove-this"><button type="button" class="btn btn-danger">-</button></span>
            <br>
            {{ Form::label('imgalt', 'Параметры картинки') }}
            <div class="">
                <div class="col-lg-6">
                    {!! Form::text('imgalt[]', null,
                                    ['placeholder'=>'Alt', 'id'=>'imgalt', 'class'=>'form-control']) !!}
                </div>
                <div class="col-lg-6">
                    {!! Form::text('imgtitle[]', null,
                                    ['placeholder'=>'Title', 'id'=>'imgtitle', 'class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <hr>
    </div>
    <div class="add-new">
        <button type="button" class="btn btn-primary">+</button>
    </div>
</div>