<h1>Редактирование производителей</h1>
<h2>производитель: {{ $fabricator->title ?? '' }}</h2>
<hr>
{!! Form::open(['url' => route('fabricator_update',['fabricator'=> $fabricator->id]), 'class'=>'form-horizontal','method'=>'POST' ]) !!}

<div class="">
    {{ Form::label('title', 'Название') }}
    <div>
        {!! Form::text('title', old('title') ? : ($fabricator->title ?? ''),
                        ['placeholder'=>'Средства, влияющие на...', 'id'=>'title', 'class'=>'form-control']) !!}
    </div>
</div>
<div class="">
    {{ Form::label('utitle', 'UA-Название') }}
    <div>
        {!! Form::text('utitle', old('utitle') ? : ($fabricator->utitle ?? ''),
                        ['placeholder'=>'farm', 'id'=>'utitle', 'class'=>'form-control']) !!}
    </div>
</div>
<hr>
<div class="">
    {!! Form::button('Сохранить', ['class' => 'btn btn-primary','type'=>'submit']) !!}
</div>
{!! Form::close() !!}