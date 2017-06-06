@extends('layouts.app')

@section('content')
    <div class="container" ng-controller="TasksController" ng-init="loadTasks()">
        <div class="col-sm-offset-2 col-sm-8">
        @if(session('msg') != null)
            <div class="alert alert-success">
                 {{ session('msg') }}
            </div>
        @endif

                <div class="alert alert-danger" style="display: none;" id="delete_status">
                     Task has been deleted successfully.
                </div>
                <div class="panel panel-default">
                <div class="panel-heading col-sm-6">
                        <strong>Current Tasks</strong>
                </div>
                <div class="panel-heading col-sm-6">
                        <input type="text" class="form-control" placeholder="Search" ng-model="userSearch">
                </div>
                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <thead class="bg bg-primary">
                                <th>Task</th>
                                <th>Created At</th>
                                <th class="text-right">Action</th>
                            </thead>
                            <tbody>
                                    <tr ng-repeat="task in myTasks | filter:{name: userSearch}">
                                        <td class="table-text"><div>[[ task.name ]]</div></td>
                                        <td class="table-text"><div>[[ task.created_at ]]</div></td>

                                        <!-- Task Delete Button -->
                                        <td class="text-right">
                                            <button type="submit" ng-click="editTask(task.id)" class="btn btn-success"><i class="fa fa-btn fa-pencil"></i>Edit</button>
                                            <button type="submit" task_name="[[task.name]]" id="delete_id_[[task.id]]" ng-click="deleteTask(task.id)" class="btn btn-danger"><i class="fa fa-btn fa-trash"></i>Delete</button>
                                            
                                        </td>
                                    </tr>
                                    <tr ng-if="myTasks.length == 0">
                                        <td colspan="3">No Data Found.</td>
                                    </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
        </div>

    <!-- Modal -->
    <div id="edit_modal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Task</h4>
          </div>
          <div class="modal-body">
            <input type="text" class="form-control" id="task_name_edit">
          </div>
          <div class="modal-footer">
            <a  class="btn btn-primary" ng-click="confirmEdit()">Edit</a>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
    </div>
@endsection
