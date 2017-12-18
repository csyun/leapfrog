<?php

namespace App\Http\Controllers\Home;

use App\Models\RecycleGoodAttribute;
use App\Models\RecycleGoodOrder;
use App\Models\RecycleGoodsAttrValue;
use Illuminate\Support\Facades\Validator;
use App\Models\RecycleGoodType;
use App\Models\RecycleOrders;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RecycleGoods;
use Illuminate\Support\Facades\Input;
use Session;
use DB;

class RecycleController extends CommonController
{
    /**
     * 展示前台回收商品列表
     * @date 2017/12/05 21:00
     * @auth 曹守云
     * @return  前台回收商品列表视图页面,携带需要的变量 recyclegoods可以回收的商品  $hotrecyclegoods 热门回收商品
     */
    public function index(Request $request)
    {
        $typeid = $request->input('typeid');
        //dd($typeid);
        $recyclegoodtype = RecycleGoodType::get();

        $recyclegoods = RecycleGoods::paginate(8);
        //dd($recyclegoodtype);
        //查出回收数量最多的2个商品,附带回收均价
        $hotrecyclegoods = DB::select('select rgid, AVG(rpice) as rpice, count(*) as sales  from `data_recycle_orders` group by `rgid` order by sales DESC limit 2;');
        //dd($hotrecyclegoods);
        $gid = [];
        $price = [];
        //遍历数组取出商品id数组和平均价格数据
        foreach ($hotrecyclegoods as $k=>$v){
            $gid[] = $v->rgid;
            $price[] = number_format($v->rpice,2);
            //$sale[] = $v->sale;
         }
        //根据查出的2个id查询出商品信息
        $goods = RecycleGoods::whereIn('rgid',$gid)->orderBy('sale','desc')->get();
        //dd($goods);
        foreach ($goods as $k=>$k)
        {
            //遍历价格数组,把平均价格放到里面
            foreach ($price as $kk=>$vv){
                $goods[$k]['avgprice'] = $vv;
            }
        }
        $isAjax = $request->input('isAjax');
        if($isAjax){
            $recyclegoods = RecycleGoods::where('type_id',$typeid)->paginate(8);
            return $recyclegoods;
        }
        //dd($recyclegoods);
        return view('Home.Recycle.list',compact('recyclegoods','goods','recyclegoodtype'));
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

        return view('Home.Recycle.info',compact('recyclegood','recycleattr'));

    }
    /**
     *询价显示页面,选择商品的属性进行计算价格
     * @auth 曹守云
     * @param 询价提交的属性值
     * 返回询价页面,带着响应的计算出的价格 选择的属性 要回收的商品
     */
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
        //把回收的商品信息放到session里面
        Session::put('recyclegood',$recyclegood);
        return view('Home.Recycle.count',compact('count','attrarr','recyclegood'));
    }
    /**
     * 提交回收订单
    */
    public function recycleorder(Request $request)
    {
        //获取session里面存放的回收商品信息
        $recyclegood = Session::get('recyclegood');

        return view('Home.Recycle.order',compact('recyclegood'));
    }
    /**
     * 订单提交存到数据库中
    */
    public function recyclecommit(Request $request)
    {
        $recyclegood = Session::get('recyclegood');
        //dd($recyclegood);
        $info = implode(',',$recyclegood['goods_attr_id']);

        $recycleinfo =  $request->except('_token');
        $rule = [
            'rcname'=>'required',
            "rctel"=>'required',
            "addr"=>'required',

        ];
        $mess = [
            'rcname.required'=>'回收联系人名称必须输入',
            'rctel.required'=>'回收联系人电话必须输入',
            'addr.required'=>'回收联系人地址必须输入',
        ];

        $validator =  Validator::make($recycleinfo,$rule,$mess);
        if ($validator->fails()) {
            return redirect('recyclegoods/order')
                ->withErrors($validator)
                ->withInput();
        }
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
        //dd($orderinfo);
        $res = RecycleGoodOrder::create($orderinfo);
        if ($res){
            //提交订单成功,在回收商品所在的库sale字段(回收次数)加1
            $sale = DB::update('update data_recycle_goods set sale=sale+1 where rgid='.$recyclegood['rgid'].';');
            return view('Home.Recycle.success',compact('recycleinfo'));
        } else {
            return back()->with('msg','添加失败');
        }

    }


}
