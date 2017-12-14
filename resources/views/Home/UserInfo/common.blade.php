@extends('Layouts.home')
@section('title')
    <title>个人中心</title>
@endsection
@section('body')
    <link href="{{asset('/Home/css/infstyle.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/Home/css/addstyle.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/Home/css/systyle.css')}}" rel="stylesheet" type="text/css">
    <div class="center">
        <div class="col-main">
            <div class="main-wrap">
                <div class="wrap-left">
                    <div class="wrap-list">

                        <div class="box-container-bottom"></div>

                        @yield('content')
                        <!--九宫格-->
                        <div class="user-squaredIcon">
                            <div class="s-bar">
                                <i class="s-icon"></i>我的常用
                            </div>
                            <ul>
                                <a href="order.html">
                                    <li class="am-u-sm-4"><i class="am-icon-truck am-icon-md"></i>
                                        <p>物流查询</p>
                                    </li>
                                </a>
                                <a href="collection.html">
                                    <li class="am-u-sm-4"><i class="am-icon-heart am-icon-md"></i>
                                        <p>我的收藏</p>
                                    </li>
                                </a>
                                <a href="foot.html">
                                    <li class="am-u-sm-4"><i class="am-icon-paw am-icon-md"></i>
                                        <p>我的足迹</p>
                                    </li>
                                </a>
                                <a href="#">
                                    <li class="am-u-sm-4"><i class="am-icon-gift am-icon-md"></i>
                                        <p>为你推荐</p>
                                    </li>
                                </a>
                                <a href="blog.html">
                                    <li class="am-u-sm-4"><i class="am-icon-share-alt am-icon-md"></i>
                                        <p>我的分享</p>
                                    </li>
                                </a>
                                <a href="../home/home2.html">
                                    <li class="am-u-sm-4"><i class="am-icon-clock-o am-icon-md"></i>
                                        <p>限时活动</p>
                                    </li>
                                </a>

                            </ul>
                        </div>

                        <div class="user-suggestion">
                            <div class="s-bar">
                                <i class="s-icon"></i>会员中心
                            </div>
                            <div class="s-bar">
                                <a href="suggest.html"><i class="s-icon"></i>意见反馈</a>
                            </div>
                        </div>



                    </div>
                </div>
                <div class="wrap-right">

                    <!-- 日历-->

                    <!--新品 -->



                </div>
                <div class="clear"></div>



            </div>
            <!--底部-->


        </div>

        <aside class="menu">
            <ul>
                <li class="person active">
                    <a href="index.html"><i class="am-icon-user"></i>个人中心</a>
                </li>
                <li class="person">
                    <p><i class="am-icon-newspaper-o"></i>个人资料</p>
                    <ul>
                        <li> <a href="{{url('/userinfo/information')}}">个人信息</a></li>
                        <li> <a href="{{url('/userinfo/addr')}}">地址管理</a></li>

                    </ul>
                </li>
                <li class="person">
                    <p><i class="am-icon-balance-scale"></i>我的交易</p>
                    <ul>
                        <li><a href="{{url('/userinfo')}}">购买订单管理</a></li>
                        <li> <a href="{{url('/userinfo/recycleorder')}}">回收订单管理</a></li>
                        <li> <a href="{{url('userinfo/myaddgoods')}}">已发布商品</a></li>
                    </ul>
                </li>
                
            </ul>

        </aside>
    </div>
    <!--引导 -->
    <div class="navCir">
        <li><a href="../home/home2.html"><i class="am-icon-home "></i>首页</a></li>
        <li><a href="../home/sort.html"><i class="am-icon-list"></i>分类</a></li>
        <li><a href="../home/shopcart.html"><i class="am-icon-shopping-basket"></i>购物车</a></li>
        <li class="active"><a href="index.html"><i class="am-icon-user"></i>我的</a></li>
    </div>

@endsection