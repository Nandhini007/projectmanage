<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use App\DataTables\ProjectDataTable;
use App\DataTables\TaskDataTable;
use App\Models\User;
use Auth;
use Validator;

class UserController extends Controller
{
    public function index(UsersDataTable $dataTable)
    {
        if(Auth::user()->user_type == 'Admin') {
            return $dataTable->render('user.view');
        } else if(Auth::user()->user_type == 'Project Manager') {
            $data = new ProjectDataTable;
            return $data->render('project.view');
        } else {
            $data = new TaskDataTable;
            return $data->render('task.view');
        }

    }
    
    public function add_user(Request $request)
    {
        if(!$_POST) {
            return view('user.add');
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',                
                'status' => 'required',
                'user_type' => 'required'
            ]);
    
            if($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
    
            $user = new User;
            $user->name = $request->name;        
            $user->status = $request->status;
            $user->email = $request->email;
            $user->user_type = $request->user_type;
            $user->password = bcrypt($request->password);
            $user->save();
    
            return redirect('home')->with('success', 'User added successfully');            
        }
    }

    public function delete(Request $request) {
        User::find($request->id)->delete();
        return redirect('home')->with('success', 'User deleted successfully');
    }

    public function edit(Request $request) {
        if(!$_POST) {
            $data['result'] = User::find($request->id);
            return view('user/edit', $data);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,'.$request->id,
                'status' => 'required',
                'user_type' => 'required'
            ]);
    
            if($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }

            $user = User::find($request->id);
            $user->name = $request->name;        
            $user->status = $request->status;
            $user->email = $request->email;
            $user->user_type = $request->user_type;            
            if($request->password) {
                $user->password = bcrypt($request->password);
            }
            $user->save();

            return redirect('/home')->with('success', 'User updated successfully');           
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }
}
