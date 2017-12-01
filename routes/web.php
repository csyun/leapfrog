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

//Route::get('/admin/cate/create','Admin\CateController');

Route::resource('admin/cate','Admin\CateController');
Route::post('admin/cate/changeorder','Admin\CateController@changeorder');
Route::resource('goods','Admin\GoodsController');

Route::get('/admin/ceshi', function () {
    return view('Admin\head');
});