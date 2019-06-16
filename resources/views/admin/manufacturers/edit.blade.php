@extends('admin.index')
@section('content')

@push('js')

<script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>


<script type="text/javascript" src='{{ url('designAdmin/AdminLTE/dist/js/locationpicker.jquery.js') }}'></script>


<?php
$lat = !empty($manufacturers->lat)?$manufacturers->lat:30.129090714411333;
$lng = !empty($manufacturers->lng)?$manufacturers->lng:31.267706871032715;

?>
     <script>
            $('#us1').locationpicker({
                location: {
                    latitude: {{ $lat }},
                    longitude: {{ $lng }}
                },
                radius: 300,
                markerIcon: '{{ url('designAdmin/AdminLTE/dist/img/map-marker-2-xl.png') }}',

                inputBinding: {
                    latitudeInput: $('#lat'),
                    longitudeInput: $('#lng'),
                    // radiusInput: $('#us2-radius'),
                     locationNameInput: $('#address')
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
    {!! Form::open(['url'=>aurl('manufacturers/'.$manufacturers->id),'method'=>'put','files'=>true ]) !!}

    <input type="hidden" value="{{ $lat }}" id="lat" name="lat">
    <input type="hidden" value="{{ $lng }}" id="lng" name="lng">

    <div class="form-group">
        {!! Form::label('name_ar',trans('admin.manufacturers_name_ar')) !!}
        {!! Form::text('name_ar',$manufacturers->name_ar,['class'=>'form-control']) !!}
     </div>

     <div class="form-group">
        {!! Form::label('name_en',trans('admin.manufacturers_name_en')) !!}
        {!! Form::text('name_en',$manufacturers->name_en,['class'=>'form-control']) !!}
     </div>

     <div class="form-group">
         {!! Form::label('contact_name',trans('admin.contact_name')) !!}
         {!! Form::text('contact_name',$manufacturers->contact_name,['class'=>'form-control']) !!}
      </div>

      <div class="form-group">
           {!! Form::label('mobile',trans('admin.mobile')) !!}
           {!! Form::text('mobile',$manufacturers->mobile,['class'=>'form-control']) !!}
      </div>


      <div class="form-group">
            {!! Form::label('address',trans('admin.address')) !!}
            {!! Form::text('address',$manufacturers->address,['class'=>'form-control address']) !!}
         </div>

         <div class="form-group">
                <div id="us1" style="width: 100%; height: 400px;"></div>

         </div>

      <div class="form-group">
            {!! Form::label('email',trans('admin.email')) !!}
            {!! Form::email('email',$manufacturers->email,['class'=>'form-control']) !!}
       </div>

      <div class="form-group">
           {!! Form::label('facebook',trans('admin.facebook')) !!}
           {!! Form::text('facebook',$manufacturers->facebook,['class'=>'form-control']) !!}
      </div>

      <div class="form-group">
            {!! Form::label('twitter',trans('admin.twitter')) !!}
            {!! Form::text('twitter',$manufacturers->twitter,['class'=>'form-control']) !!}
       </div>

      <div class="form-group">
           {!! Form::label('website',trans('admin.website')) !!}
           {!! Form::text('website',$manufacturers->website,['class'=>'form-control']) !!}
      </div>


     <div class="form-group">
        {!! Form::label('icon',trans('admin.manufacturers_icon')) !!}
        {!! Form::file('icon',['class'=>'form-control']) !!}

        @if (!empty($manufacturers->icon))
        <img src="{{ Storage::url($manufacturers->icon) }}" style="width:50px;hight:50px" >
        @endif

     </div>




     {!! Form::submit(trans('admin.save'),['class'=>'btn btn-primary']) !!}
    {!! Form::close() !!}
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->



@endsection


