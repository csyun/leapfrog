@extends('Layouts.home')
@section('title')
    <title>跳蛙--回收估价</title>
@endsection
@section('body')
    <link href="{{asset('/Home/huishou/common_new.css')}}" rel="Stylesheet" type="text/css">
    <link href="{{asset('/Home/huishou/index.css')}}" rel="stylesheet">
    <link href="{{asset('/Home/css/personal.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/Home/css/addstyle.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/Home/basic/css/demo.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('/Home/css/sustyle.css')}}" rel="stylesheet" type="text/css" />
    <script src="http://code.jquery.com/jquery-1.8.1.min.js"></script>

    <script src="{{asset('/Home/huishou/index_1211.js')}}"></script>
    <div><img src="{{asset('/Home/images/2017-12-06-1.png')}}" /></div>
    <div class="take-delivery">
        <div class="status">
            <h2>您已成功提交,请等待上门验收取货</h2>
            <div class="successInfo">
                <ul>

                    <div class="user-info">
                        <p>联系人：{{$recycleinfo['rcname']}}</p>
                        <p>联系电话：{{$recycleinfo['rctel']}}</p>
                        <p>验货地址：{{$recycleinfo['addr']}}</p>
                    </div>
                    请认真核对您的信息，如有错误请联系客服

                </ul>
                <div class="option">
                    <span class="info">您可以</span>
                    <a href="../person/order.html" class="J_MakePoint">查看<span>已买到的宝贝</span></a>
                    <a href="../person/orderinfo.html" class="J_MakePoint">查看<span>交易详情</span></a>
                </div>
            </div>
        </div>
    </div>
@endsection