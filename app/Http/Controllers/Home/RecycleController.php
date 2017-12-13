<?php

namespace App\Http\Controllers\Home;

use App\Models\RecycleGoodAttribute;
use App\Models\RecycleGoodOrder;
use App\Models\RecycleGoodsAttrValue;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RecycleGoods;
use Session;

class RecycleController extends CommonController
{
    /**
     * 展示前台回收商品列表
     * @date 2017/12/05 21:00
     * @auth 曹守云
     * @return  前台回收商品列表视图页面,携带需要的变量 recyclegoods可以回收的商品  $hotrecyclegoods 热门回收商品
     */
    public function index()
    {
        $recyclegoods = RecycleGoods::paginate(4);
        return view('Home\Recycle\list',compact('recyclegoods'));
    }
    /**
     * 展示前台回收商品列表
     * @date 2017/12/08 10:00
     * @auth 曹守云
     * @param 可回收商品的id
     * @return  回收商品估价页面
     */
    public function show($id)
    {
        $recyclegood = RecycleGoods::find($id);
        //获取属性
        $recycleattr = RecycleGoodAttribute::where('type_id',$recyclegood->type_id)->get();
        //获取属性值

        $goodattrvalues = RecycleGoodsAttrValue::where('rgid',$id)->get();
        //dd($goodattrvalues);
        //处理数据,把属性值对应的价格加入
        $goodattrvalue = [];
        foreach ($goodattrvalues as $k=>$v){
            $attval['attr_value'] =  $v->attr_value;
            $attval['attr_price'] =  $v->attr_price;
            $attval['goods_attr_id'] =  $v->goods_attr_id;
            $goodattrvalue[$v->attr_id][] = $attval;
        }

        foreach ($recycleattr as $key=>$value){
            if($value->attr_values){
                $attr_values = explode("\r\n",$value->attr_values);
                $recycleattr[$key]['attr_values'] = $attr_values;
                if($goodattrvalue){
                    $recycleattr[$key]['goodattrvalue'] = $goodattrvalue[$value->attr_id];
                }
            }
        }
        ($recycleattr);
        return view('Home\Recycle\info',compact('recyclegood','recycleattr'));

    }
    public function count(Request $request)
    {
        $recyclegood = $request->except('_token');

        $attr = $request->goods_attr_id;
        $attrarr = RecycleGoodsAttrValue::whereIn('goods_attr_id',$attr)->get();
        //dd($attrarr);

        $sum = 0;
        foreach ($attrarr as $k=>$v){
            $sum +=$v->attr_price;
        }
        $count = $request->rgprice - $sum;
        $recyclegood['rprice'] = $count;
        Session::put('recyclegood',$recyclegood);
        return view('Home\Recycle\count',compact('count','attrarr','recyclegood'));
    }
    public function recycleorder(Request $request)
    {
        $recyclegood = Session::get('recyclegood');

        return view('Home\Recycle\order',compact('recyclegood'));
    }
    public function recyclecommit(Request $request)
    {
        $recyclegood = Session::get('recyclegood');
        //dd($recyclegood);
        $info = implode(',',$recyclegood['goods_attr_id']);

        $recycleinfo =  $request->except('_token');
        $orderinfo['roid'] = time().rand(1000,9999);
        $orderinfo['uid'] = Session::get('homeuser')->uid;
        $orderinfo['creat_time'] = time();
        $orderinfo['rpice'] = $recyclegood['rprice'];
        $orderinfo['rgid'] = $recyclegood['rgid'];
        $orderinfo['addr'] = $recycleinfo['addr'];
        $orderinfo['rcname'] = $recycleinfo['rcname'];
        $orderinfo['rctel'] = $recycleinfo['rctel'];
        $orderinfo['status'] = 0;
        $orderinfo['info'] = $info;
        $res = RecycleGoodOrder::create($orderinfo);
        if ($res){
            return view('Home\Recycle\success',compact('recycleinfo'));
        } else {
            return back()->with('msg','添加失败');
        }

    }


}
