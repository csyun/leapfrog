<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Session;
use App\Models\Home_User;
use App\Models\UserInfo;

/**
 *前台用户注册
 * @author [苏波] <386249656@qq.com>
 * @data 2017-12-2 10:00
 * 
 */

class RegisterController extends Controller
{
    public function register()
    {
    	return view ('Home\register');
    }


    public function code()
    {
    	$builder = new CaptchaBuilder;
        $builder->build(200,40);
        Session::put('phrase',$builder->getPhrase()); //存储验证码
        return response($builder->output())->header('Content-type','image/jpeg');
    }

    public function ajax(Request $request)
    {
        $data = $request->all();
        $res = Home_User::where('uname',$data['username'])->first();
        if($res){
            return 1;
        }else{
            return 0;
        }

     


    }

    public function doregister(Request $request)
    {
		//1.获取用户提交的登录数据
        $input = $request->except('_token');
 
        //2.对数据进行后台验证
        //2.1验证规则
        $rule = [
            // 'email'=>'required|regex:/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/',
            'uname'=>'required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u|between:2,18',
            "password"=>'required|between:6,20',
            "repassword"=>'same:password',
            "code"=>'required',           	
        ];
        
        //2.2提示消息
        $mess = [
            // 'email.required'=>'邮箱号必须输入',
            // 'email.regex'=>'邮箱格式不符合要求！',
            'uname.required'=>'用户名必须输入',
            'uname.regex'=>'用户名必须汉字字母下划线',
            'uname.between'=>'用户名必须在2到18位之间',
            'password.required'=>'密码必须输入',
            'password.between'=>'密码必须在6到20位之间',
            'repassword.same'=>'两次密码不一致！',
            'code.required'=>'验证码不能为空',

        ];

        $validator =  Validator::make($input,$rule,$mess);

        //如果表单验证失败 passes()
        if ($validator->fails()) {
              return redirect('admin/login')
                  ->withErrors($validator)
                  ->withInput();
          }

         $input = $request->except('_token','repassword');

        //检查用户是否存在
        $uname = Home_User::where('uname',$input['uname'])->first();
        // dd($email);
        if($uname){
            return redirect('/register')->with('errors','用户名已存在');
        }

        //判断验证码
        if ($input['code']!=Session::get('phrase'))
        {
            return  redirect('/register')->with('errors','验证码错误')->withInput();
        }
        // dd($input);
       
        $data['uname'] = $input['uname'];
        $data['password'] = Hash::make($input['password']);
        
        $data['auth'] = 1;
        $data['status'] = 0;
        $time = time();
        $data['last_login_time'] = $time;

        // dd($data);
        $user = new Home_User();
        $res = $user->create($data);
        // dd($res);
                //判断
        if($res)
        {
        // 	$uid = $user::where('uname',$input['email'])->first();
        // 	$userinfo['email'] = $input['email'];
        // 	$userinfo['uid'] = $uid['uid'];
        // 	$uinfo = new UserInfo();
        // 	$a = $uinfo -> create($userinfo);
        
            return  redirect('/login')->with('errors','注册成功');
        }else{
            return back();
        }
  		


    }
}
