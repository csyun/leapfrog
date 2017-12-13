<?php

namespace App\Http\Controllers\Home;

use App\Models\Admin_Goods;
use App\Models\Order;
use App\Models\Order_details;
use App\Models\ShopCart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DB;
class OrderController extends CommonController
{
    public $oid;
    public $input;
    public $gid;
    public function doadd(Request $request)
    {
        $this->oid = time().rand(1000,9999);
        $this->input = $request->except('_token');
        $orders=$this->input;
        $this->writeOrder();
        $this->writeDetail();
        $this->clearCart();
        return view('home.order.firstorder',compact('orders'));
    }


    //处理结算,添加订单
    public function writeOrder()
    {
        $rule = [
            'addr'=>'required',
            "rec"=>'required|regex:/^[\x{4e00}-\x{9fa5}_]+$/u',
            'tel'=>'required'
        ];
        $mess = [
            'addr.required'=>'地址必须输入',
            'rec.required'=>'收货必须输入',
            'rec.regex'=>'姓名必须是汉字',
            'tel.required'=>'手机号必须输入',
            'tel.numeric'=>'手机号必须是数字',
        ];
        $validator =  Validator::make($this->input,$rule,$mess);
        if ($validator->fails()) {
            return redirect('/home/shopcart/cart/pay')
                ->withErrors($validator)
                ->withInput();
        }

                    $order = new Order();
                    $order->oid =$this->oid;
                    $order->addr = $this->input['addr'];
                    $order->tel = $this->input['tel'];
                    $order->rec = $this->input['rec'];
                    $order->usg = $this->input['usg'];
                    $order->uid = session('homeuser')['uid'];
                    $order->oprice = $this->input['oprice'];
                    $order->status = 0;
                    $order->creata_time = time();
                    $order->updata_time = time();
                    $order->save();


    }
    public function writeDetail()
    {
        $goods = session('goods');
        if($goods) {
            foreach ($goods as $k => $v) {
                $order_details = new Order_details();
                $order_details->gid = $v->gid;
                $order_details->oid = $this->oid;
                $order_details->save();
                Admin_Goods::where('gid', $v->gid)->update(['status' => 1]);
            }
        }
    }
    public function clearCart()
    {
        $user = session('homeuser');
        ShopCart::where('uid', $user['uid'])->delete();
        session()->pull('goods');
    }

    public function myorder()
    {

    }

}
