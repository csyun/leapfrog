@extends('Home.UserInfo.common')
@section('content')
    <link href="{{asset('/Home/css/orstyle.css')}}" rel="stylesheet" type="text/css">

    <div class="info-main">
            <div class="am-form-group">
                <label for="user-name2" class="am-form-label">收货人:{{$order->rec}}</label>

            </div>
            <div class="am-form-group">
                <label for="user-phone" class="am-form-label">电话:{{$order->tel}}</label>
            </div>

            <div class="am-form-group">
                <label for="user-phone" class="am-form-label">收货地址:{{$order->addr}}</label>
                <div class="am-form-content">

                </div>
            </div>

            <div class="am-form-group">
                <label for="user-email" class="am-form-label">购买商品:</label>

            </div>
        <div class="order-left">
            @foreach($info as $k=>$v)
            <ul class="item-list" style="width: 900px;">
                <li class="td td-item" style="width: 140px;">
                    <div class="item-pic" style="margin-top: 5px;margin-left: 5px;">
                        <a href="#" class="J_MakePoint">
                            <img src="{{$v->goods->gpurl}}" class="itempic J_ItemImg">
                        </a>
                    </div>

                </li>
                <li class="td td-price" style="width: 80px;text-align: left;">
                    <div class="item-price">
                        价格:{{$v->goods->gprice}}
                    </div>
                </li>
                <li class="td td-price">
                    <div class="item-price" style="width: 300px;text-align: left;">
                        商品名称:{{$v->goods->gname}}
                    </div>
                </li>
                <li class="td td-price">
                    <div class="item-price" style="width: 300px;">
                        商品描述:{!! $v->goods->gdesc !!}
                    </div>
                </li>

            </ul>
        @endforeach


        </div>

    </div>
@endsection