<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleAddRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TeachersController extends Controller
{
    public function __construct(){
        $this->middleware('teacher');
    }

    //学生列表
    public function index(){
        $userId = Auth::id();
        $user = User::where('id',$userId)->first();
        $studentsId = $user->students->pluck('id')->all();

        $students = User::whereIn('id',$studentsId)->paginate(5);
        return view('teachers.index',compact('students'));
    }

    //添加学生
    public function create(){
        return view('teachers.create');
    }

    public function store(RoleAddRequest $request){
        $studentId = $request->input('id');
        $password = $request->input('password');
        $userId = Auth::id();
        $target = User::where('id',$studentId)->first();

        //判断对象是否为自己或者教师
        if ($userId == $studentId || Role::is_teacher($target)){
            return redirect()->back()->with('danger','您没有对此对象操作的权限');
        }

        $validate = Auth::validate(['id' => $userId, 'password' => $password]);
        if ($validate){
            //如果对象不是学生，则给予学生角色
            if (! Role::is_student($target) ){
                Role::create(['user_id' => $studentId, 'role' => Role::STUDENTS]);
            }

            Auth::user()->teach($studentId);
            return redirect()->back()->with('success','添加成功');
        }else{
            Log::notice('manager|add_role_failed',['user' => Auth::user()]);
            return redirect()->back()->with('danger','密码错误');
        }
    }

    //移除学生
    public function destroy($id){
        if (Auth::user()->unTeach($id)){
            return redirect()->back()->with('success','学生已被移除');
        }else{
            return redirect()->back()->with('danger','系统错误，请联系管理员');
        }
    }
}
