@include('admin.articles.nav')
<h1>Добавление \ Редактирование категорий</h1>

{!! Form::open(['url' => route('cats'), 'class'=>'form-horizontal','method'=>'POST' ]) !!}
<div class="">
    {{ Form::label('title', 'Название категории') }}
    <div class="">
        {!! Form::text('title', old('title') ? : '' , ['placeholder'=>'Психиатрия...', 'id'=>'title', 'class'=>'form-control ru-title']) !!}
    </div>
    {{ Form::label('utitle', 'UA-название') }}
    <div class="">
        {!! Form::text('utitle', old('utitle') ? : '' , ['placeholder'=>'Психиатрия...', 'id'=>'utitle', 'class'=>'form-control']) !!}
    </div>
    {{ Form::label('alias', 'URL') }}
    <div class="">
        {!! Form::text('alias', old('alias') ? : '' , ['placeholder'=>'psihiatriya...', 'id'=>'alias', 'class'=>'form-control eng-alias']) !!}
    </div>
    <div class="">
        {!! Form::button('Добавить', ['class' => 'btn btn-primary','type'=>'submit']) !!}
    </div>
    {!! Form::close() !!}
</div>
@if(!empty($categories))
    <table class="table">
        <thead>
        <tr>
            <th>Имя</th>
            <th>UA-Имя</th>
            <th>URL</th>
            <th>Редактировать</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->title }}</td>
                <td>{{ $category->utitle }}</td>
                <td>{{ $category->alias }}</td>
                <td>
                    {!! Form::open(['url' => route('edit_cats',['cat'=> $category->id]),'class'=>'form-horizontal','method'=>'GET']) !!}
                    {!! Form::button('Редактировать', ['class' => 'btn btn-warning','type'=>'submit']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!--PAGINATION-->

    <div class="general-pagination group">

        @if($categories->lastPage() > 1)
            <ul class="pagination">
                @if($categories->currentPage() !== 1)
                    <li>
                        <a href="{{ $categories->url(($categories->currentPage() - 1)) }}">{{ Lang::get('pagination.previous') }}</a>
                    </li>
                @endif

                @for($i = 1; $i <= $categories->lastPage(); $i++)
                    @if($categories->currentPage() == $i)
                        <li><a class="selected disabled">{{ $i }}</a></li>
                    @else
                        <li><a href="{{ $categories->url($i) }}">{{ $i }}</a></li>
                    @endif
                @endfor

                @if($categories->currentPage() !== $categories->lastPage())
                    <li>
                        <a href="{{ $categories->url(($categories->currentPage() + 1)) }}">{{ Lang::get('pagination.next') }}</a>
                    </li>
                @endif
            </ul>

        @endif

    </div>
@endif