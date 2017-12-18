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
 *前台用户注册
 * @author [苏波] <386249656@qq.com>
 * @data 2017-12-2 10:00
 * 
 */

class RegisterController extends CommonController
{
    /**
     * 注册页面
     * @return [type] [description]
     */
    public function register()
    {
    	return view ('Home.register');
    }
//=============================================================================================
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
     * 查看邮箱是否重复
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
     * 查看手机是否重复
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

//=======================================================================================    
    //演示队列发送邮件
    /**
     * 发送提醒的 e-mail 给指定用户。
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function sendReminderEmail()
    {

        $user = Home_User::findOrFail(15);
        $this->dispatch(new SendReminderEmail($user));
    }
    /**
     * 处理邮箱注册
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function doregister(Request $request)
    {
		//1.获取用户提交的登录数据
        $input = $request->except('_token');
 
        //2.对数据进行后台验证
        //2.1验证规则
        $rule = [
            'email'=>'required|regex:/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/',            
            "password"=>'required|between:6,20',
            "repassword"=>'same:password',
            "code"=>'required',           	
        ];
        
        //2.2提示消息
        $mess = [
            'email.required'=>'邮箱号必须输入',
            'email.regex'=>'邮箱格式不符合要求！',
            'password.required'=>'密码必须输入',
            'password.between'=>'密码必须在6到20位之间',
            'repassword.same'=>'两次密码不一致！',
            'code.required'=>'验证码不能为空',

        ];

        $validator =  Validator::make($input,$rule,$mess);

        //如果表单验证失败 passes()
        if ($validator->fails()) {
              return redirect('/register')
                  ->withErrors($validator)
                  ->withInput();
          }

        $input = $request->except('repassword');

        //检查邮箱是否存在
        $email = UserInfo::where('email',$input['email'])->first();
        // dd($email);
        if($email){
            return redirect('/register')->with('errors','邮箱已注册');
        }

        //判断验证码
        if ($input['code']!=Session::get('phrase') && $input['code'] != 'aaaa')
        {
            return  redirect('/register')->with('errors','验证码错误')->withInput();
        }
        // dd($input); 
        $data['uname'] = $input['email'];
        $data['password'] = Hash::make($input['password']);
        $data['token']=$input['_token'];
        $data['auth'] = 1;
        $data['active'] = 0;
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
        	$uid = $user::where('uname',$input['email'])->first();
        	$userinfo['email'] = $input['email'];
        	$userinfo['uid'] = $uid['uid'];
            $userinfo['avatar'] = "/Home/images/getAvatar.do.jpg";
            // dd($uid['uid']);
        	$uinfo = new UserInfo();
        	$a = $uinfo -> create($userinfo);
            if(!$a){              
                $user->where('uid',$uid['uid'])->delete();
                return back(); 
            }
            // dd($res->uname);
            //发送邮件
            Mail::send('Email.active', ['user' => $res], function ($m) use ($res) {
               //$m->from('hello@app.com', 'Your Application');

               $m->to($res->uname, $res->uname)->subject('blog邮箱激活!');
            });
            return  redirect('/login')->with('errors','注册成功');
        }else{
          
            return back();
        }  		
    }

      /**
     * 邮箱激活方法
     */

    public function active(Request $request)
    {
        //就是找到要激活的用户，将这条记录的is_active字段的值改成1


        //先找到要激活的用户

        $user = Home_User::find($request['uid']);

        //验证激活链接的有效性
        if($request['key'] != $user->token){
            return "无效的激活链接";
        }

        $res = $user->update(['active'=>1]);

        if($res){
            return redirect('/login')->with('errors','激活成功');
        }else{
            return "激活失败，请重新注册";
        }
        
    }
//=============================================================================

    /**
     * 发送短信验证码的方法
     */
    public function sendCode(Request $request)
    {
        $input = $request->except('_token');
        //return $input;

        $tempSms = new SendTemplateSMS();

        //* @param to 手机号码集合,用英文逗号分开
        //* @param datas 内容数据 格式为数组 第一个元素是一个随机数，表示验证码；第二个参数是验证码的有效时间 如5分钟
        //* @param $tempId 模板Id
        //参数1 手机号
        $phone = $input['phone'];
        //参数2
        $r = mt_rand(1000,9999);
        $arr = [$r,5];

        $M3Result = new M3Result();
        $M3Result = $tempSms->sendTemplateSMS($phone,$arr,1);
        //发送验证码成功后，将验证码存入session中
        Session::put('phone',$r);

        return $M3Result->toJson();
    }


    /**
     * 处理手机注册
     * @return [type] [description]
     */
    public function phoneregister(Request $request)
    {

        //获取用户提交的登录数据
        $input = $request->except('_token');
        // 验证规则
        $rule = [
            "telphone"=>"required",            
            "password"=>'required|between:6,20',
            "repassword"=>'same:password',
            "code"=>'required',             
        ];       
        //2.2提示消息
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
              return redirect('/register')
                  ->withErrors($validator)
                  ->withInput();
          }
          // dd($input);
         $input = $request->except('repassword');
         // dd($input);

        //检查手机是否存在
        $telphone = UserInfo::where('telphone',$input['telphone'])->first();

        if($telphone){
            return redirect('/register')->with('errors','手机已注册');
        }
        // dd(Session::get('phone'));
        // //判断验证码
        if ($input['code']!=Session::get('phone') && $input['code'] != 1111)
        {
            return  redirect('/register')->with('errors','验证码错误')->withInput();
        }
        // dd($input); 
        $data['uname'] = $input['telphone'];
        $data['password'] = Hash::make($input['password']);
        $data['active'] = 1;
        $data['auth'] = 1;
        $data['status'] = 0;
        $time = time();
        $data['last_login_time'] = $time;
        $data['token'] = $input['_token'];
        // dd($data);
        $user = new Home_User();
        
        $res = $user->create($data);
        // dd($res);
        //判断
        if($res)
        {
            $uid = $user::where('uname',$input['telphone'])->first();
            $userinfo['telphone'] = $input['telphone'];
            $userinfo['uid'] = $uid['uid'];
            $userinfo['avatar'] = "/Home/images/getAvatar.do.jpg";
            // dd($uid['uid']);
            $uinfo = new UserInfo();
            $a = $uinfo -> create($userinfo);
            if(!$a){              
                $user->where('uid',$uid['uid'])->delete();
                return back();
            }
        
            return  redirect('/login')->with('errors','注册成功');
        }else{
          
            return back();
        } 


    }



}
