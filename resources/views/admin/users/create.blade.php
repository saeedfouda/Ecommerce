

@extends('admin.index')
@section('content')


<div class="box">
  <div class="box-header">
    <h3 class="box-title">{{ $title }}</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    {!! Form::open(['url'=>aurl('users')]) !!}
     <div class="form-group">
        {!! Form::label('name',trans('admin.name_users')) !!}
        {!! Form::text('name',old('name'),['class'=>'form-control']) !!}
     </div>
     <div class="form-group">
        {!! Form::label('email',trans('admin.email_users')) !!}
        {!! Form::email('email',old('email'),['class'=>'form-control']) !!}
     </div>
     <div class="form-group">
        {!! Form::label('password',trans('admin.password')) !!}
        {!! Form::password('password',['class'=>'form-control']) !!}
     </div>

     <div class="form-group">
        {!! Form::label('level',trans('admin.level')) !!}
        {!! Form::select('level',[
                                    'user'=>trans('admin.user'),
                                    'vendor'=>trans('admin.vendor'),
                                    'company'=>trans('admin.company')]
        ,old('level'),['class'=>'form-control' ,]) !!}

     </div>
     {!! Form::submit(trans('admin.create_users'),['class'=>'btn btn-primary']) !!}
    {!! Form::close() !!}
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->



@endsection

