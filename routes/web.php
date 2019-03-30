<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

//登入操作
Route::get('/', 'PagesController@index')->name('index');
Route::get('/login','PagesController@login_create')->name('login');
Route::post('/login','PagesController@login_store')->name('login');
Route::get('/logout','PagesController@logout')->name('logout');
Route::get('/email','PagesController@email_bind')->name('email_bind');
Route::post('/email','PagesController@email_store')->name('email_store');
Route::post('/validate/{user}','PagesController@send_email')->name('validate_email');
Route::get('/confirm/{token}','PagesController@confirm_email')->name('confirm_email');
//github登入
Route::get('login/github', 'PagesController@redirectToGitHub')->name('login_github');
Route::get('auth/github/callback', 'PagesController@handleGitHubCallback');
//微信登入
Route::get('login/weixin', 'PagesController@redirectToWeiXin')->name('login_weixin');
Route::get('auth/weixin/callback', 'PagesController@handleWeiXinCallback');
//QQ登入
Route::get('login/qq', 'PagesController@redirectToQQ')->name('login_qq');
Route::get('auth/qq/callback', 'PagesController@handleQQCallback');

//用户
Route::resource('users','UsersController');
//Route::get('/users', 'UsersController@index')->name('users.index');
//Route::get('/users/create', 'UsersController@create')->name('users.create');
//Route::get('/users/{user}', 'UsersController@show')->name('users.show');
//Route::post('/users', 'UsersController@store')->name('users.store');
//Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');
//Route::patch('/users/{user}', 'UsersController@update')->name('users.update');
//Route::delete('/users/{user}', 'UsersController@destroy')->name('users.destroy');

//聊天
Route::any('/chat/{user}', 'UsersController@chat')->name('users.chat');

//管理员操作
Route::get('/managers','ManagersController@index')->name('managers.index');
Route::get('/managers/role/{option?}','ManagersController@role')->name('managers.role');
Route::delete('/managers/{role}','ManagersController@delete')->name('managers.destroy');
Route::get('/managers/create','ManagersController@create')->name('managers.create');
Route::post('/managers','ManagersController@store')->name('managers.store');

//教师操作
Route::get('/teachers','TeachersController@index')->name('teachers.index');
Route::get('/teachers/create','TeachersController@create')->name('teachers.create');
Route::post('/teachers','TeachersController@store')->name('teachers.store');
Route::delete('/teachers/{student}','TeachersController@destroy')->name('teachers.destroy');

//ip接口
Route::get('/ip',function (\Illuminate\Http\Request $request){

});
