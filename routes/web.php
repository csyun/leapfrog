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

Route::get('/', function () {
    return view('welcome');
});

//后台管理员登录页面路由
Route::get('/admin/login','Admin\LoginController@login');

//获取验证码路由
Route::get('/getcode','Admin\LoginController@code');
//后台处理登录逻辑
Route::post('/admin/dologin','Admin\LoginController@doLogin');

Route::get('/admin/ceshi', function () {

    return view('Admin\head');
});





//后台首页
Route::get('/admin/index','Admin\IndexController@index');



Route::group(['middleware'=>'islogin','prefix'=>'admin','namespace'=>'Admin'],function (){

//后台用户路由组
Route::resource('users','UsersController');
//前台用户查询
Route::get('husers/index','HusersController@index');

});
