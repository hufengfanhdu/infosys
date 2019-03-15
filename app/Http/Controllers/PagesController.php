<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Mail\ValidateEmail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
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
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    //处理callback
    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->user();    //obj

        $find = User::where('email', $user->email)->first();
        if (!$find) {
            $data = User::create([
            'name' => $user->name,
            'email' => $user->email
            ]);
            $data->provider = "github";
            $data->provider_id = $user->id;
            $data->avatar = $user->avatar;
            $data->save();
            Auth::login($data);
        }else{
            Auth::login($find);
        }

        return redirect()->route('index');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('index')->with('success','成功登出');
    }

    public function send_email(User $user){
        $token = $user->activation_token;
        Mail::to($user)->send(new ValidateEmail($token));
        return response('邮件已经发送',200);
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
