<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Home_User;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Session;


/**
 *前台用户登录控制器
 * @author [苏波] <386249656@qq.com>
 * @data 2017-12-3 10:00
 * 
 */

class LoginController extends CommonController
{
    public function login()
	{

		return view('Home.login');
	}

	public function dologin(Request $request)
	{
		//1.获取用户提交的登录数据
        $input = $request->except('_token');
        //dd($input);
        //2.对数据进行后台验证
        //2.1验证规则
        $rule = [
            'username'=>'required',
            "password"=>'required|between:6,20',
            
        ];
        
        //2.2提示消息
        $mess = [
            'username.required'=>'用户名必须输入',
           
            'username.between'=>'用户名必须在2到18位之间',
            'password.required'=>'密码必须输入',
            'password.between'=>'密码必须在6到20位之间',
            

        ];
        $validator =  Validator::make($input,$rule,$mess);
        //如果表单验证失败 passes()
        if ($validator->fails()) {
              return redirect('/login')
                  ->withErrors($validator)
                  ->withInput();
          }

        //检查用户是否存在
        $user0 = Home_User::where('uname',$input['username'])->first();
        $user1 = UserInfo::where('email',$input['username'])
                        ->orwhere('telphone',$input['username'])
                        ->first();
        

        
        
        if(!$user0 && !$user1 ){
            return redirect('/login')->with('errors','用户名不存在');
        }
        //核对密码
        //如果是用户名
        if($user0){
        	$password = $user0['password'];
	        if (Hash::check($input['password'], $password)){
	            Session::put('homeuser',$user0);

                 if ($user0['active'] == 0) {
                    return redirect('/login')->with('errors','账号未激活');
                }
                $back = Session::get('back');
                $time = time();
                $res = Home_User::where('uid',$user0->uid)->update(['last_login_time'=>$time]);
                if($back){
                    return redirect($back);
                }
	            return redirect('/');

	        } else{
	            return redirect('/login')->with('errors','密码不正确');
	        }
    	}
    	//如果是邮箱或电话
    	if($user1){
    		$pass = UserInfo::find($user1['uid'])->user;
    		$password = $pass->password;
    		
	        if (Hash::check($input['password'], $password)){
	            Session::put('homeuser',$pass->uname);

                if ($user1['active'] == 0) {
                    return redirect('/login')->with('errors','账号未激活');
                }
                $back = Session::get('back');
                $time = time();
                $res = Home_User::where('uid',$user1->uid)->update(['last_login_time'=>$time]);
                if($back){
                    return redirect($back);
                }
	            return redirect('/');

	        } else{
	            return redirect('/login')->with('errors','密码不正确');
	        }

    	}

	}


    /**
     * 退出登录
     * @auth:caoshouyun
     * @date:2017/11/30
     * @return 登录视图
     */
    public function loginout()
    {
        //清空session
        session()->flush();

        return redirect('/');
    }

}
