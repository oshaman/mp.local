@extends('admin.index')
@section('navbar')
    @isset($nav)
        <div class="navbar-header">
            {!! Menu::get('adminMenu')->asUl(array('class' => 'nav nav-pills')) !!}
        </div>
    @endisset
@endsection
@section('content')
    <h2>{!! $content !!}</h2>
@endsection