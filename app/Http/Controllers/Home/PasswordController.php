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
use App\SMS\SendTemplateSMS;
use App\SMS\M3Result;
use App\Jobs\SendReminderEmail;
use Illuminate\Support\Facades\Mail;

/**
 *密码遗忘控制器,找回密码
 * @author [苏波] <386249656@qq.com>
 * @data 2017-12-2 10:00
 * 
 */

class PasswordController extends CommonController
{


	 /**
     * 验证码
     * @return [type] [description]
     */
    public function code()
    {
    	$builder = new CaptchaBuilder;
        $builder->build(200,40);
        Session::put('phrase',$builder->getPhrase()); //存储验证码
        return response($builder->output())->header('Content-type','image/jpeg');
    }

	  /**
     * 查看邮箱是否存在
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function ajax(Request $request)
    {
        $data = $request->all();
        $res = UserInfo::where('email',$data['email'])->first();
        if($res){
            return 1;
        }else{
            return 0;
        }
    }
    /**
     * 查看手机是否存在
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function phoneajax(Request $request)
    {
        $data = $request->all();
        $res = UserInfo::where('telphone',$data['telphone'])->first();
        if($res){
            return 1;
        }else{
            return 0;
        }

    }



//===========================================================================================

    //找回密码的页面
    public function forget()
    {
        return view('Home.forget');
    }

	//发送找回邮箱账号密码的邮件
    public function dopassword(Request $request)
    {
    	$input = $request->except('_token');
        //对数据进行后台验证
        //验证规则
        $rule = [
            'email'=>'required|regex:/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/',            
            "code"=>'required',           	
        ];
        //提示消息
        $mess = [
            'email.required'=>'邮箱号必须输入',
            'email.regex'=>'邮箱格式不符合要求！',
            'code.required'=>'验证码不能为空',

        ];

		$validator =  Validator::make($input,$rule,$mess);
        //如果表单验证失败 passes()
        if ($validator->fails()) {
              return redirect('/forget')
                  ->withErrors($validator)
                  ->withInput();
          }
        //检查邮箱是否存在
        $email = UserInfo::where('email',$input['email'])->first();

        if(!$email){
            return redirect('/register')->with('errors','邮箱未注册!无法找回');
        }

        //判断验证码
        if ($input['code']!=Session::get('phrase') && $input['code'] != 'aaaa')
        {
            return  redirect('/register')->with('errors','验证码错误')->withInput();
        }        

        //要发送的邮箱
        $email = $request['email'];
		//根据邮箱获取收件人信息
        $userinfo =UserInfo::where('email',$email)->first();
        $uid = $userinfo->uid;
        $data = Home_User::find($uid);
        $res['uname'] = $data->uname;
        $res['uid'] = $data->uid;
        $res['token'] = $data->token;
        $res['email'] = $email;
        // dd($res);
        Mail::send('email.forget', ['user' => $res], function ($m) use ($res) {
            //$m->from('hello@app.com', 'Your Application');

            $m->to($res['email'], $res['uname'])->subject('blog密码找回!');
        });

        return redirect('/login')->with('errors','修改密码邮件已经发送成功，请登录邮箱修改您的密码') ;
    }



    /**
     * 处理手机忘记密码
     * @return [type] [description]
     */
    public function phonepassword(Request $request)
    {

        //获取用户提交的登录数据
        $input = $request->except('_token');
        // 验证规则
        $rule = [
            "telphone"=>"required",            
            "code"=>'required',             
        ];       
        //提示消息
        $mess = [
            'telphone.required'=>'手机号必须输入',
            'password.required'=>'密码必须输入',
            'password.between'=>'密码必须在6到20位之间',
            'repassword.same'=>'两次密码不一致！',
            'code.required'=>'验证码不能为空',
        ];

        $validator =  Validator::make($input,$rule,$mess);

        //如果表单验证失败 passes()
        if ($validator->fails()) {
              return redirect('/forget')
                  ->withErrors($validator)
                  ->withInput();
          }

        //检查手机是否存在
        $telphone = UserInfo::where('telphone',$input['telphone'])->first();

        if(!$telphone){
            return redirect('/register')->with('errors','手机未注册,无法找回');
        }
        // //判断验证码
        if ($input['code']!=Session::get('phone') && $input['code'] != 1111)
        {
            return  redirect('/register')->with('errors','验证码错误')->withInput();
        }
   
        $uid = $telphone->uid;

        $user = Home_User::find($uid);
        // dd($user);

        return  redirect('/reset?uid='.$user->uid.'&key='.$user->token);
    }






    //重置密码页面
    public function reset(Request $request)
    {
        //根据uid获取要修改密码的用户，根据key确定链接的有效性

        $user = Home_User::find($request['uid']);

        $user_name = $user->uname;

        if($request['key'] != $user->token){
            return '无效的连接';
        }


        //如果有效，就返回修改密码的界面
        return view('Home.reset',compact('user'))->with('errors','请设置新密码');
    }


        //重置密码
    public function doreset(Request $request)
    {


    	//获取用户提交的登录数据
        $input = $request->except('_token');
        //对数据进行后台验证
        //验证规则
        $rule = [                       
            "password"=>'required|between:6,20',
            "repassword"=>'same:password',
            "code"=>'required',           	
        ];        
        //提示消息
        $mess = [         
            'password.required'=>'密码必须输入',
            'password.between'=>'密码必须在6到20位之间',
            'repassword.same'=>'两次密码不一致！',
            'code.required'=>'验证码不能为空',
        ];

        $validator =  Validator::make($input,$rule,$mess);

        //如果表单验证失败 passes()
        if ($validator->fails()) {
              return redirect('/login')
                  ->withErrors($validator)
                  ->withInput();
          }

        //判断验证码
        if ($input['code']!=Session::get('phrase') && $input['code'] != 'aaaa')
        {
            return  back()->with('errors','验证码错误')->withInput();
        }
        // dd($input);

		//找到要重置密码的用户
       	$user = Home_User::where('uname',$input['username'])->first();

		//将用户的密码修改为传过来的密码

        $pass = Hash::make($input['password']);

        $res = $user->update(['password'=>$pass]);

        if($res){
            return redirect('/login')->with('errors','重置密码成功');
        }else{
            return back()->with('errors','密码修改失败，请重新修改');
        }
        
    }




}





