@extends('layouts.main')

@section('header')
    {!! $header !!}
@endsection

@section('content')
    {!! $content ?? '' !!}
@endsection

@if(!empty($aside))
@section('aside')
    {!! $aside !!}
@endsection
@endif

@section('slider')
    {!! $slider ?? '' !!}
@endsection

@if(!empty($jss))
@section('jss')
    {!! $jss !!}
@endsection
@endif

@section('footer')
    {!! $footer !!}
@endsection