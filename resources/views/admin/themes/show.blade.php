<!-- START CONTENT -->
<div class="">
    {!! Form::open(['url' => route('themes_admin'), 'class'=>'form-horizontal','method'=>'GET' ]) !!}
    <h3>Поиск темы:</h3>
    <div class="">
        {{ Form::label('value', 'Заголовок') }}
        {!! Form::text('value', old('value') ? : '' , ['placeholder'=>'id, link...', 'id'=>'value', 'class'=>'form-control']) !!}
    </div>
    <hr>
    <div class="">
        {!! Form::button('Поиск', ['class' => 'btn btn-primary','type'=>'submit']) !!}
    </div>
    {!! Form::close() !!}
</div>
<hr>
{!! Form::open(['url' => route('themes_add'),'class'=>'form-horizontal','method'=>'GET']) !!}
{!! Form::button('Создать', ['class' => ' btn btn-success btn-block','type'=>'submit']) !!}
{!! Form::close() !!}
<hr>
<div class="">
    <table class="table">
        <thead>
        <tr>
            <th>Заголовок</th>
            <th>Локализация</th>
        </tr>
        </thead>
        @if (!empty($themes[0]))
            <tbody>
            @foreach ($themes as $theme)
                <tr>
                    <td>{{ $theme->title }}</td>
                    <td>{{ $theme->loc }}</td>
                    <td>
                        {!! Form::open(['url' => route('themes_update',['theme'=> $theme->id]),'class'=>'form-horizontal','method'=>'GET']) !!}
                        {!! Form::button('Редактировать', ['class' => 'btn btn-warning','type'=>'submit']) !!}
                        {!! Form::close() !!}
                    </td>
                    <td>
                        {!! Form::open(['url' => route('delete_theme',['theme'=> $theme->id]),'class'=>'form-horizontal','method'=>'GET']) !!}
                        {!! Form::button('Удалить', ['class' => 'btn btn-danger','type'=>'submit']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
            <!--PAGINATION-->
            <div class="general-pagination group">
                @if(is_object($themes) && !empty($themes->lastPage()) && $themes->lastPage() > 1)
                    @if($themes->lastPage() > 1)
                        <ul class="pagination">
                            @if($themes->currentPage() !== 1)
                                <li>
                                    <a rel="prev" href="{{ $themes->url(($themes->currentPage() - 1)) }}"
                                       class="prev">
                                        <
                                    </a>
                                </li>
                            @endif
                            @if($themes->currentPage() >= 3)
                                <li><a href="{{ $themes->url($themes->url(1)) }}">1</a></li>
                            @endif
                            @if($themes->currentPage() >= 4)
                                <li><a href="#">...</a></li>
                            @endif
                            @if($themes->currentPage() !== 1)
                                <li>
                                    <a href="{{ $themes->url($themes->currentPage()-1) }}">{{ $themes->currentPage()-1 }}</a>
                                </li>
                            @endif
                            <li><a class="active disabled">{{ $themes->currentPage() }}</a></li>
                            @if($themes->currentPage() !== $themes->lastPage())
                                <li>
                                    <a href="{{ $themes->url($themes->currentPage()+1) }}">{{ $themes->currentPage()+1 }}</a>
                                </li>
                            @endif
                            @if($themes->currentPage() <= ($themes->lastPage()-3))
                                <li><a href="#">...</a></li>
                            @endif
                            @if($themes->currentPage() <= ($themes->lastPage()-2))
                                <li>
                                    <a href="{{ $themes->url($themes->lastPage()) }}">{{ $themes->lastPage() }}</a>
                                </li>
                            @endif
                            @if($themes->currentPage() !== $themes->lastPage())
                                <li>
                                    <a rel="next" href="{{ $themes->url(($themes->currentPage() + 1)) }}"
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