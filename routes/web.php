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

Route::get('/', 'PagesController@index')->name('index');
Route::get('/login','PagesController@login_create')->name('login');
Route::post('/login','PagesController@login_store')->name('login');
Route::get('/logout','PagesController@logout')->name('logout');

Route::resource('users','UsersController')->except('index');
//Route::get('/users/create', 'UsersController@create')->name('users.create');
//Route::get('/users/{user}', 'UsersController@show')->name('users.show');
//Route::post('/users', 'UsersController@store')->name('users.store');
//Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');
//Route::patch('/users/{user}', 'UsersController@update')->name('users.update');
//Route::delete('/users/{user}', 'UsersController@destroy')->name('users.destroy');

Route::get('/managers','ManagersController@index')->name('managers.index');
Route::get('/managers/role','ManagersController@role')->name('managers.role');
Route::delete('/managers/{role}','ManagersController@delete')->name('managers.destroy');
Route::get('/managers/create','ManagersController@create')->name('managers.create');
Route::post('/managers','ManagersController@store')->name('managers.store');