<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\TaskDataTable;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use Validator;

class TaskController extends Controller
{
    public function view_task(TaskDataTable $dataTable)
    {
        return $dataTable->render('task.view');
    }

    public function add_task(Request $request) {
        if(!$_POST) {
            $data['user'] = User::whereStatus('Active')->pluck('name', 'id');
            $data['project'] = Project::pluck('name', 'id');            
            return view('task.add', $data);
        } else {
            $validator = Validator::make($request->all(), [
                'team' => 'required',
                'project' => 'required',
                'end_date' => 'required',
            ]);
    
            if($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }

            $task = new Task;
            $task->user_id = $request->team;        
            $task->project_id = $request->project;
            $task->end_date = $request->end_date;
            $task->save();
    
            return redirect('view_task')->with('success', 'Task added successfully');            
        }
    }

    public function delete(Request $request) {
        Task::find($request->id)->delete();
        return redirect('view_task')->with('success', 'Task deleted successfully');
    }

    public function edit(Request $request) {
        if(!$_POST) {
            $data['project'] = Project::pluck('name', 'id');
            $data['user'] = User::whereStatus('Active')->pluck('name', 'id');
            $data['result'] = Task::find($request->id);
            return view('task.edit', $data);
        } else {
            $validator = Validator::make($request->all(), [
                'team' => 'required',
                'project' => 'required',
                'end_date' => 'required',
            ]);
    
            if($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }

            $task = Task::find($request->id);
            $task->user_id = $request->team;        
            $task->project_id = $request->project;
            $task->end_date = $request->end_date;
            $task->save();
    
            return redirect('view_task')->with('success', 'Task updated successfully');          
        }
    }

    public function update_task_status(Request $request) {
        $task = Task::find($request->task_id);
        $task->task_status = $request->is_completed;
        $task->save();

        \Session::flash('success', 'Task status updated successfully');
        return response()->json(['message' => 'Task status updated']);
    }
}