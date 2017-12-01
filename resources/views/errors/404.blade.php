@extends('layouts.main', ['title'=>'404'])

@section('content')
    <div class="page-404">
        <div class="num-404">404</div>
        <div class="text-404">УПС... такой страницы больше не существует...</div>
        <h2>Возможно Вы искали:</h2>
        <div class="admin-content">
            <ul>
                <li><a href="">Фитотерапия</a></li>
                <li><a href="">Заблуждения</a></li>
                <li><a href="">Питание и диета</a></li>
                <li><a href="">Интимные темы</a></li>
            </ul>
        </div>
    </div>
@endsection

