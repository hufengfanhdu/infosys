<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckTeacher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        $roles = Role::get_roles($user);
        if (in_array(Role::TEACHERS, $roles)){
            return $next($request);
        }else{
            Log::error('teacher|permission_denied',['user' => $user]);
            return redirect()->back()->with('danger','请不要越权操作');
        }

    }
}
