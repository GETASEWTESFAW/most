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
        <!-- <form> -->
          <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
              <input type="password" id="password" name="password" class="form-control"
                     placeholder="{{ trans('adminlte::adminlte.password') }}" required>
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              @if ($errors->has('password'))
                  <span class="help-block">
                      <strong>{{ $errors->first('password') }}</strong>
                  </span>
              @endif
          </div>
          <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
              <input type="password" id="cpassword" name="password_confirmation" class="form-control"
                     placeholder="{{ trans('adminlte::adminlte.retype_password') }}" required>
              <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
              @if ($errors->has('password_confirmation'))
                  <span class="help-block">
                      <strong>{{ $errors->first('password_confirmation') }}</strong>
                  </span>
              @endif
          </div>
          <button type="submit" id="change-password" class="btn btn-primary btn-block btn-flat">change password</button>
     <!-- </form> -->
</div>
</div>
@stop
@section('js')
<script src="{{ asset('js/changePassword.js') }}"></script>
@stop
