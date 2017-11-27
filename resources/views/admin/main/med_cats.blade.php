@include('admin.main.nav')
@if(!empty($cats))
    <div class="panel-group" id="accordion">
        @foreach($cats as $cat)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#{{ $loop->iteration }}">
                            Блок № {{ $loop->iteration }}:</a>
                    </h4>
                </div>
                <div id="{{ $loop->iteration }}" class="panel-collapse collapse">
                    <div class="panel-body">
                        {!! Form::open(['url'=>route('medicine_cats', $cat->id), 'method'=>'post', 'class' => 'form-horizontal']) !!}
                        <div class="form-group col-lg-6">
                            {!! Form::label('Заголовок RU') !!}
                            <input placeholder="Аллергия" id="title" name="title" type="text"
                                   value="{{ $cat->title or '' }}" class="form-control">
                        </div>
                        <div class="form-group col-lg-6">
                            {!! Form::label('Заголовок UA') !!}
                            <input placeholder="Аллергия" id="utitle" name="utitle" type="text"
                                   value="{{ $cat->utitle or '' }}" class="form-control">
                        </div>
                        <div class="form-group col-lg-4">
                            {!! Form::label('ЧПУ препарата №1') !!}
                            <input placeholder="meradazol" id="alias1" name="alias1" type="text"
                                   value="{{ $cat->alias1 or '' }}" class="form-control">
                        </div>
                        <div class="form-group col-lg-4">
                            {!! Form::label('ЧПУ препарата №2') !!}
                            <input placeholder="meradazol" id="alias2" name="alias2" type="text"
                                   value="{{ $cat->alias2 or '' }}" class="form-control">
                        </div>
                        <div class="form-group col-lg-4">
                            {!! Form::label('ЧПУ препарата №3') !!}
                            <input placeholder="meradazol" id="alias3" name="alias3" type="text"
                                   value="{{ $cat->alias3 or '' }}" class="form-control">
                        </div>

                        {!! Form::button('Сохранить', ['class' => 'btn btn-primary','type'=>'submit']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif