<?php

namespace App\Observers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserObserver
{

    public function created(User $user)
    {
        $userId = $user->id;
        if (!Role::create(['user_id' => $userId])){
            $user->delete();
            Log::error('user|create_role_failed',['data' => $user]);
            session()->flash('danger','系统错误，请联系管理员');
        }
    }

    public function deleted(User $user)
    {
        $userId = $user->id;
        if (!Role::where('user_id',$userId)->delete()){
            Log::error('role|delete_role_failed',['user' => $user]);
            session()->flash('danger','系统错误，请联系管理员');
        }
    }

}
