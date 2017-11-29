<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
    	return view('Admin/Index/index');
    }
}
