<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleAddRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use function MongoDB\BSON\toJSON;
use MongoDB\BSON\UTCDateTime;
use Monolog\Handler\Mongo;

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

    public function role($option = Role::UNKNOWN ){
        switch ($option){
            case Role::UNKNOWN:
                $roles = Role::with('user')->paginate(5);
                break;
            case Role::MANAGERS:
                $roles = Role::where('role',Role::MANAGERS)->with('user')->paginate(5);
                break;
            case Role::TEACHERS:
                $roles = Role::where('role',Role::TEACHERS)->with('user')->paginate(5);
                break;
            case Role::STUDENTS:
                $roles = Role::where('role',Role::STUDENTS)->with('user')->paginate(5);
                break;
        }
        return view('managers.roleList',compact('roles'));
    }

    public function delete(Role $role){
        $this->authorize('user_destroy', $role->user);
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

    public function test(){
//        $message =  DB::connection('mongodb')->collection('infosys')
//            ->get()->toArray();
//        return response()->json($message);

        $time = new UTCDateTime();
        $utc_time = json_decode($time);
        $local_time = $utc_time+1000*60*60*8;
        $local = new UTCDateTime($local_time);
        $arr = ['from_id'=> 1,'to_id'=> 4,'create_time'=> $time];
        DB::connection('mongodb')->collection('infosys')
            ->insert($arr);
        //$time = Date('Y-m-d H:i:s',time());


    }

    public function phpinfo(){
        phpinfo();
    }
}
