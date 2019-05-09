@extends('adminlte::page')
@section('title', 'MOST')
@section('content_header')
@stop
@section('headerbar-nave')
@if(Auth::user()->role==2)
   @include('include.count')
@endif
@stop
@section('sidebar-nave')
    @if(Auth::user()->role==1)
      @include('include.sidebar')
    @endif
@stop
@section('content')
<div class="register-box">
    <div class="register-box-body">
        <form action="{{ url(config('adminlte.editProfile_url', '/editProfile')) }}" method="post">
            {!! csrf_field() !!}
            <label for="fname">First Name</label>
            <div id="fname" class="form-group has-feedback {{ $errors->has('firstName') ? 'has-error' : '' }}">
                <input type="text" name="firstName" class="form-control" value="{{$profile->firstName}}"
                       placeholder="{{$profile->firstName}}">
                 <span class="glyphicon glyphicon-user form-control-feedback"></span>
                 @if ($errors->has('firstName'))
                    <span class="help-block">
                        <strong>{{ $errors->first('firstName') }}</strong>
                    </span>
                @endif
            </div>
            <label for="mname">Middle Name</label>
            <div id="mname" class="form-group has-feedback {{ $errors->has('middleName') ? 'has-error' : '' }}">
                 <input type="text" name="middleName" class="form-control" value="{{$profile->middleName}}"
                       placeholder="{{$profile->middleName}}">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                @if ($errors->has('middleName'))
                    <span class="help-block">
                        <strong>{{ $errors->first('middleName') }}</strong>
                    </span>
                @endif
            </div>



            <label for="dep">Department</label>
            <div id="dep" class="form-group has-feedback {{ $errors->has('department') ? 'has-error' : '' }}">
                <select name="department" class="form-control form-control-lg">

                  @foreach($department as $title => $id)
                  <option value="{{$id}}" @if($profile->department==$id) selected @endif>{{$title}}</option>
                  @endforeach

                </select>
                 @if ($errors->has('department'))
                    <span class="help-block">
                        <strong>{{ $errors->first('department') }}</strong>
                    </span>
                @endif

                 </div>

                 <label for="rol">Role</label>
                 <div id="rol" class="form-group has-feedback {{ $errors->has('role') ? 'has-error' : '' }}">
                 <select name="role" class="form-control form-control-lg">

                  @foreach($role as $title => $id)
                  <option value="{{$id}}" @if($profile->role==$id) selected @endif>{{$title}}</option>
                  @endforeach
                </select>

              @if ($errors->has('role'))
                    <span class="help-block">
                        <strong>{{ $errors->first('role') }}</strong>
                    </span>
                @endif
              </div>
            <button type="submit" class="btn btn-primary btn-block btn-flat">EditProfile</button>
        </form>
    </div>
    <!-- /.form-box -->
</div><!-- /.register-box -->
@stop
