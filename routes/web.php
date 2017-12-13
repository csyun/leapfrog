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
//前台回收商品估价页面
Route::get('/recyclegoods/show/{id}','Home\RecycleController@show');
//回收商品估价
Route::post('/recyclegoods/count/','Home\RecycleController@count');




//前台展示页
Route::get('/home/goods/list/{id}','Home\GoodsController@index');
//前台搜索
Route::post('/home/goods/seach','Home\GoodsController@seach');
//商品详情页
Route::get('/home/goods/details/{id}','Home\GoodsController@details');
//添加到购物车
Route::get('/home/shopcart/{id}','Home\shopcartController@tocart');

Route::get('/test','Home\shopcartController@test');
//购物车列表
Route::get('/home/shopcart/cart/index','Home\shopcartController@index');
//支付页
Route::get('/home/shopcart/cart/pay','Home\shopcartController@pay');
//购物车删除
Route::post('/home/shopcart/cart/del/{id}','Home\shopcartController@cartDel');
//添加订单
Route::post('/home/order/doadd','Home\OrderController@doadd');

//前台添加商品
Route::get('/home/goods/add','Home\GoodsController@add');
//商品执行添加
Route::post('/home/goods/doadd','Home\GoodsController@doadd');
//商品浏览
Route::get('/home/goods/browse','Home\GoodsController@browse');
//前台编辑商品
Route::get('/home/goods/edit/{id}','Home\GoodsController@edit');
//执行修改
Route::post('home/goods/doedit/{id}','Home\GoodsController@doedit');






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





//前台个人中心
//Route::resource('/myself', 'MyselfController');

Route::group(['middleware'=>'homelogin','namespace'=>'Home'],function (){
    //前台退出登录
    Route::get('/loginout','LoginController@loginout');


    //蛙塘
    Route::resource('/pond','PondController');
    //图片上传

    //Route::post('/pond/upload','PondController@upload');
    //进入蛙塘详情

    Route::get('/pondlist','PondController@pondlist');
    //收藏蛙塘
    Route::get('/collectpond','PondController@collectpond');
    //我收藏的蛙塘
    Route::get('/pondcollect','PondController@pondcollect');
    //取消收藏
    Route::get('/decollect','PondController@decollect');
    //我的蛙塘
    Route::get('/mypond','PondController@mypond');

    //估价路由
    Route::get('/recyclegoods/order/','RecycleController@recycleorder');
    Route::post('/recyclegoods/recyclecommit/','RecycleController@recyclecommit');
    //前台个人中心首页
    Route::get('/userinfo','UserInfoController@index');
    //前台个人中心首页
    Route::get('/userinfo/information','UserInfoController@information');
    //修改个人信息
    Route::post('/userinfo/addinformation','UserInfoController@infoadd');
    //个人中心地址管理
    Route::resource('/userinfo/addr','UserInfoAddrController');
    //前台个人中心回收订单
    Route::get('/userinfo/recycleorder','UserInfoController@recycleorder');

    //蛙塘评论
    Route::get('/comment','PondController@comment'); 
    //发表评论
    Route::get('/commentlist','PondController@commentlist');
    //提交评论
    Route::post('/commentstore','PondController@commentstore');

});




//后台管理员登录页面路由
Route::get('/admin/login','Admin\LoginController@login');
//获取验证码路由
Route::get('/getcode','Api\CodeController@code');
//上传阿里云图片路由
//上传图片
Route::post('/upload', 'Api\UploadController@upload');
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

    //文章列表排序控制器
    Route::post('articles/changeorder', 'ArticlesController@changeorder');


    //回收商品管理路由
    Route::resource('recyclegoods', 'RecycleGoodsController');
    //回收商品修改类型属性管理路由
    Route::post('recyclegoods/getTypes', 'RecycleGoodsController@getTypes');
    //回收商品类型管理路由
    Route::resource('recyclegoodtype', 'RecycleGoodTypeController');
    //回收商品属性管理路由
    Route::resource('recyclegoodattribute', 'RecycleGoodAttributeController');
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
    //商品细节控制器
    Route::get('goods/detailsimg/{id}','GoodsController@detailsimg');
    //商品状态控制器
    Route::get('goods/gstatus/{id}','GoodsController@gstatus');
    //订单控制器
    Route::get('order/index','OrderController@index');
    Route::get('order/details/{id}','OrderController@details');

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

    //网站配置路由
    Route::resource('config','ConfigController');
    //排序控制路由
    Route::post('config/changeorder','configController@changeorder');
    //批量修改网站配置路由
    Route::post('config/contentchange','configController@contentchange');
    //同步网站配置表中的内容到webconfig配置文件中
    Route::get('config/putfile','configController@PutFile');
    //意见反馈路由
    Route::post('idea/abc','IdeaController@abc');
    Route::resource('idea','IdeaController');
    //友情链接路由
    Route::resource('link', 'LinkController');
    Route::post('link/changeorder', 'linkController@changeorder');


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

    





