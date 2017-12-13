<?php

namespace App\Http\Controllers\Home;

use App\Models\Home_User;
use App\Models\RecycleOrders;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RecycleGoodOrder;
use Session;

class UserInfoController extends CommonController
{
    /**
     * 显示个人中心首页面,显示订单信息列表
     */
    public  function  index()
    {

        return view('Home\UserInfo\index');
    }
    /**
     * 显示个人信息修改页面
    */
    public function information()
    {
        $id = Session::get('homeuser.uid');
        $username = Session::get('homeuser.uname');
        $userinfo = UserInfo::where('uid',$id)->first();
        //dd($userinfo);
        return view('Home\UserInfo\information',compact('userinfo','username'));
    }
    /**
     * 把修改的个人信息存到数据库
    */
    public function infoadd(Request $request)
    {
        $input = $request->except('_token','file_upload');
        $res = UserInfo::where('uid',Session::get('homeuser.uid'))->update($input);
        $input['last_update_time'] = time();
        if ($res){
            $id = Session::get('homeuser.uid');
            $username = Session::get('homeuser.uname');
            $userinfo = UserInfo::where('uid',$id)->first();
            //dd($userinfo);
            return view('Home\UserInfo\information',compact('userinfo','username'));
        }else{
            return back()->with('msg','修改失败');
        }
    }
    //回收订单页面
    public function recycleorder()
    {
        $recycleorders = RecycleGoodOrder::orderby('creat_time','desc')->get();
        dd($recycleorders);

        return view('Home\UserInfo\recycleorder');
    }
}
