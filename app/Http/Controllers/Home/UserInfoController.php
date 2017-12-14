<?php

namespace App\Http\Controllers\Home;

use App\Models\Admin_Goods;
use App\Models\Home_User;
use App\Models\Order;
use App\Models\Order_details;
use App\Models\RecycleGoods;
use App\Models\RecycleOrders;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RecycleGoodOrder;
use Session;
use DB;

class UserInfoController extends CommonController
{
    /**
     * 显示个人中心首页面,显示订单信息列表
     */
    public  function  index()
    {
        $id = Session::get('homeuser.uid');
        $orders = Order::where('uid',$id)->get();
//        $oid = [];
//        foreach ($orders as $k=>$v){
//            $oid[] = $v->oid;
//        }
//        //dd($oid);
//        $gid = Order_details::whereIn('oid',$oid)->pluck('gid');
//        $goods = Admin_Goods::whereIn('gid',$gid)->get();
//        $orders['goods'] = $goods;
        //dd($orders);
        //$orders = Order::with('goods')->where('uid',$id)->get();

        //dd($orders);
        return view('Home\UserInfo\index',compact('orders'));
    }
    public function orderdeta($id)
    {
        $info = Order_details::with('goods')->where('oid',$id)->get();
        $order = Order::where('oid',$id)->first();
        //dd($info);
        return view('\Home\UserInfo\orderdata',compact('info','order'));
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
        $recycleorders = RecycleGoodOrder::orderby('creat_time','desc')->where('uid',Session::get('homeuser.uid'))->get();
        foreach ($recycleorders as $k=>$v){
            $good = RecycleGoods::find($v->rgid);
            $recycleorders[$k]['rgname'] = $good->rgname;
            $recycleorders[$k]['rgpic'] = $good->rgpic;
        }
        //dd($recycleorders);
        return view('Home\UserInfo\recycleorder',compact('recycleorders'));
    }
    //我的发布商品
    public function myaddgood()
    {
        $id = Session::get('homeuser.uid');
        $goods = Admin_Goods::where('uid',$id)->get();
      //dd($goods);
        return view('Home\UserInfo\myaddgood',compact('goods'));
    }
    public function  gstatus($gid)
    {
        $good = Admin_Goods::find($gid);
        $status = !$good->status;
        $res = $good->update(['status'=>$status]);
        if($res){
            $data =[
                'gg'=> 0,
                'msg'=>'修改成功'
            ];
        }else{
            $data =[
                'gg'=> 1,
                'msg'=>'修改失败'
            ];
        }
        return $data;

    }
    public function goodsDel($id)
    {
        $res = Admin_Goods::find($id)->delete();
        if ($res) {
            $data['gg'] = 0;
            $data['msg'] = "删除成功";
        } else {
            $data['gg'] = 1;
            $data['msg'] = "删除失败";
        }
        return $data;
    }
}
