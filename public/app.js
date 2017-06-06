var app = {};
app.host = "http://localhost/tasks_soding/mytasks/";

myApp = angular.module('myApp', [], function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
});

angular.module('myApp').controller('TasksController', function($scope, $http, $window){
		$scope.deleteTask = function(task_id){
				var name = $('#delete_id_'+task_id).attr('task_name')
				$http.get(app.host + 'deleteTask/'+task_id).then(function(response){
					if(response.data == 1)
					{
						alert('Task =='+name+'== has been deleted.')
					}
		            window.location.href = app.host + 'tasks/list';
		        })
        };

        $scope.loadTasks = function(){
        	$http.get(app.host + 'getTasks').then(function(response){
					$scope.myTasks = response.data.tasks;
		        })
        }

        $scope.editTask = function(task_id){
				var name = $('#delete_id_'+task_id).attr('task_name');
				$scope.edited_task = task_id;
				$('#task_name_edit').val(name);
				$('#edit_modal').modal('toggle');
        };

        $scope.confirmEdit = function(){
        	
			var name = $('#task_name_edit').val();
        	var data = $.param({
	            task_id: $scope.edited_task,
	            task_name: name
	        });
	        var config = {
	            headers : {
	                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
	            }
	        };
	        $http.post(app.host + 'editTask', data, config).then(function (result, status) {
				$('#edit_modal').modal('toggle');
	            alert('Task has been updated successfully.');
		        window.location.href = app.host + 'tasks/list';

	        });
        };
});