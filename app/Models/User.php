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


    //教师的学生
    public function students(){
        return $this->belongsToMany(User::class,'teachers','teacher_id','user_id');
    }

    //学生的教师
    public function teachers(){
        return $this->belongsToMany(User::class,'teachers','user_id','teacher_id');
    }

    //教师绑定学生
    public function teach($userId){
        if ( !is_array($userId) ){
            $userId = compact('userId');
        }
        $this->students()->sync($userId,false);
    }

    //教师解绑学生
    public function unTeach($userId){
        if ( !is_array($userId) ){
            $userId = compact('userId');
        }
        $this->students()->detach($userId);
    }
}
