@extends('adminlte::page')
@section('title', 'MOST')
@section('css')
<style>


.panel-heading {
    padding: 0;
}
.panel-heading ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
}
.panel-heading li {
    float: left;
    border-right:1px solid #bbb;
    display: block;
    padding: 14px 1px;
    text-align: center;
}
.panel-heading li:first-child{
    border-right:1px solid #bbb;
    padding: 14px 16px;
}
.panel-heading li:last-child {
    border-right: none;
}
.panel-heading li a:hover {
    text-decoration: none;
}

.table.table-bordered tbody td {
    vertical-align: baseline;
}
</style>
@stop
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
<div class="content">
  <div class="row">
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <ul>
                <li><i class="fa fa-file-text-o"></i> all requests</li>
                <li style="width:60%">
                  <form class="form-vertical" action="/searchRequest" method="post" style="width:100%">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="text" name="search" class="input-se" placeholder="Search Employee" style="width:70%;">
                  <button type="submit" class="btn btn-primary btn-search"><span class="glyphicon glyphicon-search"></span></button>
                </form>
                 </li>
            </ul>
        </div>

        <div class="panel-body">
                <table class="table table-striped table-bordered table-hover" id="requestsTable" style="">
                    <thead>
                        <tr>
                            <th valign="middle">ID</th>
                            <th>Title</th>
                            <th>Request</th>
                            <th>feedback</th>
                            <th>Sender</th>
                            <th>Department</th>
                            <!-- <th>Floor</th>
                            <th>Direction</th> -->
                            <th>Team</th>
                            <th>Administrator</th>
                            <th>status</th>
                            <th></th>
                        </tr>
                        {{ csrf_field() }}
                    </thead>
                    <tbody>
                        @foreach($requests as $req)
                            <tr class="item{{$req->id}}">
                                <td>{{$req->id}}</td>
                                <td>{{$req->title}}</td>
                                <td>{{$req->message}}</td>
                                <td>{{$req->feedback}}</td>
                                <td>{{ $req->senderFirstName }} {{ $req->senderMiddleName }}</td>
                                <td>{{ $req->senderDepartment }}</td>
                                <!-- <td>{{ $req->senderFloor }}</td>
                                <td>{{ $req->senderDirection }}</td> -->
                                <td>{{ $req->team }}</td>
                                <td>{{ $req->adminFirstName }} {{ $req->adminMiddleName }}</td>
                                <td ><span class="badge">  {{$req->status}}</span></td>
                                <td><button class="delete-request btn btn-danger" data-id="{{$req->id}}"><span class="glyphicon glyphicon-trash"></span> Delete</button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
        {{$requests->links()}}
    </div>
</div>
@stop
@section('js')
<script src="{{ asset('js/request.js') }}"></script>
@stop
