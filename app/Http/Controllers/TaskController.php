<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Task;
use App\Repositories\TaskRepository;

class TaskController extends Controller
{
    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');

        $this->tasks = $tasks;
    }

    public function index(Request $request)
    {
        return view('tasks.index');
    }

    public function getTasks()
    {
        return view('tasks.list');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $request->user()->tasks()->create([
            'name' => $request->name,
        ]);

        return redirect('/tasks/list')->with('msg', 'Task has been created successfully.');
    }

    public function deleteTask($id)
    {
        if(DB::table('tasks')->where('id', $id)->delete())
            return 1;
        else
            return -1;
    }

    public function editTask(Request $request)
    {
        DB::table('tasks')->where('id', $request->task_id)->update([
                'name' => $request->task_name
            ]);
    }

    public function getTaskList(Request $request)
    {
        $data['tasks'] = DB::table('tasks')->where('user_id', Auth::user()->id)->get();
        return $data;
    }

    public function destroy(Request $request, Task $task)
    {
        $this->authorize('destroy', $task);

        $task->delete();

        return redirect('/tasks');
    }
}
