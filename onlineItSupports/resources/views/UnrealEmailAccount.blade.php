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
    padding: 14px 16px;
    text-align: center;
}
.panel-heading li:last-child:hover {
    background-color: #ccc;
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
<div class="content">
  <div class="row">
<div class="col-md-10 col-md-offset-1">
    <div class="panel panel-default">
        <div class="panel-heading">
            <ul>
                <li><i class="fa fa-file-text-o"></i> All the current Posts</li>
                <li><button class="delete btn btn-danger" id="deleteSelected"data-id=""><span class="glyphicon glyphicon-trash"></span> Delete</button></li>
            </ul>
        </div>

        <div class="panel-body">
                <table class="table table-striped table-bordered table-hover" id="postTable" style="">
                    <thead>
                        <tr>
                          <th><input type="checkbox" class="checkboxs" id='checkedAll' value="all">all</th>
                            <th valign="middle">ID</th>
                            <th>Full name</th>
                            <th>Department</th>
                            <th>Role</th>
                        </tr>
                        {{ csrf_field() }}
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr class="item{{$user->id}} warning ">
                              <td class="text-center"><input type="checkbox" class="checkbox" value="{{$user->id}}"></td>
                                <td>{{$user->id}}</td>
                                <td>{{$user->firstName}} {{$user->middleName}}</td>
                                <td>{{ $user->department }}</td>
                                <td>{{$user->role}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
          {{$users->links()}}
    </div>
</div>
</div>
</div>
@stop
@section('js')
<script src="{{ asset('js/spamUser.js') }}"></script>
@stop
