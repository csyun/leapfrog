<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin_User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 *后台用户控制器 增删改查
 * @author [苏波] <386249656@qq.com>
 * @data 2017-11-27 10:00
 * 
 */

class UsersController extends Controller
{   

    //用户添加页
    public function add()
    {
    	return view('Admin/Users/add');
    }

    //执行添加操作
    public function insert(Request $request)
    {

        //表单验证
    	$this->validate($request,[
    		'uname'=>'required|min:2|max:18',
    		'password'=>'required',
    		'rpassword'=>'same:password',
    		
    	],[
    		'uname.required'=>'用户名不能为空',
    		'uname.min'=>'用户名最小2个字符',
    		'uname.max'=>'用户名最大18个字符',
    		'password.required'=>'密码不能为空',
    		'rpassword.same'=>'两次密码不一致',
    	]);


        //获取模板传来的数据,去除-token,rpassword 
    	$data = $request->except('_token','rpassword');
  
    	
    	//密码加密
    	$data['password'] = encrypt($data['password']);

        //时间,默认刚注册时就是用户当前最后登录时间
    	$time = time();
    	$data['last_login_time'] = $time;

  

        //Admin_User与后台用户表data_admin_user关联的模型
        //数据上传给数据库
        $user = new Admin_User();
		$res = $user->create($data);

        //判断
		if($res)
		{
			return redirect('/admin/users/index');
		}else{
			return back();
		}
	

    }


    //用户列表页
    public function index()
    {
        ////Admin_User与后台用户表data_admin_user关联的模型
        //获取后台用户表的数据
        $user = new Admin_User();
    	$data = $user->all();
        
        
    	//跳转到列表模板并把数据传过去
    	return view ('Admin/Users/index',['data'=>$data]);
    }

    //用户修改页
    public function edit($id)
    {
        //根据穿过来的id查找该用户信息
        $user = new Admin_User();
        $data = $user->find($id);
        

        return view ('Admin/Users/edit',['data'=>$data]);

    }

    //用户确认修改页
    public function update(Request $request,$id)
    {
        //表单验证
        $this->validate($request,[
            'uname'=>'required|min:2|max:18',           
        ],[
            'uname.required'=>'用户名不能为空',
            'uname.min'=>'用户名最小2个字符',
            'uname.max'=>'用户名最大18个字符',
        ]);

        //去除_token
        $data = $request->except('_token');
         
        //更改用户信息
        $user = Admin_User::find($id);
        $res = $user->update($data);


        //判断
        if($res)
        {
            return redirect('/admin/users/index');
        }else{
            return back();
        }
    }

    //删除
    public function delete($id)
    {

        //根据传过来的id查找用户信息
        $user = Admin_User::find($id);
        //删除
        $res = $user->delete();

        //判断
        if($res)
        {           
            return redirect('/admin/users/index');
        }else{            
            return back();
        }        
    }


    
}
