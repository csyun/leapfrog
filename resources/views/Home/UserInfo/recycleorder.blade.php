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
                            <div class="orderContentBox">
                                <div class="orderContent">
                                    <div class="orderContentpic">
                                        <div class="imgBox">
                                            <a href="orderinfo.html"><img src="../images/youzi.jpg"></a>
                                        </div>
                                    </div>
                                    <div class="detailContent">
                                        <a href="orderinfo.html" class="delivery">签收</a>
                                        <div class="orderID">
                                            <span class="time">2016-03-09</span>
                                            <span class="splitBorder">|</span>
                                            <span class="time">21:52:47</span>
                                        </div>
                                        <div class="orderID">
                                            <span class="num">共1件商品</span>
                                        </div>
                                    </div>
                                    <div class="state">待评价</div>
                                    <div class="price"><span class="sym">¥</span>23.<span class="sym">80</span></div>

                                </div>
                                <a href="javascript:void(0);" class="btnPay">再次购买</a>
                            </div>

                            <div class="orderContentBox">
                                <div class="orderContent">
                                    <div class="orderContentpic">
                                        <div class="imgBox">
                                            <a href="orderinfo.html"><img src="../images/heart.jpg"></a>
                                        </div>
                                    </div>
                                    <div class="detailContent">
                                        <a href="orderinfo.html" class="delivery">派件</a>
                                        <div class="orderID">
                                            <span class="time">2016-03-09</span>
                                            <span class="splitBorder">|</span>
                                            <span class="time">21:52:47</span>
                                        </div>
                                        <div class="orderID">
                                            <span class="num">共2件商品</span>
                                        </div>
                                    </div>
                                    <div class="state">已发货</div>
                                    <div class="price"><span class="sym">¥</span>246.<span class="sym">50</span></div>

                                </div>
                                <a href="javascript:void(0);" class="btnPay">再次购买</a>
                            </div>
                        </div>
@endsection
