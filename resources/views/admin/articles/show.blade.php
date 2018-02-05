@include('admin.articles.nav')
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
                        1=>'Заголовок',
                        2=>'URL статьи',
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
<div class="">
    <table class="table">
        <thead>
        <tr>
            <th>Приоритет</th>
            <th>Дата публикации</th>
            <th>Заголовок</th>
            <th>Категория</th>
            <th>Ссылка</th>
            <th>Статус</th>
        </tr>
        </thead>
        @if (!empty($articles[0]))
            <tbody>
            @foreach ($articles as $article)
                <tr>
                    <td>{{ $article->priority }}</td>
                    <td>{{ $article->created_at }}</td>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->category->title }}</td>
                    <td>{{ $article->alias }}</td>
                    <td>{{ $article->approved ? '+' : ''}}</td>
                    <td>
                        {!! Form::open(['url' => route('edit_article',['spec' => 'ru','article'=> $article->id]),'class'=>'form-horizontal','method'=>'GET']) !!}
                        {!! Form::button('Редактировать', ['class' => 'btn btn-warning','type'=>'submit']) !!}
                        {!! Form::close() !!}
                    </td>
                    <td>
                        {!! Form::open(['url' => route('edit_article',['spec' => 'ua','article'=> $article->id]),'class'=>'form-horizontal','method'=>'GET']) !!}
                        {!! Form::button('Редактировать UA', ['class' => 'btn btn-warning','type'=>'submit']) !!}
                        {!! Form::close() !!}
                    </td>
                    @if(Auth::user()->hasRole('admin'))
                        <td>
                            {!! Form::open(['url' => route('delete_article',['article'=> $article->id]),'class'=>'form-horizontal','method'=>'GET']) !!}
                            {!! Form::button('Удалить', ['class' => 'btn btn-danger','type'=>'submit']) !!}
                            {!! Form::close() !!}
                        </td>
                    @endif
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