@extends('adminlte::master')
@section('body')

      <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="login-panel panel panel-default">
                    <div style="margin-top: 50px">
                         @if (Route::has('login'))
                       <div class="top-right links">
                         <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>

                </div>
            @endif
                        <img src="{{asset('image/most.gif') }}" class="img-responsive" />
                    </div>
    <div class="login-box" style="margin-top:-30px;margin-bottom: 230px" >
    <div class="container">
        <div class="row">
            <div class="col-md-5">
            <div class="panel panel-success">
                <div class="panel-heading ">Activation Confirmed</div>
                <div class="panel-body">
                  @if(!empty($user))
                  <strong>{{$user->firstName}} {{$user->middleName}}</strong>
                    Your Email is successfully verified.Wait until your account is approved by the MOST Ict director to login.
                       Click here to <a href="{{ url('/login') }}">login</a>
                   @else
                   Your Email is not successfully verified.please click the link or registered again.
                  @endif
                </div>
            </div>
        </div>
    </div>
    </div>
  </div><!-- /.login-box -->
</div>
</div>
</div>
</div>
@stop
