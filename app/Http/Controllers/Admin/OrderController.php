<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Order_details;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
}
