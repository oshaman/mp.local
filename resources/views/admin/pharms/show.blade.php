<h1>Редактирование Фармгрупп</h1>

<div class="">
    {!! Form::open(['url' => route('pharm_admin'), 'class'=>'form-horizontal','method'=>'get' ]) !!}
    <h3>Поиск Фармгрупп:</h3>
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
        @if (!empty($pharms[0]))
            <tbody>
            @foreach ($pharms as $pharm)
                <tr>
                    <td>{{ $pharm->title }}</td>
                    <td align="right" class="buttons">
                        {!! Form::open(['url' => route('pharm_seo_update', ['pharm'=> $pharm->id]),'class'=>'form-horizontal','method'=>'GET']) !!}
                        {!! Form::button('SEO', ['class' => 'btn btn-warning','type'=>'submit']) !!}
                        {!! Form::close() !!}
                    </td>
                    <td align="right" class="buttons">
                        {!! Form::open(['url' => route('pharm_update', ['pharm'=> $pharm->id]),'class'=>'form-horizontal','method'=>'GET']) !!}
                        {!! Form::button('Редактировать', ['class' => 'btn btn-warning','type'=>'submit']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
            <!--PAGINATION-->
            <div class="general-pagination group">
                @if(is_object($pharms) && !empty($pharms->lastPage()) && $pharms->lastPage() > 1)
                    @if($pharms->lastPage() > 1)
                        <ul class="pagination">
                            @if($pharms->currentPage() !== 1)
                                <li>
                                    <a rel="prev" href="{{ $pharms->url(($pharms->currentPage() - 1)) }}"
                                       class="prev">
                                        <
                                    </a>
                                </li>
                            @endif
                            @if($pharms->currentPage() >= 3)
                                <li><a href="{{ $pharms->url($pharms->url(1)) }}">1</a></li>
                            @endif
                            @if($pharms->currentPage() >= 4)
                                <li><a href="#">...</a></li>
                            @endif
                            @if($pharms->currentPage() !== 1)
                                <li>
                                    <a href="{{ $pharms->url($pharms->currentPage()-1) }}">{{ $pharms->currentPage()-1 }}</a>
                                </li>
                            @endif
                                <li class="active"><a class="active disabled">{{ $pharms->currentPage() }}</a></li>
                            @if($pharms->currentPage() !== $pharms->lastPage())
                                <li>
                                    <a href="{{ $pharms->url($pharms->currentPage()+1) }}">{{ $pharms->currentPage()+1 }}</a>
                                </li>
                            @endif
                                @if($pharms->currentPage()+1 < $pharms->lastPage())
                                    <li>
                                        <a href="{{ $pharms->url($pharms->currentPage()+2) }}">{{ $pharms->currentPage()+2 }}</a>
                                    </li>
                                @endif
                                @if($pharms->currentPage()+2 < $pharms->lastPage())
                                    <li>
                                        <a href="{{ $pharms->url($pharms->currentPage()+3) }}">{{ $pharms->currentPage()+3 }}</a>
                                    </li>
                                @endif
                                @if($pharms->currentPage()+3 < $pharms->lastPage())
                                    <li>
                                        <a href="{{ $pharms->url($pharms->currentPage()+4) }}">{{ $pharms->currentPage()+4 }}</a>
                                    </li>
                                @endif
                                @if($pharms->currentPage() < ($pharms->lastPage()-5))
                                <li><a href="#">...</a></li>
                            @endif
                                @if($pharms->currentPage() < ($pharms->lastPage()-4))
                                <li>
                                    <a href="{{ $pharms->url($pharms->lastPage()) }}">{{ $pharms->lastPage() }}</a>
                                </li>
                            @endif
                            @if($pharms->currentPage() !== $pharms->lastPage())
                                <li>
                                    <a rel="next" href="{{ $pharms->url(($pharms->currentPage() + 1)) }}"
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