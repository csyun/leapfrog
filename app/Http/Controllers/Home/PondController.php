<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use session;
use App\Models\Home_User;
use App\Models\UserInfo;
use App\Models\MarketInfo;
use App\Models\MarketUser;



/**
 *蛙塘控制器
 * @author [苏波] <386249656@qq.com>
 * @data 2017-12-4 10:00
 * 
 */

class PondController extends Controller
{
    /**
     *我的蛙塘
     * @return [type] [description]
     */
    public function mypond()
    {
        //用户ID
        $user = session('homeuser');
        $uid = $user->uid;
        $uname = Home_User::find($uid)->uname;
        // dd($uname);
        //查找我的蛙塘
        $data = MarketInfo::orderBy('status','asc')
                            ->where('creator',$uname)
                            ->paginate(10);


        return view('Home/Pond/mypond',compact('data')); 
    }


    /**
     * 我收藏的蛙塘
     * @return [type] [description]
     */
    public function pondcollect()
    {
        //用户ID
        $user = session('homeuser');
        $uid = $user->uid;
        //我收藏的蛙塘ID数组
        $ponds = MarketUser::orderBy('collect_time','desc')
                           ->where('uid',$uid)
                           ->get();
        if(!$ponds){
            $arr = [];
        }else{
            foreach($ponds as $k=>$v){
                $arr[] = $v->mid;
            }
        }
        //遍历$arr查看蛙塘信息
        foreach($arr as $k=>$v){
            $collect[] = MarketInfo::where('mid',$v)->first();
        }
        // dd($collect);

        return view('Home/Pond/collectpond',compact('collect'));

    }



    /**
     * 收藏蛙塘
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function collectpond(Request $request)
    {
        //蛙塘ID
        $input = $request->all();
        $mid = $input['mid'];
        //用户ID
        $user = session('homeuser');
        $uid = $user->uid;
        //我收藏的蛙塘ID数组
        $ponds = MarketUser::where('uid',$uid)->get();
        if(!$ponds){
            $arr = [];
        }else{
            foreach($ponds as $k=>$v){
                $arr[] = $v->mid;
            }
        }
        //如果已经收藏了该蛙塘
        if(in_array($mid, $arr)){
            return back()->with('errors','您已收藏该鱼塘');
        }
        //当前时间
        $data['collect_time'] = time();
        $data['uid'] = $uid;
        $data['mid'] = $mid;
        //添加到用户收藏蛙塘表中
        $res = MarketUser::create($data);
        if($res){

            return redirect('/pondcollect')->with('errors','收藏成功');
        }else{
            return back()->with('errors','收藏失败');
        }
    }

    public function decollect(Request $request)
    {
        //蛙塘ID
        $input = $request->all();
        $mid = $input['mid'];
        //用户ID
        $user = session('homeuser');
        $uid = $user->uid;
        //取消收藏
        $res = marketuser::where('mid',$mid)
                    ->where('uid',$uid)
                    ->delete();
        if($res){
            return back()->with('errors','已取消收藏');
        }else{
            return back()->with('errors','取消失败');
        }
    }
    /**
     * 蛙塘详情表
     * @return [type] [description]
     */
    public function pondlist(Request $request)
    {
        $input = $request->all();
        $mid = $input['mid'];
        $marketinfo = MarketInfo::where('mid',$mid)->first();
        $marketuser = MarketUser::where('mid',$mid)->get();
        // dd($marketuser);
        // 蛙塘总成员数量
        $count = count($marketuser);
        //判断用户是否加入蛙塘
        $user = session('homeuser');
        $uid = $user->uid;
        $isinpond = MarketUser::where('mid',$mid)
                                ->where('uid',$uid)
                                ->first();
        //塘主的商品       
     return view('Home/Pond/pondlist',compact('marketinfo','count','isinpond'));   
    }

//=====================================================================================================   
    /**
     * 蛙塘列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = MarketInfo::orderBy('creat_time','desc')
            ->where('status','=',1)
            ->paginate(10);

        //用户ID
        $user = session('homeuser');
        $uid = $user->uid;

        //我收藏的蛙塘ID数组
        $ponds = MarketUser::where('uid',$uid)->get();

        if(!$ponds){
            $arr = [];
        }else{
            foreach($ponds as $k=>$v){
                $arr[] = $v->mid;
            }
        }
        dd($arr);
        return view('Home/Pond/index',compact('data','arr'));
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
        $userinfo = UserInfo::where('uid',$uid)->first();   
        // dd($userinfo->avatar);
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
        //表单验证
        $this->validate($request,[
            'mname'=>'required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u|between:2,18',
            'art_thumb'=>'required',
            'desc'=>'required|between:5,100',           
        ],[
            'mname.required'=>'用户名不能为空',
            'mname.regex'=>'用户名必须汉字字母下划线',
            'mname.between'=>'用户名必须在2到18位之间',           
            'art_thumb.require'=>'请选择图片文件', 
            'desc.required'=>'描述不能为空',
            'desc.between'=>'描述应在5到100字之间',
            
        ]);


        //获取模板传来的数据

        $input = $request->except('_token','btn','file_upload');
        // dd($input);
        
        //判断是否有此鱼塘名
        $uname = MarketInfo::where('mname',$input['mname'])->first();
        // dd($uname);

        if ($uname) {
             return redirect('/pond/create')->with('errors','鱼塘名已存在');
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

            return  redirect('/mypond')->with('errors','创建成果等待审核');
        }else{
            return back()->with('errors','创建失败');
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
