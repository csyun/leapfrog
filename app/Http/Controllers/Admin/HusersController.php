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
  public function index(Request $request)
    {

        
        $data = Home_User::with('UserInfo')->orderBy('uid','asc')
            ->where(function($query) use($request){
                //检测关键字
                $uname = $request->input('key');
                //权限
                $auth = $request->input('auth');

                //如果权限为1,或2
                if($auth == 1){
                    $query->where('auth',1);
                }elseif($auth == 2)
                {
                    $query->where('auth',2);
                }
                
                //如果用户名不为空
                if(!empty($uname)) {
                    $query->where('uname','like','%'.$uname.'%');
                }
            })
            ->paginate(2);

            // dd($data);

        return view('Admin/Husers/index',compact('data','request'));

        
    }



}
