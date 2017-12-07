<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use session;
use App\Models\Home_User;
use App\Models\MarketInfo;

/**
 *蛙塘控制器
 * @author [苏波] <386249656@qq.com>
 * @data 2017-12-4 10:00
 * 
 */

class PondController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    //图片上传
   public function upload(Request $request)
    {
        $file = $request->file('file_upload');

        if($file->isValid()){
            $entension = $file->getClientOriginalExtension();//上传文件的后缀名
            $newName = date('YmdHis').mt_rand(1000,9999).'.'.$entension;
        //上传到七牛的方法
        //\Storage::disk('qiniu')->writeStream('uploads/'.$newName, fopen($file->getRealPath(), 'r'));
        //上传到OSS的方法
        //$result = OSS::upload('uploads/'.$newName, $file->getRealPath());
        //上传到本地服务器的方法
        $path = $file->move(public_path().'/uploads',$newName);
        //将上传文件的路径返回给浏览器客户端
         $filepath = 'uploads/'.$newName;
         return  $filepath;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = session('homeuser');
        $uid = $user->uid;
        $userinfo = Home_User::where('uid',$uid)->first();   
        // dd($userinfo);
        return view('Home/Pond/create',compact('user','userinfo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // //表单验证
        // $this->validate($request,[
        //     'mname'=>'required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u|between:2,18',
        //     'art_thumb'=>'required',
        //     'desc'=>'required|between:5,100',
            
        // ],[
        //     'uname.required'=>'用户名不能为空',
        //     'uname.regex'=>'用户名必须汉字字母下划线',
        //     'uname.between'=>'用户名必须在2到18位之间',
        //     'password.required'=>'密码不能为空',
        //     'password.between'=>'密码必须在6到18位之间',
        //     'rpassword.same'=>'两次密码不一致',
        // ]);


        //获取模板传来的数据

        $input = $request->except('_token','btn','file_upload');
        // dd($data);
        
        //判断是否有此鱼塘名
        $uname = MarketInfo::where('mname',$input['mname'])->first();
        // dd($uname);

        if ($uname) {
             return redirect('admin/users/create')->with('errors','鱼塘名已存在');
         } 




        //时间,默认刚注册时就是用户当前最后登录时间
        $time = time();
        $data['creat_time'] = $time;
        $data['avatar'] = $input['art_thumb'];
        $data['mname'] = $input['mname'];
        $data['desc'] = $input['desc'];
        $data['addres'] = $input['a'].$input['b'].$input['c'];
        $data['creator'] = session('homeuser')->uname; 
        $data['status'] = 0;

        // dd($data);

        //Admin_User与后台用户表data_admin_user关联的模型
        //数据上传给数据库
        
        $res = MarketInfo::create($data);
        // dd($res);

        //判断
        if($res)
        {

            return  redirect('/pond')->with('errors','创建成果等待审核');
        }else{
            return back();
        }        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
