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
    return view('Home\index');
});

//后台管理员登录页面路由
Route::get('/admin/login','Admin\LoginController@login');

//获取验证码路由
Route::get('/getcode','Admin\LoginController@code');
//后台处理登录逻辑
Route::post('/admin/dologin','Admin\LoginController@doLogin');
Route::get('/admin/loginout','Admin\LoginController@loginout');
//文章管理路由
Route::resource('/admin/articles','Admin\ArticlesController');





//后台首页
Route::get('/admin/index','Admin\IndexController@index');
//用户添加
Route::get('/admin/users/add','Admin\UsersController@add');
//用户插入
Route::post('/admin/users/insert','Admin\UsersController@insert');

//用户查看
Route::get('/admin/users/index','Admin\UsersController@index');
//用户修改
Route::get('/admin/users/edit/{id}','Admin\UsersController@edit');
//用户更新
Route::post('/admin/users/update/{id}','Admin\UsersController@update');
//用户删除
Route::get('/admin/users/delete/{id}','Admin\UsersController@delete');


//前台用户查询
Route::get('/admin/husers/index',"Admin\HusersController@index");
//前台用户禁言
// Route::get('/admin/husers/edit',"Admin\HusersController@edit");