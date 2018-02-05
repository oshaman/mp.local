@include('admin.statistic.navigation')
{!! Form::open(['url'=>route('download_atx'), 'method' => 'post', 'class' => 'form-horizontal']) !!}
{!! Form::button('Cкачать', ['class' => 'btn btn-primary btn-block','type'=>'submit']) !!}
{!! Form::close() !!}