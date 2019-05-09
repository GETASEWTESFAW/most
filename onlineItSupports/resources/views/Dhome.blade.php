@extends('adminlte::page')
@section('title', 'MOST')
@section('content_header')
@stop
@section('headerbar-nave')
@stop
@section('sidebar-nave')
  @if(Auth::user()->role==1)
     @include('include.sidebar')
  @endif
@stop
@section('content')
<div class="container-fluid">
<div class="row">
@if(!empty($employee[0]))
<div class="table-responsive-sm">
  <div style="border:0px;height:10em;overflow:auto">
<table class="table table-hover table-condensed">
  <thead class="thead-light">
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Role</th>
      <th scope="col">Department</th>
      <th scope="col"></th>
      <th></th>
    </tr>
  </thead>
  <tbody>

  	@foreach($employee as $emp)
    <tr id="employee{{$emp->id}}">
      <th scope="row">{{$emp->firstName}} {{$emp->middleName}}</th>
      <td>{{$emp->role}}</td>
      <td>{{$emp->department}}</td>
      @if($emp->roleId==2)
      <td>
        <select name="Eteam" id="Eteam-{{$emp->id}}" class="" data-id="{{$emp->id}}">
          <option disabled selected> Admins Team</option>
          @foreach($teams as $team)
         <option value="{{$team->id}}">{{$team->teamName}}</option>
         @endforeach
       </select>
      </td>
      @endif
      <td> <button type="button" class="btn btn-primary approve" data-role='{{$emp->roleId}}' data-id='{{$emp->id}}'>approve</button> <button type="button" class="btn btn-danger cancel" data-id='{{$emp->id}}'> cancel</button></td>
    </tr>
    @endforeach

  </tbody>
</table>
</div>
</div>

@endif
<div class="col-sm-offset-1 col-md-7 col-sm-7 sc" style="border:0px;height:30em;overflow:auto">
@foreach($request as $req)
<div id="request-{{$req->id}}">
<div class="panel panel-success">
  <div class="panel-heading">

    <span class="panel-title col-sm-4 " id="title-{{$req->id}}">{{$req->title}} <a href="#" data-toggle="modal" data-target="#senderModal" class="sender-link"  data-sender="{{$req->sender}}" data-id="{{$req->id}}" style="color:blue;">sender</a> </span>
     <span class="col-sm-offset-3 " style="margin-left:10px">
       @if(empty($req->admin) && empty($req->team))
       <span id="select-{{$req->id}}">
         <select name="Rteam" id="Rteam-{{$req->id}}" class="" data-id="{{$req->id}}">
           <option disabled selected> Admins Team</option>
           @foreach($teams as $team)
          <option value="{{$team->id}}">{{$team->teamName}}</option>
          @endforeach
        </select>
        <select name="admin" id="admin-{{$req->id}}" class="" data-id="{{$req->id}}" >
          <option disabled selected>Adminstrator</option>
          @foreach($admins as $admin)
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
        <button type="button" class="btn btn-secondary" id="modal-close" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

</div>
</div>

@stop
@section('js')
<script src="{{ asset('js/director.js') }}"></script>
@stop
