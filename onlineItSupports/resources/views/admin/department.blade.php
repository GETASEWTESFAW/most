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
                <li><i class="fa fa-file-text-o"></i> All Departmentes</li>
                <a href="#" class="add-modal"><li>Add a Department</li></a>
            </ul>
        </div>

        <div class="panel-body">
                <table class="table table-striped table-bordered table-hover" id="departmentTable" style="">
                    <thead>
                        <tr>
                            <th valign="middle">ID</th>
                            <th>Department</th>
                            <th>Floor</th>
                            <th>Direction</th>
                        </tr>
                        {{ csrf_field() }}
                    </thead>
                    <tbody>
                        @foreach($department as $dep)
                            <tr class="item{{$dep->id}}">
                                <td>{{$dep->id}}</td>
                                <td>{{$dep->departmentName}}</td>
                                <td>{{$dep->floor}}</td>
                                <td>{{$dep->direction}}</td>
                                <td>
                                    <button class="edit-modal btn btn-info" data-id="{{$dep->id}}" data-name="{{$dep->departmentName}}">
                                    <span class="glyphicon glyphicon-edit"></span> Edit</button>
                                    <button class="delete-modal btn btn-danger" data-id="{{$dep->id}}" data-name="{{$dep->departmentName}}">
                                    <span class="glyphicon glyphicon-trash"></span> Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div><!-- /.panel-body -->
    </div><!-- /.panel panel-default -->
    {{$department->links()}}
</div><!-- /.col-md-8 -->

<!-- Modal form to add a Category -->
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
                        <label class="control-label col-sm-2" for="title">Department:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="title_add" autofocus required>
                            <p class="errorTitle text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="title">Floor:</label>
                        <div class="col-sm-10">
                          <select name="floor" class="form-control form-control-lg" id="floor_add" required>
                            <option selected disabled>--please select--</option>
                            @foreach($floores as $floor => $id)
                            <option value="{{$id}}" >{{$floor}}</option>
                            @endforeach

                          </select>
                            <p class="errorTitle text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="title">Direction:</label>
                        <div class="col-sm-10">
                          <select name="direction" class="form-control form-control-lg" id="direction_add" required>
                           <option selected disabled>--please select--</option>
                            @foreach($directiones as $direction => $id)
                            <option value="{{$id}}">{{$direction}}</option>
                            @endforeach

                          </select>
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

<!-- Modal form to show a Category -->

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
                        <label class="control-label col-sm-2" for="title">Department:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="title_edit" autofocus required>
                            <p class="errorTitle text-center alert alert-danger hidden"></p>
                        </div>
                      </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="title">Floor:</label>
                            <div class="col-sm-10">
                              <select name="floor" class="form-control form-control-lg" id="floor_edit" required>

                                @foreach($floores as $floor => $id)
                                <option value="{{$id}}" @if($department[0]->floId==$id) selected @endif>{{$floor}}</option>
                                @endforeach

                              </select>
                                <p class="errorTitle text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="title">Direction:</label>
                                <div class="col-sm-10">
                                  <select name="direction" class="form-control form-control-lg" id="direction_edit" required>

                                    @foreach($directiones as $direction => $id)
                                    <option value="{{$id}}" @if($department[0]->dirId==$id) selected @endif>{{$direction}}</option>
                                    @endforeach

                                  </select>
                                    <p class="errorTitle text-center alert alert-danger hidden"></p>
                               </div>
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
                <h3 class="text-center">Are you sure you want to delete the following department?</h3>
                <br />
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="id">ID:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="id_delete" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="title">department:</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="title_delete" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="title">Floor:</label>
                        <div class="col-sm-10">
                          <select name="floor" class="form-control form-control-lg" id="floor_delete" disabled >

                            @foreach($floores as $floor => $id)
                            <option value="{{$id}}" @if($department[0]->floId==$id) selected @endif>{{$floor}}</option>
                            @endforeach

                          </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="title">Direction:</label>
                        <div class="col-sm-10">
                          <select name="direction" class="form-control form-control-lg" id="direction_delete" disabled>

                            @foreach($directiones as $direction => $id)
                            <option value="{{$id}}" @if($department[0]->dirId==$id) selected @endif>{{$direction}}</option>
                            @endforeach

                          </select>
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
<script src="{{ asset('js/department.js') }}"></script>
@stop
