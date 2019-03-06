<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Mail\ValidateEmail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PagesController extends Controller
{
    public function __construct(){
        $this->middleware('guest',[
           'only' => ['login_create','login_store','send_email','confirm_email']
        ]);
        $this->middleware('throttle:5,1')->only('send_email');
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
                if ($user->active){
                    $fallback = route('index');
                    return redirect()->intended($fallback)->with('success','欢迎回来'.$user->name);
                }else{
                    Auth::logout();
                    session()->flash('warning','您的账号尚未认证，请前往邮箱认证');
                    return view('users.email_validate')->with('user',$user);
                }
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

    public function send_email(User $user){
        $token = $user->activation_token;
        Mail::to($user)->send(new ValidateEmail($token));
    }

    public function confirm_email($token){
        $user = User::where('activation_token',$token)->firstOrFail();

        $user->active = true;
        $user->activation_token = null;
        $user->save();

        Auth::login($user);
        return redirect()->route('users.show',[$user])->with('success','账号激活成功');
    }
}
