<h1>Редактирование действующего вещества</h1>
<h2>фармгруппа: {{ $substance->title ?? '' }}</h2>
<hr>
{!! Form::open(['url' => route('substance_update',['substance'=> $substance->id]), 'class'=>'form-horizontal','method'=>'POST' ]) !!}

<div class="">
    {{ Form::label('title', 'Название') }}
    <div>
        {!! Form::text('title', old('title') ? : ($substance->title ?? ''),
                        ['placeholder'=>'Средства, влияющие на...', 'id'=>'title', 'class'=>'form-control']) !!}
    </div>
</div>
<div class="">
    {{ Form::label('utitle', 'UA-Название') }}
    <div>
        {!! Form::text('utitle', old('utitle') ? : ($substance->utitle ?? ''),
                        ['placeholder'=>'farm', 'id'=>'utitle', 'class'=>'form-control']) !!}
    </div>
</div>
<hr>
<div class="">
    {!! Form::button('Сохранить', ['class' => 'btn btn-primary','type'=>'submit']) !!}
</div>
{!! Form::close() !!}