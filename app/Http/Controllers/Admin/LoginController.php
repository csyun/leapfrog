<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Support\Facades\Validator;
use Session;

class LoginController extends Controller
{
    
	/**
     * 功能:返回后台登录页面
     * @author caoshouyun 
     * @date(2017/11/29 8:50)
     * @return 登录模板
     */
	public function login()
	{
		return view('Admin\login');
	}


    /**
     * 功能:生成验证码
     * @author caoshouyun 
     * @date(2017/11/29 9:00)
     * @return 一张图片
     */
    public function code()
    {
    	$builder = new CaptchaBuilder;
        $builder->build(200,40);
        Session::put('phrase',$builder->getPhrase()); //存储验证码
        return response($builder->output())->header('Content-type','image/jpeg');
    }

    /**
     * 功能:处理登录逻辑
     * @author caoshouyun 
     * @date(2017/11/29 9:10)
     * @return 登录结果
     */
    public function doLogin(Request $request)
    {
    	//1.获取用户提交的登录数据
        $input = $request->except('_token');
        //dd($input);
        //2.对数据进行后台验证
        //2.1验证规则
        $rule = [
            'username'=>'required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u|between:5,10',
            "password"=>'required|between:6,20'
        ];
        
        //2.2提示消息
        $mess = [
            'username.required'=>'用户名必须输入',
            'username.regex'=>'用户名必须汉字字母下划线',
            'username.between'=>'用户名必须在5到10位之间',
            'password.required'=>'密码必须输入',
            'password.between'=>'密码必须在6到20位之间'
        ];
        $validator =  Validator::make($input,$rule,$mess);
        //如果表单验证失败 passes()
          if ($validator->fails()) {
              return redirect('admin/login')
                  ->withErrors($validator)
                  ->withInput();
          }

    }


}
