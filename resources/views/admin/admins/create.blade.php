@extends('admin.index')
@section('content')

<div class="box">
    <div class="box-header">
      <h3 class="box-title">{{  $title }}</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <form action="{{ aurl('admin') }}" method="POST" enctype="multipart/form-data">

            @csrf
            <div class="form-group">
                <label for="name">{{ trans('admin.name') }}</label>
                <input type="name" name="name" id="old('name')" class="form-control">
            </div>

            <div class="form-group">
                <label for="email">{{ trans('admin.email') }}</label>
                <input type="email" name="email" id="old('email')" class="form-control">
            </div>

            <div class="form-group">
                <label for="password">{{ trans('admin.password') }}</label>
                <input type="password" name="password"  class="form-control">
            </div>



            <div class="form-group">
               <button type="submit" class="btn btn-primary">{{ trans('admin.create_admin') }}</button>
           </div>
         </form>

    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->





@endsection


