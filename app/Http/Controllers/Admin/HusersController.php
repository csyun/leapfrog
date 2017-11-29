<?php

namespace App\Http\Controllers\Admin;


use App\Models\Home_User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * 在后台查看,修改,前台用户信息的控制器
 * @author [苏波] <386249656@qq.com>
 * @data 2017-11-28 21:00
 * 
 */

class HusersController extends Controller
{
	//前台用户列表页
    public function index()
    {		
    	//获取数据 Home_User 是与data_home_user关联的模型
		$data = Home_User::with('UserInfo')->get();
    	                   	 
     	return view ('Admin/HUsers/index',['data'=>$data]);
    }



}
