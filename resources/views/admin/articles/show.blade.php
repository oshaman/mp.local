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
<!-- START CONTENT -->
<div class="">
    {!! Form::open(['url' => route('articles_admin'), 'class'=>'form-horizontal','method'=>'GET' ]) !!}
    <h3>Поиск статьи:</h3>
    <div class="">
        {{ Form::label('value', 'Параметр поиска') }}
        {!! Form::text('value', old('value') ? : '' , ['placeholder'=>'id, link...', 'id'=>'value', 'class'=>'form-control']) !!}
        {{ Form::label('param', 'Критерий поиска') }}
        {!! Form::select('param',
                    [
                        1=>'Псевдоним статьи',
                        2=>'Заголовок',
                        3 =>'На паузе',
                    ], old('val') ? : 1, ['class'=>'form-control'])
            !!}
    </div>
    <hr>
    <div class="">
        {!! Form::button('Поиск', ['class' => 'btn btn-primary','type'=>'submit']) !!}
    </div>
    {!! Form::close() !!}
</div>
<hr>

<div class="">
    <table class="table">
        <thead>
        <tr>
            <th>Ссылка</th>
            <th>Заголовок</th>
            <th>Дата публикации</th>
        </tr>
        </thead>
        @if (!empty($articles[0]))
            <tbody>
            @foreach ($articles as $article)
                <tr>
                    <td>{{ $article->alias }}</td>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->created_at }}</td>
                    <td>
                        {!! Form::open(['url' => route('edit_article',['article'=> $article->id]),'class'=>'form-horizontal','method'=>'GET']) !!}
                        {!! Form::button(trans('admin.edit_btn'), ['class' => 'btn btn-warning','type'=>'submit']) !!}
                        {!! Form::close() !!}
                    </td>
                    <td>
                        {!! Form::open(['url' => route('delete_article',['article'=> $article->id]),'class'=>'form-horizontal','method'=>'GET']) !!}
                        {!! Form::button(trans('admin.delete'), ['class' => 'btn btn-danger','type'=>'submit']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
            <!--PAGINATION-->
            <div class="general-pagination group">
                @if(is_object($articles) && !empty($articles->lastPage()) && $articles->lastPage() > 1)
                    @if($articles->lastPage() > 1)
                        <ul class="pagination">
                            @if($articles->currentPage() !== 1)
                                <li>
                                    <a rel="prev" href="{{ $articles->url(($articles->currentPage() - 1)) }}"
                                       class="prev">
                                        <
                                    </a>
                                </li>
                            @endif
                            @if($articles->currentPage() >= 3)
                                <li><a href="{{ $articles->url($articles->url(1)) }}">1</a></li>
                            @endif
                            @if($articles->currentPage() >= 4)
                                <li><a href="#">...</a></li>
                            @endif
                            @if($articles->currentPage() !== 1)
                                <li>
                                    <a href="{{ $articles->url($articles->currentPage()-1) }}">{{ $articles->currentPage()-1 }}</a>
                                </li>
                            @endif
                            <li><a class="active disabled">{{ $articles->currentPage() }}</a></li>
                            @if($articles->currentPage() !== $articles->lastPage())
                                <li>
                                    <a href="{{ $articles->url($articles->currentPage()+1) }}">{{ $articles->currentPage()+1 }}</a>
                                </li>
                            @endif
                            @if($articles->currentPage() <= ($articles->lastPage()-3))
                                <li><a href="#">...</a></li>
                            @endif
                            @if($articles->currentPage() <= ($articles->lastPage()-2))
                                <li>
                                    <a href="{{ $articles->url($articles->lastPage()) }}">{{ $articles->lastPage() }}</a>
                                </li>
                            @endif
                            @if($articles->currentPage() !== $articles->lastPage())
                                <li>
                                    <a rel="next" href="{{ $articles->url(($articles->currentPage() + 1)) }}"
                                       class="next">
                                        >
                                    </a>
                                </li>
                            @endif
                        </ul>
                    @endif
                @endif


            </div>
        @endif
    </table>
</div>
<!-- END CONTENT -->