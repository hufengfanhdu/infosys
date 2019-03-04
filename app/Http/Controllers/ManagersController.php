<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleAddRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ManagersController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('manager');
    }

    public function index(){
        $users = User::with('roles')->paginate(5);
        return view('managers.userList',compact('users'));
    }

    public function role(){
        $roles = Role::with('user')->paginate(5);
        return view('managers.roleList',compact('roles'));
    }

    public function delete(Role $role){
        $this->authorize('destroy', $role->user);
        $role->delete();
        return redirect()->back()->with('success','角色删除成功');
    }

    public function create(){
        return view('managers.roleCreate');
    }

    public function store(RoleAddRequest $request){
        $role = $request->input('select');
        $userId = $request->input('id');
        $validate = Auth::validate(['id'=>Auth::id(),'password'=>$request->input('password')]);
        if ($validate){
            Role::create(['user_id' => $userId, 'role' => $role]);
            return redirect()->back()->with('success','角色添加成功');
        }else{
            Log::notice('manager|add_role_failed',['user' => Auth::user()]);
            return redirect()->back()->with('danger','密码错误')->withInput();
        }

    }
}
