<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const UNKNOWN  = 0;
    const STUDENTS = 1;
    const TEACHERS = 2;
    const MANAGERS = 3;

    public function user(){
        return $this->belongsTo(User::class);
    }

    protected $fillable = ['user_id','role'];

    //显示用户角色
    public static function show_roles($roles){
        $arr = [
            self::UNKNOWN  => '用户',
            self::STUDENTS => '学生',
            self::TEACHERS => '教师',
            self::MANAGERS => '管理员'
        ];

        return key_exists($roles,$arr) ? $arr[$roles] : $arr[self::UNKNOWN];
    }

    //获得用户的所有角色
    public static function get_roles(User $user){
        $arr = $user->roles->all();
        return array_column($arr,'role');
    }

    public static function is_teacher(User $user){
        $roles = self::get_roles($user);
        return in_array(self::TEACHERS,$roles)? true : false;
    }

    public static function is_manager(User $user){
        $roles = self::get_roles($user);
        return in_array(self::MANAGERS,$roles)? true : false;
    }

}
