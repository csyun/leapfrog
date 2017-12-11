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



//前台首页路由
Route::get('/', 'Home\IndexController@index');
//前台文章路由
Route::get('/articles/{id}', 'Home\IndexController@ArticleShow');
//前台回收商品路由
Route::get('/recyclegoods','Home\RecycleController@index');




//前台登录页面
Route::get('/login','Home\LoginController@login');
Route::post('/dologin','Home\LoginController@dologin');


//前台注册
Route::get('/register','Home\RegisterController@register');
Route::post('/doregister','Home\RegisterController@doregister');
Route::post('/phoneregister','Home\RegisterController@phoneregister');
//====发送短信
Route::post('/sendcode','Home\RegisterController@sendCode');
//====验证邮箱ajax
Route::post('/register/ajax','Home\RegisterController@ajax');
//====验证手机ajax
Route::post('/register/phoneajax','Home\RegisterController@phoneajax');
//====邮箱验证
Route::get('/active','Home\RegisterController@active');


//忘记密码
Route::get('/forget','Home\PasswordController@forget');
//====发送忘记密码邮件
Route::post('/dopassword','Home\PasswordController@dopassword');
//====忘记手机
Route::post('/phonepassword','Home\PasswordController@phonepassword');
//====验证邮箱ajax
Route::post('/password/ajax','Home\PasswordController@ajax');
//====验证手机ajax
Route::post('/password/phoneajax','Home\PasswordController@phoneajax');
//====找回密码页面
Route::get('/reset','Home\PasswordController@reset');
//====重置密码
Route::post('/doreset','Home\PasswordController@doreset');






Route::group(['middleware'=>'homelogin','namespace'=>'Home'],function (){
    //蛙塘
    Route::resource('/pond','PondController');
    //图片上传
    Route::post('/pond/upload','PondController@upload');
    //进入蛙塘
    Route::get('/pondlist','PondController@pondlist');
    //收藏蛙塘
    Route::get('/collectpond','PondController@collectpond');
    //我收藏的蛙塘
    Route::get('/pondcollect','PondController@pondcollect');
    //取消收藏
    Route::get('/decollect','PondController@decollect');
    //我的蛙塘
    Route::get('/mypond','PondController@mypond');
});

Route::get('/home/goods/list','Home\GoodsController@index');



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


Route::group(['middleware'=>['islogin'],'prefix'=>'admin','namespace'=>'Admin'],function () {
    //后台首页
    Route::get('index', 'IndexController@index');
    //后台用户路由
    Route::resource('users', 'UsersController');
    Route::get('users/auth/{id}', 'UsersController@auth');
    Route::get('users/doauth/{id}', 'UsersController@doauth');
    //前台用户查询
    Route::get('husers/index', 'HusersController@index');
    //后台用户退出登录路由
    Route::get('loginout', 'LoginController@loginout');
    //角色路由增删改查
    Route::resource('role', 'RoleController');
    Route::post('role/ajax', 'RoleController@ajax');
    Route::get('role/auth/{id}', 'RoleController@auth');
    Route::get('role/doauth/{id}', 'RoleController@doauth');
    //权限路由增删改查
    Route::resource('permission', 'PermissionController');
    Route::post('permission/ajax', 'PermissionController@ajax');
    //文章管理路由
    Route::resource('articles', 'ArticlesController');
    //上传图片
    Route::post('upload', 'ArticlesController@upload');
    //文章列表排序控制器
    Route::post('articles/changeorder', 'ArticlesController@changeorder');


    //回收商品管理路由
    Route::resource('recyclegoods', 'RecycleGoodsController');
    //回收商品订单管理路由
    Route::resource('recycleorders', 'RecycleOrdersController');
    //推荐位管理路由
    Route::resource('recommend', 'RecommendController');
    //广告位管理路由
    Route::resource('adver', 'AdverController');
    Route::post('adver/changeorder', 'AdverController@changeorder');
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

    //首页轮播图管理
    Route::resource('slideshow', 'SlideShowController');
    //调整轮播图顺序路由
    Route::post('slideshow/changeorder', 'SlideShowController@changeorder');
    //分类管理控制器路由
    Route::resource('cate', 'CateController');
    //排序控制器
    Route::post('cate/changeorder', 'CateController@changeorder');


    //导航位管理路由
    Route::resource('nav', 'NavController');
    Route::post('nav/changeorder', 'NavController@changeorder');

    //等待审核蛙塘列表
    Route::get('pond','PondController@index');
    //通过审核的蛙塘列表
    Route::get('pond/passlist','PondController@passlist');
    //未通过审核的蛙塘列表
    Route::get('pond/notpasslist','PondController@notpasslist');         
    //蛙塘通过申请的ajax,pass
    Route::post('pond/pass','PondController@pass');
    //蛙塘没通过申请的ajax,pass
    Route::post('pond/notpass','PondController@notpass');
    //蛙塘等待审查的ajax,wait
    Route::post('pond/wait','PondController@wait');


});

    





