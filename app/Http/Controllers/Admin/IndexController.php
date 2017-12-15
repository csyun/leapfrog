<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin_User;
use App\Models\Home_User;
use App\Models\Admin_Goods;


/**
 *后台首页控制器
 * @author [苏波] <386249656@qq.com>
 * @data 2017-11-28 10:00
 * 
 */

class IndexController extends Controller
{


	//跳转后台首页
    public function index()
    {	
    	//现有注册人数
		$user1 = Home_User::get();
		
    	//后台用户人数
		$user = Admin_User::get();

		//在售商品数量
		$goods = Admin_Goods::where('status',0)->get();
		$good = count($goods);
		// dd($good);
		
    	return view('Admin/Index/index',compact('user','user1','good'));
    }
}
