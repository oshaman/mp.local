<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            @if('cats' == Route::currentRouteName())
                <li><a class="btn btn-default">Категории</a></li>
            @else
                <li><a href="{{ route('cats') }}">Категории</a></li>
            @endif
            @if('create_article' == Route::currentRouteName())
                <li><a class="btn btn-default">UA-инструкция</a></li>
            @else
                <li><a href="{{ route('create_article') }}">Создать статью</a></li>
            @endif
        </ul>
    </div>
</nav>
<h1>Редактирование категории</h1>

{!! Form::open(['url' => route('edit_cats', $category->id), 'class'=>'form-horizontal','method'=>'POST' ]) !!}
<div class="">
    {{ Form::label('title', 'Название категории') }}
    <div class="">
        {!! Form::text('title', old('title') ? : ($category->title ?? ''),
            ['placeholder'=>'Психиатр...', 'id'=>'title', 'class'=>'form-control ru-title']) !!}
    </div>
    {{ Form::label('utitle', 'UA-Название категории') }}
    <div class="">
        {!! Form::text('utitle', old('utitle') ? : ($category->utitle ?? ''),
           ['placeholder'=>'Психиатр...', 'id'=>'utitle', 'class'=>'form-control']) !!}
    </div>
    {{ Form::label('title', 'URL категории') }}
    <div class="">
        {!! Form::text('alias', old('alias') ? : ($category->alias ?? ''),
            ['placeholder'=>'psihiatr...', 'id'=>'alias', 'class'=>'form-control eng-alias']) !!}
    </div>
    <div class="">
        {!! Form::button('Сохранить', ['class' => 'btn btn-primary','type'=>'submit']) !!}
    </div>
    {!! Form::close() !!}
</div>