<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\DataTables\ProjectManagerDataTable;
use Validator;

class ProjectController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(ProjectManagerDataTable $dataTable)
    {
        return $dataTable->render('project.view');
    }

    public function add_project(Request $request)
    {
        if(!$_POST) {
            $result = User::whereStatus('Active')->pluck('name', 'id');
            return view('project.add', ['result' => $result]);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'description' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
            ]);
    
            if($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }

            $project = new Project;
            $project->name = $request->name;        
            $project->description = $request->description;
            $project->start_date = $request->start_date;        
            $project->end_date = $request->end_date;
            $project->save();
    
            return redirect('view_project')->with('success', 'Project added successfully');            
        }
    }

    public function delete(Request $request) {
        Project::find($request->id)->delete();
        return redirect('view_project')->with('success', 'Project deleted successfully');
    }

    public function edit(Request $request) {
        if(!$_POST) {
            $data['result'] = Project::find($request->id);
            $data['user'] = User::whereStatus('Active')->pluck('name', 'id');
            return view('project/edit', $data);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'description' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
            ]);

            if($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            $project = Project::find($request->id);
            $project->name = $request->name;        
            $project->description = $request->description;
            $project->start_date = $request->start_date;        
            $project->end_date = $request->end_date;
            $project->save();

            return redirect('view_project')->with('success', 'Project updated successfully');           
        }
    }
    
    public function view_task(ProjectManagerDataTable $dataTable)
    {
        return $dataTable->render('task.view');
    }
}