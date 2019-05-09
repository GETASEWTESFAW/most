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
            <div class="panel panel-danger">
                <div class="panel-heading ">For activation link or password reset link</div>
                <div class="panel-body">
                   The email is not successfully sent to your email account.please check the connection or enter the correct email!.

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
