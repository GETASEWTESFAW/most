@extends('adminlte::page')
@section('title', 'MOST')
@section('content_header')
@stop
@section('headerbar-nave')

@stop
@section('sidebar-nave')
<!-- <li><a href=""> <l class="fa fa-fw fa-circle-o text-yellow"></l> <span>getasew </span>  </a></li> -->
@stop
@section('content')
<div class="container" >
<div class="row">
<form class="form-horizontal" action="/request" method="post">

  <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
  	<label for="title" class="col-sm-1 control-label">Type</label>
    <div class="col-sm-6">
    <select name="title" id="title" class="form-control form-control-lg">
      <option disabled selected> Request type</option>
      @foreach($category as $title => $id)
      <option value="{{$id}}">{{$title}}</option>
      @endforeach

    </select>

    </div>
    <div class="col-sm-6 col-sm-offset-1 ">
      @if ($errors->has('title'))
          <span class="help-block">
              <strong style="color:red">{{ $errors->first('title') }}</strong>
          </span>
      @endif
    </div>

  </div>
  <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
  	<label for="body" class="col-sm-1 control-label">Description</label>
    <div class="col-sm-6">
      <textarea name="body" id="body" class="form-control" maxlength="255" rows="4"></textarea>
    </div>
    <div class="col-sm-6 col-sm-offset-1 ">
    @if ($errors->has('body'))
        <span class="help-block">
            <strong style="color:red">{{ $errors->first('body') }}</strong>
        </span>
    @endif
  </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-1 col-sm-6">
      <button type="submit" class="btn btn-primary btn-lg btn-block">Send Request</button>
    </div>
  </div>
  <input type="hidden" name="_token" value="{{csrf_token()}}">
</form>
<div class="col-sm-offset-1 col-sm-7 request sc" style="border:0px;height:28em;overflow:auto">
@foreach($request as $req)
<div  id="request-{{$req->id}}">
<div class="panel panel-success">
  <div class="panel-heading">
    <span class="panel-title col-md-4 " id="title-{{$req->id}}">{{$req->title}}</span> <span class="col-sm-offset-5"><a href="#" data-toggle="modal" data-target="#commentModal" class="comment-link" data-id="{{$req->id}}">comment</a><button type="button" id="done-{{$req->id}}" data-id="{{$req->id}}" class="btn btn-success done-button" style="margin-left: 4px" >isDone</button></span>
  </div>
  <div class="panel-body"  id="body-{{$req->id}}">
    {{$req->message}}
  </div>
  <div class="panal-footer" id='footer-{{$req->id}}'>
   <span> {{$req->status}}</span>
  </div>
   </div>
</div>
@endforeach
</div>
<div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Feedback for Request Resolver</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <div  id="title"> </div>
          </div>
          <input type="hidden" name="" id="id" value="" disabled>
        <div class="form-group">
            <div  id="body"></div>
          </div>
          <div class="form-group">
            <textarea class="form-control" maxlength="255" rows="4" id="modal-comment"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="modal-close" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="modal-send" data-dismiss="modal">Send comment</button>
      </div>
    </div>
  </div>
</div>


</div>
</div>
@stop
@section('js')
<script src="{{ asset('js/employee.js') }}"></script>
@stop
