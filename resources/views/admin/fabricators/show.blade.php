<h1>Добавление \ Редактирование производителей</h1>

<div class="">
    {!! Form::open(['url' => route('fabricator_admin'), 'class'=>'form-horizontal','method'=>'get' ]) !!}
    <h3>Поиск производителей:</h3>
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
    <div class="bth-min-width">
        {!! Form::button('Поиск', ['class' => 'btn btn-primary','type'=>'submit']) !!}
        {!! Html::link(route('fabricator_create'),'Добавить производителя',['class' => 'btn btn-success']) !!}
    </div>
    {!! Form::close() !!}
</div>
<hr>
<div class="">
    <table class="table">
        <thead>
        <tr>
            <th>Заголовок</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        @if (!empty($fabricators[0]))
            <tbody>
            @foreach ($fabricators as $fabricator)
                <tr>
                    <td>{{ $fabricator->title }}</td>
                    <td align="right" class="buttons">
                        {!! Form::open(['url' => route('fabricator_seo_update', ['fabricator'=> $fabricator->id]),
                                                                    'class'=>'form-horizontal','method'=>'GET']) !!}
                        {!! Form::button('SEO', ['class' => 'btn btn-warning','type'=>'submit']) !!}
                        {!! Form::close() !!}
                    </td>
                    <td align="right" class="buttons">
                        {!! Form::open(['url' => route('fabricator_update', ['fabricator'=> $fabricator->id]),'class'=>'form-horizontal','method'=>'GET']) !!}
                        {!! Form::button('Редактировать', ['class' => 'btn btn-warning','type'=>'submit']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
            <!--PAGINATION-->
            <div class="general-pagination group">
                @if(is_object($fabricators) && !empty($fabricators->lastPage()) && $fabricators->lastPage() > 1)
                    @if($fabricators->lastPage() > 1)
                        <ul class="pagination">
                            @if($fabricators->currentPage() !== 1)
                                <li>
                                    <a rel="prev" href="{{ $fabricators->url(($fabricators->currentPage() - 1)) }}"
                                       class="prev">
                                        <
                                    </a>
                                </li>
                            @endif
                            @if($fabricators->currentPage() >= 3)
                                <li><a href="{{ $fabricators->url($fabricators->url(1)) }}">1</a></li>
                            @endif
                            @if($fabricators->currentPage() >= 4)
                                <li><a href="#">...</a></li>
                            @endif
                            @if($fabricators->currentPage() !== 1)
                                <li>
                                    <a href="{{ $fabricators->url($fabricators->currentPage()-1) }}">{{ $fabricators->currentPage()-1 }}</a>
                                </li>
                            @endif
                                <li class="active"><a class="active disabled">{{ $fabricators->currentPage() }}</a></li>
                            @if($fabricators->currentPage() !== $fabricators->lastPage())
                                <li>
                                    <a href="{{ $fabricators->url($fabricators->currentPage()+1) }}">{{ $fabricators->currentPage()+1 }}</a>
                                </li>
                            @endif
                                @if($fabricators->currentPage()+1 < $fabricators->lastPage())
                                    <li>
                                        <a href="{{ $fabricators->url($fabricators->currentPage()+2) }}">{{ $fabricators->currentPage()+2 }}</a>
                                    </li>
                                @endif
                                @if($fabricators->currentPage()+2 < $fabricators->lastPage())
                                    <li>
                                        <a href="{{ $fabricators->url($fabricators->currentPage()+3) }}">{{ $fabricators->currentPage()+3 }}</a>
                                    </li>
                                @endif
                                @if($fabricators->currentPage()+3 < $fabricators->lastPage())
                                    <li>
                                        <a href="{{ $fabricators->url($fabricators->currentPage()+4) }}">{{ $fabricators->currentPage()+4 }}</a>
                                    </li>
                                @endif
                                @if($fabricators->currentPage() < ($fabricators->lastPage()-5))
                                <li><a href="#">...</a></li>
                            @endif
                                @if($fabricators->currentPage() < ($fabricators->lastPage()-4))
                                <li>
                                    <a href="{{ $fabricators->url($fabricators->lastPage()) }}">{{ $fabricators->lastPage() }}</a>
                                </li>
                            @endif
                            @if($fabricators->currentPage() !== $fabricators->lastPage())
                                <li>
                                    <a rel="next" href="{{ $fabricators->url(($fabricators->currentPage() + 1)) }}"
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