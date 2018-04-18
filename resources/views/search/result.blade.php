<div class="result">
    @if(isset($result) && count($result)>0)
        @foreach($result as $k=>$collections)
            <div class="res-cat">{{ trans('ru.'.$k) }}</div>
            <div class="res-links">
                @foreach($collections as $item)
                    @switch($k)
                        @case('medicines')
                        <a href="{{ route('medicine', $item['alias']) }}">{{ $item['title'] }}</a>
                        @break

                        @case('fabricators')
                        <a href="{{ route('search_fabricator', ['val'=>mb_substr($item->title, 0, 1), 'fabricator'=>$item->alias]) }}">{{ $item->title }}</a>
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
                        <a href="{{ route('medicine', $item['alias']) }}">{{ $item['title'] }}</a>
                    @endswitch
                @endforeach
            </div>
        @endforeach
    @else
        <h3>0</h3>
    @endif
</div>