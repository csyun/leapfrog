@extends('Home.UserInfo.common')
@section('content')
                 <!--订单 -->
                        <div class="m-order">
                            <div class="s-bar">
                                <i class="s-icon"></i>我的购买订单
                                <a class="i-load-more-item-shadow" href="order.html">全部订单</a>
                            </div>
                            <ul>
                                <li><a href="order.html"><i><img src="../images/pay.png"/></i><span>待付款</span></a></li>
                                <li><a href="order.html"><i><img src="../images/send.png"/></i><span>待发货<em class="m-num">1</em></span></a></li>
                                <li><a href="order.html"><i><img src="../images/receive.png"/></i><span>待收货</span></a></li>
                                <li><a href="order.html"><i><img src="../images/comment.png"/></i><span>待评价<em class="m-num">3</em></span></a></li>
                                <li><a href="change.html"><i><img src="../images/refund.png"/></i><span>退换货</span></a></li>
                            </ul>
                            @foreach($orders as $k=>$v)
                            <div class="orderContentBox">
                                <div class="orderContent">

                                    <div class="detailContent">

                                        <div class="orderID">
                                            <span class="time">下单时间:{{date('Y-m-d H:i:s',$v->creata_time)}}</span>
                                            <span class="splitBorder"></span>

                                        </div>
                                        <div class="orderID">
                                            <span class="num">订单号:{{$v->oid}}</span>
                                            <span class="time"><a href="{{url('/userinfo/orderdeta/'.$v->oid)}}" class="delivery">查看</a></span>
                                        </div>
                                    </div>
                                    <div class="state">
                                        @if($v->status==0)
                                            待发货
                                        @elseif($v->status==1)
                                            已发货
                                        <a href="{{url('home/order/status/'.$v->oid)}}" class="delivery">签收</a>
                                        @elseif($v->status==2)
                                            已收货
                                            @endif
                                    </div>
                                    <div class="price"><span class="sym">¥</span>{{$v->oprice}}<span class="sym"></span></div>

                                    <div class="price"><span class="sym">联系人</span>{{$v->rec}}<span class="sym"></span></div>

                                </div>

                            </div>
                          @endforeach
                        </div>
@endsection
