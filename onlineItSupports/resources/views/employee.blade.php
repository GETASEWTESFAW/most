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
.panel-heading li{
    float: left;
    display: block;
    padding: 10px 1px;
    text-align: center;
}

.panel-heading li:first-child  {
    border-right:1px solid #bbb;
    padding: 14px 16px;
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
                <li><i class="fa fa-file-text-o"></i> Employees</li>
                <li style="width:60%">
                  <form class="form-vertical" action="/searchEmployee" method="post" style="width:100%">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="text" name="search" class="input-se" placeholder="Search Employee" style="width:70%;">
                  <button type="submit" class="btn btn-primary btn-search"><span class="glyphicon glyphicon-search"></span></button>
                </form>
                 </li>

            </ul>

        </div>

        <div class="panel-body">
                <table class="table table-striped table-bordered table-hover" id="employeesTable" style="">
                    <thead>
                        <tr>
                            <th valign="middle">ID</th>
                            <th>Full Name</th>
                            <th>Department</th>
                            <th></th>


                        </tr>
                        {{ csrf_field() }}
                    </thead>
                    <tbody>
                        @foreach($employees as $emp)
                            <tr class="item{{$emp->id}}">
                                <td>{{$emp->id}}</td>
                                <td>{{$emp->firstName}} {{$emp->middleName}}</td>
                                <td>{{ $emp->department}}</td>
                                <td><button class="delete-user btn btn-danger" data-id="{{$emp->id}}"><span class="glyphicon glyphicon-trash"></span> Delete</button></td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
        {{$employees->links()}}
    </div>
</div>
@stop
@section('js')
<script src="{{ asset('js/user.js') }}"></script>
@stop
