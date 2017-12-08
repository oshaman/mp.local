@include('admin.statistic.navigation')
<h1>{{ $title }}</h1>
@if(!empty($res->alias))
    <h2>{{ $res->alias .' - '. $res->nums . ' просмотра(ов)'}}</h2>
@endif

@if('stats_medicine' == Route::currentRouteName())
    {!! Form::open(['url' => route('stats_medicine'), 'method' => 'post', 'class' => 'form-horizontal']) !!}
@else
    {!! Form::open(['url' => route('stats_class'), 'method' => 'post', 'class' => 'form-horizontal']) !!}
@endif
<div class="row">
    <div class="col-lg-6">
        {{ Form::label('alias', 'URL') }}
        <div>
            {!! Form::text('alias', null, ['placeholder'=>'aspirin', 'class'=>'form-control']) !!}
        </div>
    </div>
    {{ Form::label('period', 'Период') }}
    <div class="col-lg-6">
        <div>
            {!! Form::select('period', [
                                                1=>'Месяц',
                                                2=>'Квартал',
                                                3=>'Полугодие',
                                                4=>'Год',
                                             ], null,
             [ 'class'=>'form-control', 'placeholder'=>'Неделя'])
            !!}
        </div>
    </div>
</div>
<hr>
{!! Form::button('Поиск', ['class' => 'btn btn-primary btn-block ','type'=>'submit']) !!}
{{ Form::close() }}