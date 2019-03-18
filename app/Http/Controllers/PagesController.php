<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Mail\ValidateEmail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class PagesController extends Controller
{
    public function __construct(){
        $this->middleware('guest',[
           'only' => ['login_create','login_store','send_email','confirm_email']
        ]);
        $this->middleware('throttle:5,1')->only('send_email');
        $this->middleware('throttle:3,10')->only('login_store');
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

    //github登入
    public function redirectToGitHub()
    {
        return Socialite::driver('github')->redirect();
    }
    //处理github callback
    public function handleGitHubCallback()
    {
        $user = Socialite::driver('github')->user();    //obj

        $find = User::where('github_id', $user->id)->first();
        if (!$find) {
            $data = User::create([
            'name' => $user->name,
            'email' => $user->email,
            ]);
            $data->provider = User::PROVIDER_GITHUB;
            $data->github_id = $user->id;
            $data->avatar = $user->avatar;
            $data->save();

            $find = $data;
        }

        Auth::login($find);
        return redirect()->route('index');
    }

    //Weixin登入
    public function redirectToWeiXin()
    {
        return Socialite::driver('weixin')->redirect();
    }
    //处理 微信 callback
    public function handleWeiXinCallback()
    {
        $user = Socialite::driver('weixin')->user();
        $user = $user->user;    //arr
        $find = User::where('openid',$user['openid'])->first();
        if (!$find){
            $data = User::create([
               'name' => $user['nickname'],
                'activation_token' => str_random(30)
            ]);
            $data->provider = User::PROVIDER_WEIXIN;
            $data->openid = $user['openid'];
            $data->avatar = $user['headimgurl'];
            $data->save();

            $find = $data;
        }

        Auth::login($find);
        if (!$find->email){
            session()->flash('warning','请绑定邮箱以保证我们为您提供更好的服务');
        }
        return redirect()->route('index');
    }

    //QQ登入
    public function redirectToQQ(){
        return Socialite::driver('qq')->redirect();
    }
    //处理 QQ callback
    public function handleQQCallback(){
        $user = Socialite::driver('qq')->user();
        var_dump($user->nickname);
    }

    //登出
    public function logout() {
        Auth::logout();
        return redirect()->route('index')->with('success','成功登出');
    }

    //绑定邮箱
    public function email_bind(){
        return view('users.email_bind');
    }

    public function email_store(){
        $validate = Validator::make(\request()->all(),
            ['email' => 'email|unique:users,email']);
        if ($validate->fails()){
            return redirect()->back()->withErrors($validate);
        }else{
            $user = Auth::user();
            $user->email = \request()->input('email');
            $user->save();

            $status = $this->send_email($user);
            dd($status);
        }

    }

    //发送邮箱验证
    public function send_email(User $user){
        $token = $user->activation_token;
        Mail::to($user)->send(new ValidateEmail($token));
    }

    //验证邮箱
    public function confirm_email($token){
        $user = User::where('activation_token',$token)->firstOrFail();

        $user->active = true;
        $user->activation_token = null;
        $user->save();

        Auth::login($user);
        return redirect()->route('users.show',[$user])->with('success','账号激活成功');
    }
}
