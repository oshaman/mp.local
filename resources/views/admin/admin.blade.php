@extends('admin.index')
@section('navbar')
    @isset($nav)
        <div class="navbar-header">
            {!! Menu::get('adminMenu')->asUl(array('class' => 'nav nav-pills')) !!}
        </div>
    @endisset
@endsection
@section('content')
    {!! $content !!}
@endsection

@section('jss')
    @isset($jss)
        {!! $jss !!}
    @endisset
@endsection
