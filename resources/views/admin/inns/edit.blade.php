<h1>Редактирование международного названия:</h1>
<h2>{{ $inn->title ?? '' }}</h2>
<hr>
{!! Form::open(['url' => route('inn_update',['inn'=> $inn->id]), 'class'=>'form-horizontal','method'=>'POST' ]) !!}

<div class="">
    {{ Form::label('title', 'Название') }}
    <div>
        {!! Form::text('title', old('title') ? : ($inn->title ?? ''),
                        ['placeholder'=>'Средства, влияющие на...', 'id'=>'title', 'class'=>'form-control']) !!}
    </div>
</div>
<div class="">
    {{ Form::label('name', 'RU-Название') }}
    <div>
        {!! Form::text('name', old('name') ? : ($inn->name ?? ''),
                        ['placeholder'=>'farm', 'id'=>'name', 'class'=>'form-control']) !!}
    </div>
</div>
<div class="">
    {{ Form::label('uname', 'UA-Название') }}
    <div>
        {!! Form::text('uname', old('uname') ? : ($inn->uname ?? ''),
                        ['placeholder'=>'farm', 'id'=>'uname', 'class'=>'form-control']) !!}
    </div>
</div>
<hr>
<div class="">
    {!! Form::button('Сохранить', ['class' => 'btn btn-primary','type'=>'submit']) !!}
</div>
{!! Form::close() !!}