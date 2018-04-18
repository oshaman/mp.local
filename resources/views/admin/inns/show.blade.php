<h1>Редактирование международных названий</h1>

<div class="">
    {!! Form::open(['route' => 'inn_admin', 'class'=>'form-horizontal','method'=>'get' ]) !!}
    <h3>Поиск международных названий:</h3>
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
            <th></th>
        </tr>
        </thead>
        @if (!empty($inns[0]))
            <tbody>
            @foreach ($inns as $inn)
                <tr>
                    <td>{{ $inn->title }}</td>
                    <td>{{ $inn->name }}</td>
                    <td align="right" class="buttons">
                        {!! Form::open(['url' => route('inn_seo_update', ['inn'=> $inn->id]),'class'=>'form-horizontal','method'=>'GET']) !!}
                        {!! Form::button('SEO', ['class' => 'btn btn-warning','type'=>'submit']) !!}
                        {!! Form::close() !!}
                    </td>
                    <td align="right" class="buttons">
                        {!! Form::open(['url' => route('inn_update', ['inn'=> $inn->id]),'class'=>'form-horizontal','method'=>'GET']) !!}
                        {!! Form::button('Редактировать', ['class' => 'btn btn-warning','type'=>'submit']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
            <!--PAGINATION-->
            <div class="general-pagination group">
                @if(is_object($inns) && !empty($inns->lastPage()) && $inns->lastPage() > 1)
                    @if($inns->lastPage() > 1)
                        <ul class="pagination">
                            @if($inns->currentPage() !== 1)
                                <li>
                                    <a rel="prev" href="{{ $inns->url(($inns->currentPage() - 1)) }}"
                                       class="prev">
                                        <
                                    </a>
                                </li>
                            @endif
                            @if($inns->currentPage() >= 3)
                                <li><a href="{{ $inns->url($inns->url(1)) }}">1</a></li>
                            @endif
                            @if($inns->currentPage() >= 4)
                                <li><a href="#">...</a></li>
                            @endif
                            @if($inns->currentPage() !== 1)
                                <li>
                                    <a href="{{ $inns->url($inns->currentPage()-1) }}">{{ $inns->currentPage()-1 }}</a>
                                </li>
                            @endif
                                <li class="active"><a class="active disabled">{{ $inns->currentPage() }}</a></li>
                            @if($inns->currentPage() !== $inns->lastPage())
                                <li>
                                    <a href="{{ $inns->url($inns->currentPage()+1) }}">{{ $inns->currentPage()+1 }}</a>
                                </li>
                            @endif
                                @if($inns->currentPage()+1 < $inns->lastPage())
                                    <li>
                                        <a href="{{ $inns->url($inns->currentPage()+2) }}">{{ $inns->currentPage()+2 }}</a>
                                    </li>
                                @endif
                                @if($inns->currentPage()+2 < $inns->lastPage())
                                    <li>
                                        <a href="{{ $inns->url($inns->currentPage()+3) }}">{{ $inns->currentPage()+3 }}</a>
                                    </li>
                                @endif
                                @if($inns->currentPage()+3 < $inns->lastPage())
                                    <li>
                                        <a href="{{ $inns->url($inns->currentPage()+4) }}">{{ $inns->currentPage()+4 }}</a>
                                    </li>
                                @endif
                                @if($inns->currentPage() < ($inns->lastPage()-5))
                                <li><a href="#">...</a></li>
                            @endif
                                @if($inns->currentPage() < ($inns->lastPage()-4))
                                <li>
                                    <a href="{{ $inns->url($inns->lastPage()) }}">{{ $inns->lastPage() }}</a>
                                </li>
                            @endif
                            @if($inns->currentPage() !== $inns->lastPage())
                                <li>
                                    <a rel="next" href="{{ $inns->url(($inns->currentPage() + 1)) }}"
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