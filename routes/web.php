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

//前台首页
Route::get('/', function () {
    return view('Home\index');
});

//前台登录页面
Route::get('/login','Home\LoginController@login');
Route::post('/dologin','Home\LoginController@dologin');

//前台注册
Route::get('/register','Home\RegisterController@register');
Route::post('/doregister','Home\RegisterController@doregister');
Route::post('/register/ajax','Home\RegisterController@ajax');


Route::group(['middleware'=>'homelogin','namespace'=>'Home'],function (){
//蛙塘
Route::resource('/pond','PondController');
//图片上传
Route::post('/pond/upload','PondController@upload');
});


//后台管理员登录页面路由
Route::get('/admin/login','Admin\LoginController@login');
//获取验证码路由
Route::get('/getcode','Admin\LoginController@code');
//后台处理登录逻辑
Route::post('/admin/dologin','Admin\LoginController@doLogin');
//没有权限跳转的页面
Route::get('/errors/auth',function(){
	return view('Admin\errors');
});






Route::group(['middleware'=>['islogin'],'prefix'=>'admin','namespace'=>'Admin'],function (){
//后台首页
Route::get('index','IndexController@index');
//后台用户路由
Route::resource('users','UsersController');
Route::get('users/auth/{id}','UsersController@auth');
Route::get('users/doauth/{id}','UsersController@doauth');
//前台用户查询
Route::get('husers/index','HusersController@index');
//后台用户退出登录路由
Route::get('loginout','LoginController@loginout');
//文章管理路由
Route::resource('articles','ArticlesController');

//角色路由增删改查
Route::resource('role','RoleController');
Route::post('role/ajax','RoleController@ajax');
Route::get('role/auth/{id}','RoleController@auth');
Route::get('role/doauth/{id}','RoleController@doauth');
//权限路由增删改查
Route::resource('permission','PermissionController');
Route::post('permission/ajax','PermissionController@ajax');

});
