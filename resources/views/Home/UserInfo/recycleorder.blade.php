@extends('Home.UserInfo.common')
@section('content')
                 <!--订单 -->
                        <div class="m-order">
                            <div class="s-bar">
                                <i class="s-icon"></i>我的回收订单
                                <a class="i-load-more-item-shadow" href="order.html">全部订单</a>
                            </div>
                            @foreach($recycleorders as $k=>$v)
                            <div class="orderContentBox">
                                <div class="orderContent">
                                    <div class="orderContentpic">

                                        <div class="imgBox">
                                            <a href="orderinfo.html"><img src="http://leapfrog.oss-cn-beijing.aliyuncs.com/{{$v->rgpic}}"></a>
                                        </div>
                                    </div>
                                    <div class="detailContent">

                                        <div class="orderID">
                                            <span class="time">{{date('Y-m-d H:i:s',$v->creat_time)}}</span>

                                        </div>
                                        <div class="orderID">
                                            <span class="num">{{$v->rgname}}</span>
                                        </div>
                                        <div class="orderID">
                                            <span class="num">订单号:{{$v->roid}}</span>
                                        </div>
                                    </div>
                                    <div class="state">
                                        @if($v->status==0)已提交
                                            @elseif($v->status==1)已确认
                                        @elseif($v->status==2)上门回收中
                                        @elseif($v->status==3)已完成
                                            @endif
                                    </div>
                                    <div class="price"><span class="sym">¥</span>{{$v->rpice}}<span class="sym"></span></div>

                                </div>

                            </div>
                            @endforeach

                        </div>
@endsection
