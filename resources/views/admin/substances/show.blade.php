<h1>Редактирование Действующих веществ</h1>

<div class="">
    {!! Form::open(['route' => 'substance_admin', 'class'=>'form-horizontal','method'=>'get' ]) !!}
    <h3>Поиск Действующих веществ:</h3>
    <div class="">
        {{ Form::label('value', 'Параметр поиска') }}
        {!! Form::text('value', old('value') ? : '' , ['placeholder'=>'id, link...', 'id'=>'value', 'class'=>'form-control']) !!}
        {{ Form::label('param', 'Критерий поиска') }}
        {!! Form::select('param',
                    [
                        1=>'Заголовок',
                        2=>'URL',
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
            <th>Заголовок</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        @if (!empty($substances[0]))
            <tbody>
            @foreach ($substances as $substance)
                <tr>
                    <td>{{ $substance->title }}</td>
                    <td>
                        {!! Form::open(['url' => route('substance_seo_update', ['substance'=> $substance->id]),'class'=>'form-horizontal','method'=>'GET']) !!}
                        {!! Form::button('SEO', ['class' => 'btn btn-warning','type'=>'submit']) !!}
                        {!! Form::close() !!}
                    </td>
                    <td>
                        {!! Form::open(['url' => route('substance_update', ['substance'=> $substance->id]),'class'=>'form-horizontal','method'=>'GET']) !!}
                        {!! Form::button('Редактировать', ['class' => 'btn btn-warning','type'=>'submit']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
            <!--PAGINATION-->
            <div class="general-pagination group">
                @if(is_object($substances) && !empty($substances->lastPage()) && $substances->lastPage() > 1)
                    @if($substances->lastPage() > 1)
                        <ul class="pagination">
                            @if($substances->currentPage() !== 1)
                                <li>
                                    <a rel="prev" href="{{ $substances->url(($substances->currentPage() - 1)) }}"
                                       class="prev">
                                        <
                                    </a>
                                </li>
                            @endif
                            @if($substances->currentPage() >= 3)
                                <li><a href="{{ $substances->url($substances->url(1)) }}">1</a></li>
                            @endif
                            @if($substances->currentPage() >= 4)
                                <li><a href="#">...</a></li>
                            @endif
                            @if($substances->currentPage() !== 1)
                                <li>
                                    <a href="{{ $substances->url($substances->currentPage()-1) }}">{{ $substances->currentPage()-1 }}</a>
                                </li>
                            @endif
                            <li><a class="active disabled">{{ $substances->currentPage() }}</a></li>
                            @if($substances->currentPage() !== $substances->lastPage())
                                <li>
                                    <a href="{{ $substances->url($substances->currentPage()+1) }}">{{ $substances->currentPage()+1 }}</a>
                                </li>
                            @endif
                            @if($substances->currentPage() <= ($substances->lastPage()-3))
                                <li><a href="#">...</a></li>
                            @endif
                            @if($substances->currentPage() <= ($substances->lastPage()-2))
                                <li>
                                    <a href="{{ $substances->url($substances->lastPage()) }}">{{ $substances->lastPage() }}</a>
                                </li>
                            @endif
                            @if($substances->currentPage() !== $substances->lastPage())
                                <li>
                                    <a rel="next" href="{{ $substances->url(($substances->currentPage() + 1)) }}"
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