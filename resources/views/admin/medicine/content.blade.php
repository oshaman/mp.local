<!-- START CONTENT -->
<div class="">
    {!! Form::open(['url' => route('medicine_admin'), 'class'=>'form-horizontal','method'=>'GET' ]) !!}
    <h1>Поиск препаратов:</h1>
    <div class="">
        {{ Form::label('value', 'Параметр поиска') }}
        {!! Form::text('value', old('value') ? : '' , ['placeholder'=>'validol, валидол...', 'id'=>'value', 'class'=>'form-control']) !!}
        {{ Form::label('param', 'Критерий поиска') }}
        {!! Form::select('param',
                    [
                        1=>'ЧПУ',
                        2=>'Название',
                        3 =>'На паузе',
                    ], old('val') ? : 1, ['class'=>'form-control'])
            !!}
    </div>
    <hr>
    <div class="">
        {!! Form::button('Найти', ['class' => 'btn btn-primary','type'=>'submit']) !!}
    </div>
    {!! Form::close() !!}
</div>
<hr>
{{--<div class="">
    {!! Html::link(route('medicine_create'),'Создать препарат',['class' => 'btn btn-success']) !!}
</div>--}}
<div class="">
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>ЧПУ</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        @if((is_array($drugs) || is_object($drugs)) && !empty($drugs[0]))
            <tbody>
            @foreach ($drugs as $drug)
                <tr>
                    <td>{{ $drug->id }}</td>
                    <td>{{ $drug->title }}</td>
                    <td>{{ $drug->alias }}</td>
                    <td>
                        {!! Form::open(['url' => route('medicine_edit',['spec'=>'ru', 'medicine'=> $drug->alias]),'class'=>'form-horizontal','method'=>'GET']) !!}
                        {!! Form::button('Редактировать', ['class' => 'btn btn-warning','type'=>'submit']) !!}
                        {!! Form::close() !!}
                    </td>
                    <td>
                        {!! Form::open(['url' => route('medicine_delete',['drug'=> $drug->alias]),'class'=>'form-horizontal','method'=>'GET']) !!}
                        {!! Form::button('Удалить', ['class' => 'btn btn-danger','type'=>'submit']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        @endif
    </table>
    <!--PAGINATION-->

    <div class="general-pagination group">
        @if(is_object($drugs) && !empty($drugs->lastPage()) && $drugs->lastPage() > 1)
            @if($drugs->lastPage() > 1)
                <ul class="pagination">
                    @if($drugs->currentPage() !== 1)
                        <li>
                            <a rel="prev" href="{{ $drugs->url(($drugs->currentPage() - 1)) }}" class="prev">
                                <
                            </a>
                        </li>
                    @endif
                    @if($drugs->currentPage() >= 3)
                        <li><a href="{{ $drugs->url($drugs->url(1)) }}">1</a></li>
                    @endif
                    @if($drugs->currentPage() >= 4)
                        <li><a href="#">...</a></li>
                    @endif
                    @if($drugs->currentPage() !== 1)
                        <li>
                            <a href="{{ $drugs->url($drugs->currentPage()-1) }}">{{ $drugs->currentPage()-1 }}</a>
                        </li>
                    @endif
                    <li><a class="active disabled">{{ $drugs->currentPage() }}</a></li>
                    @if($drugs->currentPage() !== $drugs->lastPage())
                        <li>
                            <a href="{{ $drugs->url($drugs->currentPage()+1) }}">{{ $drugs->currentPage()+1 }}</a>
                        </li>
                    @endif
                    @if($drugs->currentPage() <= ($drugs->lastPage()-3))
                        <li><a href="#">...</a></li>
                    @endif
                    @if($drugs->currentPage() <= ($drugs->lastPage()-2))
                        <li><a href="{{ $drugs->url($drugs->lastPage()) }}">{{ $drugs->lastPage() }}</a>
                        </li>
                    @endif
                    @if($drugs->currentPage() !== $drugs->lastPage())
                        <li>
                            <a rel="next" href="{{ $drugs->url(($drugs->currentPage() + 1)) }}" class="next">
                                >
                            </a>
                        </li>
                    @endif
                </ul>
            @endif
        @endif


    </div>
</div>
<!-- END CONTENT -->