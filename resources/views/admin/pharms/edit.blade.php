<h1>Редактирование фармгруппы:</h1>
<h2>{{ $pharm->title ?? '' }}</h2>
<hr>
{!! Form::open(['url' => route('pharm_update',['pharm'=> $pharm->id]), 'class'=>'form-horizontal','method'=>'POST' ]) !!}

<div class="">
    {{ Form::label('title', 'Название') }}
    <div>
        {!! Form::text('title', old('title') ? : ($pharm->title ?? ''),
                        ['placeholder'=>'Средства, влияющие на...', 'id'=>'title', 'class'=>'form-control']) !!}
    </div>
</div>
<div class="">
    {{ Form::label('utitle', 'UA-Название') }}
    <div>
        {!! Form::text('utitle', old('utitle') ? : ($pharm->utitle ?? ''),
                        ['placeholder'=>'farm', 'id'=>'utitle', 'class'=>'form-control']) !!}
    </div>
</div>
<hr>
<div class="">
    {!! Form::button('Сохранить', ['class' => 'btn btn-primary','type'=>'submit']) !!}
</div>
{!! Form::close() !!}