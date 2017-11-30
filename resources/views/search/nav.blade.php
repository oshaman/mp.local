<div class="product-nav product-nav-analog">
    <a href="{{ route('search_alpha', 'ru') }}"
       class="nav-button-grey @if('search_alpha' == Route::currentRouteName()) active @endif">По алфавиту</a>
    <a href="{{ route('search_substance', 'ru') }}"
       class="nav-button-grey @if('search_substance' == Route::currentRouteName()) active @endif">По действующему
        веществу</a>
    <a href="{{ route('search_mnn', 'ru') }}"
       class="nav-button-grey @if('search_mnn' == Route::currentRouteName()) active @endif">По международному названию
        (МНН)</a>
    <a href="{{ route('search_atx', 'ru') }}"
       class="nav-button-grey @if('search_atx' == Route::currentRouteName()) active @endif">По АТХ-классификации</a>
    <a href="{{ route('search_farm', 'ru') }}"
       class="nav-button-grey @if('search_farm' == Route::currentRouteName()) active @endif">По фармакотерапевтической
        группе</a>
    <a href="{{ route('search_fabricator', 'ru') }}"
       class="nav-button-grey @if('search_fabricator' == Route::currentRouteName()) active @endif">По производителю</a>
</div>