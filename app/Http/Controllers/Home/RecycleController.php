<?php

namespace App\Http\Controllers\Home;

use App\Models\RecycleGoodAttribute;
use App\Models\RecycleGoodsAttrValue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RecycleGoods;

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
        $recyclegoods = RecycleGoods::paginate(2);
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
        $input = $request->except('_token');
        dd($input);
    }


}
