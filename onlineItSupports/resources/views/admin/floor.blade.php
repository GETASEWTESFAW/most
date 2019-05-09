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
                <li><i class="fa fa-file-text-o"></i> All Floores</li>
                <a href="#" class="add-modal"><li>Add a Floor </li></a>
            </ul>
        </div>

        <div class="panel-body">
                <table class="table table-striped table-bordered table-hover" id="floorTable" style="">
                    <thead>
                        <tr>
                            <th valign="middle">ID</th>
                            <th>Floor</th>
                        </tr>
                        {{ csrf_field() }}
                    </thead>
                    <tbody>
                        @foreach($floor as $flo)
                            <tr class="item{{$flo->id}}">
                                <td>{{$flo->id}}</td>
                                <td>{{$flo->floor}}</td>
                                <td>
                                    <button class="edit-modal btn btn-info" data-id="{{$flo->id}}" data-title="{{$flo->floor}}">
                                    <span class="glyphicon glyphicon-edit"></span> Edit</button>
                                    <button class="delete-modal btn btn-danger" data-id="{{$flo->id}}" data-title="{{$flo->floor}}">
                                    <span class="glyphicon glyphicon-trash"></span> Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div><!-- /.panel-body -->
    </div><!-- /.panel panel-default -->
    {{$floor->links()}}
</div><!-- /.col-md-8 -->

<!-- Modal form to add a post -->
<div id="addModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="title">Floor:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="title_add" autofocus required>
                            <p class="errorTitle text-center alert alert-danger hidden"></p>
                        </div>
                    </div>

                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success add" data-dismiss="modal">
                        <span id="" class='glyphicon glyphicon-check'></span> Add
                    </button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class='glyphicon glyphicon-remove'></span> Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal form to show a post -->

<!-- <textarea class="form-control" id="content_show" cols="40" rows="5" disabled></textarea> -->

<!-- Modal form to edit a form -->
<div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="id">ID:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="id_edit" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="title">Floor:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="title_edit" autofocus required>
                            <p class="errorTitle text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary edit" data-dismiss="modal">
                        <span class='glyphicon glyphicon-check'></span> Edit
                    </button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class='glyphicon glyphicon-remove'></span> Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal form to delete a form -->
<div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <h3 class="text-center">Are you sure you want to delete the following floor?</h3>
                <br />
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="id">ID:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="id_delete" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="title">Floor:</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="title_delete" disabled>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger delete" data-dismiss="modal">
                        <span id="" class='glyphicon glyphicon-trash'></span> Delete
                    </button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class='glyphicon glyphicon-remove'></span> Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@stop
@section('js')
<script src="{{ asset('js/floor.js') }}"></script>
@stop
