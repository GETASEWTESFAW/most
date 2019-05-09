@extends('adminlte::page')
@section('title', 'MOST')
@section('content_header')
@stop
@section('headerbar-nave')
@if(Auth::user()->role==2)
@include('include.count');
@endif
@stop
@section('sidebar-nave')
  @if(Auth::user()->role==1)
     @include('include.sidebar')
  @endif
@stop
@section('content')
<div class="container-fluid">
<div class="row">

<div class="col-sm-offset-1 col-md-7 col-sm-7 sc" style="border:0px;height:42em;overflow:auto">
@foreach($request as $req)
<div id="request-{{$req->id}}">
<div class="panel panel-success">
  @if(auth::user()->role == 1)
  <div class="panel-heading">
    <span class="panel-title col-sm-4 " id="title-{{$req->id}}">{{$req->title}} <a href="#" data-toggle="modal" data-target="#senderModal" class="sender-link"  data-sender="{{$req->sender}}" data-id="{{$req->id}}" style="color:blue;">sender</a> </span>
     <span class="col-sm-offset-3 " style="margin-left:10px">
       @if(empty($req->admin) && empty($req->team))
       <span id="select-{{$req->id}}">
         <select name="Rteam" id="Rteam-{{$req->id}}" class="" data-id="{{$req->id}}">
           <option disabled selected> Admins Team</option>
           @foreach($req->teams as $team)
          <option value="{{$team->id}}">{{$team->teamName}}</option>
          @endforeach
        </select>
        <select name="admin" id="admin-{{$req->id}}" class="" data-id="{{$req->id}}" >
          <option disabled selected>Adminstrator</option>
          @foreach($req->administrators as $admin)
              <option value="{{$admin->id}}">{{$admin->firstName}} {{$admin->middleName}}</option>
          @endforeach
        </select>
        <button type="button" class="btn btn-primary assign" data-id="{{$req->id}}">Assign</button>
      </span>
        @else
        <span>this is assigned to {{  $req->team }}  {{ $req->firstName}} {{$req->middleName}}</span>
        @endif
      </span>
  </div>
  @elseif(auth::user()->role == 2)
  <div class="panel-heading">
    <span class="panel-title col-md-4 " id="title-{{$req->id}}">{{$req->title}}</span> <span class="col-sm-offset-4"><a href="#" data-toggle="modal" data-target="#senderModal" class="sender-link" data-sender="{{$req->sender}}" data-id="{{$req->id}}">sender</a></span>
  </div>
  @else
  <div class="panel-heading">
  <span class="panel-title col-md-4 " id="title-{{$req->id}}">{{$req->title}}</span> <span class="col-sm-offset-4"><a href="#" data-toggle="modal" data-target="#commentModal" class="comment-link" data-id="{{$req->id}}">comment</a><button type="button" id="done-{{$req->id}}" data-id="{{$req->id}}" class="btn btn-success done-button" style="margin-left: 4px" >isDone</button></span>
  </div>
  @endif
  <div class="panel-body"  id="body-{{$req->id}}">
    {{$req->message}}
  </div>
  <div class="panal-footer">
    @if(auth::user()->role != 3)
   <a href="#" data-toggle="modal" data-target="#feedbackModal" class="comment-link"  data-sender="{{$req->sender}}" data-id="{{$req->id}}" style="color:blue;margin-left:10px;">comment</a>
    @else
    <span> {{$req->status}}</span>
    @endif
  </div>
   </div>
</div>
@endforeach
</div>
<div class="modal fade" id="senderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Request Sender Address</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <div  id="title">
              <div id='name' class="senderAddress"> </div>
              <div id='dep' class="senderAddress"></div>
              <div id="floor" class="senderAddress">
              </div>
              <div id="dir" class="senderAddress">
              </div>
             </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="modal-close" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal " id="feedbackModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Request Sender Comments</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <div  id="feedback">

             </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary"  data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
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
        <button type="button" class="btn btn-secondary modal-close"  data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="modal-send" data-dismiss="modal" >Send comment</button>
      </div>
    </div>
  </div>
</div>


</div>
</div>

@stop
@section('js')
<script src="{{ asset('js/director.js') }}"></script>
<script src="{{ asset('js/employee.js') }}"></script>
@stop
