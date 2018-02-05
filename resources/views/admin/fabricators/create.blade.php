<h2>{{ $title }}</h2>
{!! Form::open(['url'=>route('fabricator_create'), 'method'=>'post', 'class'=>'form-horizontal']) !!}
<div>
    {{ Form::label('title', 'Название') }}
    <div>
        {!! Form::text('title', (old('title') ?? ''),
            ['placeholder' => 'Название организации', 'id'=>'title', 'class'=>'form-control ru-title']) !!}
    </div>
</div>
<div>
    {{ Form::label('utitle', 'UA-Название') }}
    <div>
        {!! Form::text('utitle', (old('utitle') ?? ''),
            ['placeholder' => 'UA-название организации', 'id'=>'utitle', 'class'=>'form-control']) !!}
    </div>
</div>
<div>
    {{ Form::label('alias', 'URL') }}
    <div>
        {!! Form::text('alias', (old('alias') ?? ''),
            ['placeholder' => 'URL', 'id'=>'alias', 'class'=>'form-control eng-alias']) !!}
    </div>
</div>
<hr>
{!! Form::button('Создать', ['class' => 'btn btn-primary','type'=>'submit']) !!}
{!! Form::close() !!}