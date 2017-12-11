<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    //处理结算,添加订单
    public function doadd(Request $request)
    {
        $input = $request->except('_token');
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
        $validator =  Validator::make($input,$rule,$mess);
        if ($validator->fails()) {
            return redirect('/home/shopcart/cart/pay')
                ->withErrors($validator)
                ->withInput();
        }
    }
}
