<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UsersController extends Controller
{
    public function __construct(){
        $this->middleware('auth',['except' => ['show','create','store']]);
        $this->middleware('manager',['only' => ['destroy']]);
    }

    //注册
    public function create()
    {
        return view('users.create');
    }

    //注册
    public function store(UsersRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'activation_token' => str_random(30)
        ]);

        return redirect()->route('login')->with('success',"注册成功！");
    }

    //个人中心
    public function show(User $user)
    {
        return view('users.show',compact('user'));
    }

    //用户编辑
    public function edit(User $user)
    {
        $this->authorize('update',$user);
        return view('users.edit',compact('user'));
    }

    //更新
    public function update(UserUpdateRequest $request, User $user)
    {
        $this->authorize('update',$user);
        if ($user->update($request->all())){
            return redirect()->route('users.show',compact('user'))->with('success','更新成功');
        }else{
            Log::error('user|update_failed',['request' => $request->all()]);
            return redirect()->back()->with('danger','系统出错,更新失败');
        }
    }

    //删除
    public function destroy(User $user)
    {
        $this->authorize('user_destroy',$user);
        $user->delete();
        return redirect()->back()->with('success','删除操作成功');
    }

    public function index(){
        $users = User::paginate(8);
        return view('users.index',compact('users'));
    }

    public function chat(User $user){
        return view('users.chat',compact('user'));
    }

}
