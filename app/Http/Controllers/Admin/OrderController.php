<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Order_details;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DB;

class OrderController extends Controller
{
    /**
     * 订单浏览
     *
     */
    public function index()
    {
        $orders = DB::table('data_order')
            ->leftJoin('data_home_user', 'data_order.uid', '=', 'data_home_user.uid')
            ->get();
       return view('Admin.Order.list',compact('orders'));
    }
    /**
     * 订单详情
     *$id是传过来的订单oid
     */
    public function details($id)
    {
        $orders = DB::table('data_goods')
            ->join('data_order_details', function ($join)use($id) {
                $join->on('data_goods.gid', '=', 'data_order_details.gid')
                    ->where('data_order_details.oid', '=',$id);
            })
            ->get();

       return view("Admin.Order.detail",compact('orders'));
    }
    public function edit($id)
    {
       $order =  Order::where('oid',$id)->first();
       //dd($order);
       return view('Admin.Order.edit',compact('order'));
    }
    public function update(Request $request,$id)
    {

        $input = $request->except('_token');
        $rule = [
            'addr'=>'required',
            "rec"=>'required',
            "oprice"=>'required',
            'tel'=>'required'
        ];
        $mess = [
            'addr.required'=>'地址必须输入',
            'rec.required'=>'收货地址必须输入',
            'tel.required'=>'手机号必须输入',
            'tel.numeric'=>'手机号必须是数字',
            'oprice.required'=>'订单价格必须输入'
        ];
        $validator =  Validator::make($input,$rule,$mess);
        if ($validator->fails()) {
            return redirect('/admin/order/edit/'.$id)
                ->withErrors($validator)
                ->withInput();
        }

        $row =  Order::where('oid',$id)->update($input);

       if($row)
       {
           return redirect('admin/order/index');
           }else{
               return redirect('admin/order/edit/'.$id);
           }
       }
}
