<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Home_User;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Session;

class LoginController extends Controller
{
    public function login()
	{
		return view('Home\login');
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
	            return redirect('/');
	        } else{
	            return redirect('/login')->with('errors','密码不正确');
	        }

    	}    		
	}
}
