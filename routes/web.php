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

Route::get('/','Home\IndexController@index');
//前台商品展示页
Route::get('/home/goods/list','Home\GoodsController@index');

//后台管理员登录页面路由
Route::get('/admin/login','Admin\LoginController@login');

//获取验证码路由
Route::get('/getcode','Admin\LoginController@code');
//后台处理登录逻辑
Route::post('/admin/dologin','Admin\LoginController@doLogin');


//后台首页
Route::get('/admin/index','Admin\IndexController@index');

Route::group(['middleware'=>'islogin','prefix'=>'admin','namespace'=>'Admin'],function (){
//后台用户路由组
Route::resource('users','UsersController');
//前台用户查询
Route::get('husers/index','HusersController@index');
//后台用户退出登录路由
Route::get('loginout','LoginController@loginout');
//文章管理路由
Route::resource('articles','ArticlesController');
//商品标签管理路由
Route::resource('goodtags','GoodTagsController');
//商品标签类型管理路由
Route::resource('goodtagtype','GoodTagTypeController');
//分类管理控制器路由
Route::resource('cate','CateController');
//商品控制器
Route::resource('goods','GoodsController');
//排序控制器
Route::post('cate/changeorder','CateController@changeorder');
//商品图片控制器
Route::post('upload','GoodsController@upload');
//商品状态控制器
Route::get('goods/gstatus/{id}','GoodsController@gstatus');

});





