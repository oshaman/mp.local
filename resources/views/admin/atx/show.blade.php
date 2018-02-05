<h1>Добавление \ Редактирование ATX</h1>

{!! Form::open(['url' => route('atx_admin'), 'class'=>'form-horizontal','method'=>'POST' ]) !!}
<div class="">
    {{ Form::label('atx', 'Наименование классификации') }}
    <div class="">
        {!! Form::text('atx', old('atx') ? : '' ,
                ['placeholder'=>'A01...', 'id'=>'atx', 'class'=>'form-control', 'required'=>'required']) !!}
    </div>
    <div class="">
        {!! Form::button('Искать', ['class' => 'btn btn-primary','type'=>'submit']) !!}
    </div>
    {!! Form::close() !!}
</div>


@if(!empty($class))
    <hr>
    <div class="alert alert-success row">
        <div class="col-lg-4">
            <h3>{{ $class->class }}</h3>
        </div>
        <div class="col-lg-4">
            {!! Form::open(['url' => route('atx_update',['atx'=> $class->id]),'class'=>'form-horizontal','method'=>'GET']) !!}
            {!! Form::button('Редактировать', ['class' => 'btn btn-warning','type'=>'submit']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endif