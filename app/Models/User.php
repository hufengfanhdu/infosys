<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password','introduction'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //角色
    public function roles(){
        return $this->hasMany(Role::class);
    }

    //学生
    public function students(){
        return $this->belongsToMany(User::class,'teachers','user_id','teacher_id');
    }

    //教师
    public function teachers(){
        return $this->belongsToMany(User::class,'teachers','teacher_id','user_id');
    }

    //教师绑定学生
    public function teach($userIds){
        if ( !is_array($userIds) ){
            $userIds = compact('userIds');
        }
        $this->students()->sync($userIds,false);
    }

    //教师解绑学生
    public function unfollow($userIds){
        if ( !is_array($userIds) ){
            $userIds = compact('userIds');
        }
        $this->students()->detach($userIds);
    }
}
