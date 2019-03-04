<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PagesController extends Controller
{
    public function __construct(){
        $this->middleware('guest',[
           'only' => ['login_create','login_store']
        ]);
    }

    public function index() {
        return view('pages.index');
    }

    public function login_create() {
        return view('pages.login');
    }

    public function login_store(LoginRequest $request) {
        $user = User::where('email',$request->email)->first();

        if ($user){
            $email = $request->input('email');
            $password = $request->input('password');

            if (Auth::attempt(['email' => $email, 'password' => $password], $request->has('remember'))){
                $fallback = route('index');
                return redirect()->intended($fallback)->with('success','欢迎回来'.$user->name);
            }else{
                Log::error('login|password_not_match',['userId' => $user->id]);
                return redirect()->back()->with('danger','邮箱与密码不匹配');
            }

        }else{
            return redirect()->back()->with('warning','用户不存在');
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('index')->with('success','成功登出');
    }
}
