@extends('adminlte::page')
@section('title', 'MOST')
@section('content_header')
@stop
@section('headerbar-nave')
 @include('include.count');
@stop
@section('sidebar-nave')
@stop
@section('content')
<div class="container-fluid">
<div class="row">
<div class="col-sm-offset-1 col-sm-6 sc"  style="border:0px;height:43em;overflow:auto">
  @foreach($request as $req)
  <div  id="request-{{$req->id}}">
  <div class="panel panel-success">
    <div class="panel-heading">
      <span class="panel-title col-md-4 " id="title-{{$req->id}}">{{$req->title}}</span> <span class="col-sm-offset-4"><a href="#" data-toggle="modal" data-target="#senderModal" class="sender-link" data-sender="{{$req->sender}}" data-id="{{$req->id}}">sender</a></span>
    </div>
    <div class="panel-body"  id="body-{{$req->id}}">
      {{$req->message}}
    </div>
    <div class="panal-footer">
  <a href="#" data-toggle="modal" data-target="#feedbackModal" class="comment-link"  data-sender="{{$req->sender}}" data-id="{{$req->id}}" style="color:blue;">comment</a>
    </div>
     </div>
  </div>
  @endforeach
</div>

  <div class="modal fade" id="senderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="exampleModalLabel">Request Sender Address</h3>
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
          <button type="button" class="btn btn-secondary" id="modal-close" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

</div>
</div>
@stop
@section('js')
<script src="{{ asset('js/admin.js') }}"></script>
@stop
