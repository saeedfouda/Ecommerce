@extends('admin.index')
@section('content')


@push('js')

<script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>


<script type="text/javascript" src='{{ url('designAdmin/AdminLTE/dist/js/locationpicker.jquery.js') }}'></script>


<?php
$lat = !empty(old('lat'))?old('lat'):30.129090714411333;
$lng = !empty(old('lng'))?old('lng'):31.267706871032715;

?>
     <script>
            $('#us1').locationpicker({
                location: {
                    latitude:{{ $lat }},
                    longitude:{{ $lng }}
                },
                radius: 300,
                markerIcon: '{{ url('designAdmin/AdminLTE/dist/img/map-marker-2-xl.png') }}',

                inputBinding: {
                    latitudeInput: $('#lat'),
                    longitudeInput: $('#lng'),
                    // radiusInput: $('#us2-radius'),
                    // locationNameInput: $('#address')
                }
        });
    </script>
@endpush


<div class="box">
  <div class="box-header">
    <h3 class="box-title">{{ $title }}</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    {!! Form::open(['url'=>aurl('shippings'),'files'=>true]) !!}
    <input type="hidden" value="{{ $lat }}" id="lat" name="lat">
    <input type="hidden" value="{{ $lng }}" id="lng" name="lng">

     <div class="form-group">
        {!! Form::label('name_ar',trans('admin.shippings_name_ar')) !!}
        {!! Form::text('name_ar',old('name_ar'),['class'=>'form-control']) !!}
     </div>

     <div class="form-group">
        {!! Form::label('name_en',trans('admin.shippings_name_en')) !!}
        {!! Form::text('name_en',old('name_en'),['class'=>'form-control']) !!}
     </div>

     <div class="form-group">
        {!! Form::label('user_id',trans('admin.user_id')) !!}
        {!! Form::select('user_id',App\User::where('level', 'company')->pluck('name', 'id'),old('user_id'),['class'=>'form-control']) !!}
     </div>


     <div class="form-group">
            <div id="us1" style="width: 100%; height: 400px;"></div>

     </div>




     <div class="form-group">
        {!! Form::label('icon',trans('admin.icon')) !!}
        {!! Form::file('icon',['class'=>'form-control']) !!}
     </div>




     {!! Form::submit(trans('admin.create_users'),['class'=>'btn btn-primary']) !!}
    {!! Form::close() !!}
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->



@endsection

