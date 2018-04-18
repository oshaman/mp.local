<h1>Еыуе</h1>
@if(1 === $articles->currentPage())
    <ul>
        @foreach($prems as $prem)
            <li>
                {{ $prem->id }}====>
                {{ $prem->priority }}
                {{ $prem->title }}
            </li>
        @endforeach
    </ul>
@endif
<ul>
    @foreach($articles as $article)
        <li>
            {{ $article->id }}
            {{ $article->priority }}
            {{ $article->title }}
        </li>
    @endforeach
</ul>

{{ $articles->links() }}