<div class="">
    @if(isset($result) && count($result)>0)
        @foreach($result as $k=>$collections)
            <h3>{{ $k }}</h3>
            @foreach($collections as $item)
                @switch($k)
                    @case('medicines')
                    <a href="{{ route('medicine', $item['alias']) }}">{{ $item['title'] }}</a>
                    @break

                    @case('fabricators')
                    <a href="{{ route('search_fabricator', $item->alias) }}">{{ $item->title }}</a>
                    @break

                    @case('innnames')
                    <a href="{{ route('search_mnn', $item->alias) }}">{{ $item->title }}</a>
                    @break

                    @case('pharma')
                    <a href="{{ route('search_farm', $item->alias) }}">{{ $item->title }}</a>
                    @break

                    @case('substances')
                    <a href="{{ route('search_substance', $item->alias) }}">{{ $item->title }}</a>
                    @break

                    @case('articles')
                    <a href="{{ route('articles', $item->alias) }}">{{ $item->title }}</a>
                    @break

                    @default
                    @continue
                @endswitch
            @endforeach
        @endforeach
    @endif
</div>

{!! Form::open(['url'=>route('presearch'), 'method'=>'post']) !!}
{{ Form::text('search') }}

{{ Form::submit('submit') }}
{!! Form::close() !!}