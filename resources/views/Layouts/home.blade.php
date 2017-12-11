<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		 @yield('title')

		<link href="{{asset('/Home/assets/css/amazeui.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('/Home/assets/css/admin.css')}}" rel="stylesheet" type="text/css" />

		<link href="{{asset('/Home/basic/css/demo.css')}}" rel="stylesheet" type="text/css" />

		<link href="{{asset('/Home/css/hmstyle.css')}}" rel="stylesheet" type="text/css" />
		<script src="{{asset('/Home/assets/js/jquery.min.js')}}"></script>
		<script src="{{asset('/Home/assets/js/amazeui.min.js')}}"></script>
		<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link href="{{asset('/Home/css/personal.css')}}" rel="stylesheet" type="text/css">



	</head>

	<body style="background-color: #ffffff;">
	<div class="hmtop">
			<!--顶部导航条 -->
			<div class="am-container header">
				<ul class="message-l">
					<div class="topMessage">
						<div class="menu-hd">
							<a href="{{url('/login')}}" target="_top" class="h">亲，请登录</a>
							<a href="{{url('/register')}}" target="_top">免费注册</a>
						</div>
					</div>
				</ul>
				<ul class="message-r">
					<div class="topMessage home">
						<div class="menu-hd"><a href="#" target="_top" class="h">商城首页</a></div>
					</div>
					<div class="topMessage my-shangcheng">
						<div class="menu-hd MyShangcheng"><a href="#" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
					</div>
					<div class="topMessage mini-cart">
						<div class="menu-hd"><a id="mc-menu-hd" href="#" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">0</strong></a></div>
					</div>
					<div class="topMessage favorite">
						<div class="menu-hd"><a href="#" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
				</ul>
			</div>

				<!--悬浮搜索框-->

			<div class="nav white">
				<div class="logo"><img src="{{asset('/Home/images/logo-home.png')}}" /></div>
				<div class="logoBig">



				</div>

				<div class="search-bar pr">
					<a name="index_none_header_sysc" href="#"></a>
					<form>
						<input id="searchInput" name="index_none_header_sysc" type="text" placeholder="搜索" autocomplete="off">
						<input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit">
					</form>
				</div>
			</div>

			<div class="clear"></div>
		</div>

	<b class="line"></b>
	<div class="shopNav">
		<div class="slideall" style="height: auto;">

			<div class="long-title"><span class="all-goods"><img style="margin-top: -106px;" src="{{asset('/Home/images/logo.png')}}" /></span></div>
			<div class="nav-cont">
				<ul>
					<li class="index"><a href="http://leapfrog.com/">首页</a></li>
					@foreach($navs as $k=>$v)
					<li class="qc"><a href="{{url($v->nav_url)}}">{{$v->nav_name}}</a></li>
					@endforeach
				</ul>
				<div class="nav-extra">
					<a href="{{url('/pond/')}}"><i ></i><b style="background-image:url({{asset('/Home/images/logo-s.png')}}); height: 40px;margin-right:10px; "></b>蛙塘社区</a>
					<i class="am-icon-angle-right" style="padding-left: 10px;"></i>

				</div>

			</div>


	@section('body')
	@show
	<script>
			window.jQuery || document.write('<script src="{{asset('/Home/basic/js/jquery.min.js')}}"><\/script>');
		</script>
		<script type="text/javascript " src="{{asset('/Home/basic/js/quick_links.js')}} "></script>

		<div class="footer " style="text-align: center;">
						<div class="footer-hd ">
							<p style="text-align: center;">
								<a href="# ">曹守云</a>
								<b>|</b>
								<a href="# ">李瑞宸</a>
								<b>|</b>
								<a href="# ">苏波</a>
								<b>|</b>
								<a href="# ">李丹丹</a>
							</p>
						</div>
						<div class="footer-bd ">
							<p style="text-align: center;">

								<a href="# ">联系我们</a>
								<a href="# ">网站地图</a>
								<em>© 2015-2025 leapfrog.com 版权所有. 侵权必究</em>


							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>

		<!--引导 -->
		<div class="navCir">
			<li class="active"><a href="home2.html"><i class="am-icon-home "></i>首页</a></li>
			<li><a href="sort.html"><i class="am-icon-list"></i>分类</a></li>
			<li><a href="shopcart.html"><i class="am-icon-shopping-basket"></i>购物车</a></li>	
			<li><a href=""><i class="am-icon-user"></i>我的</a></li>					
		</div>
		<!--菜单 -->
		<div class=tip>
			<div id="sidebar">
				<div id="wrap">
					<div id="prof" class="item ">
						<a href="# ">
							<span class="setting "></span>
						</a>
						<div class="ibar_login_box status_login ">
							<div class="avatar_box ">
								<p class="avatar_imgbox "><img src="{{asset('/Home/images/no-img_mid_.jpg')}}" /></p>
								<ul class="user_info ">
									<li>用户名：sl1903</li>
									<li>级&nbsp;别：普通会员</li>
								</ul>
							</div>
							<div class="login_btnbox ">
								<a href="# " class="login_order ">我的订单</a>
								<a href="# " class="login_favorite ">我的收藏</a>
							</div>
							<i class="icon_arrow_white "></i>
						</div>

					</div>
					<div id="shopCart " class="item ">
						<a href="# ">
							<span class="message "></span>
						</a>
						<p>
							购物车
						</p>
						<p class="cart_num ">0</p>
					</div>
					<div id="asset " class="item ">
						<a href="# ">
							<span class="view "></span>
						</a>
						<div class="mp_tooltip ">
							我的资产
							<i class="icon_arrow_right_black "></i>
						</div>
					</div>

					<div id="foot " class="item ">
						<a href="# ">
							<span class="zuji "></span>
						</a>
						<div class="mp_tooltip ">
							我的足迹
							<i class="icon_arrow_right_black "></i>
						</div>
					</div>

					<div id="brand " class="item ">
						<a href="#">
							<span class="wdsc "><img src="{{asset('/Home/images/wdsc.png')}}" /></span>
						</a>
						<div class="mp_tooltip ">
							我的收藏
							<i class="icon_arrow_right_black "></i>
						</div>
					</div>

					<div id="broadcast " class="item ">
						<a href="# ">
							<span class="chongzhi "><img src="{{asset('/Home/images/chongzhi.png')}}" /></span>
						</a>
						<div class="mp_tooltip ">
							我要充值
							<i class="icon_arrow_right_black "></i>
						</div>
					</div>

					<div class="quick_toggle ">
						<li class="qtitem ">
							<a href="# "><span class="kfzx "></span></a>
							<div class="mp_tooltip ">客服中心<i class="icon_arrow_right_black "></i></div>
						</li>
						<!--二维码 -->
						<li class="qtitem ">
							<a href="#none "><span class="mpbtn_qrcode "></span></a>
							<div class="mp_qrcode " style="display:none; "><img src="{{asset('/Home/images/weixin_code_145.png')}}" /><i class="icon_arrow_white "></i></div>
						</li>
						<li class="qtitem ">
							<a href="#top " class="return_top "><span class="top "></span></a>
						</li>
					</div>

					<!--回到顶部 -->
					<div id="quick_links_pop " class="quick_links_pop hide "></div>

				</div>

			</div>
			<div id="prof-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					我
				</div>
			</div>
			<div id="shopCart-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					购物车
				</div>
			</div>
			<div id="asset-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					资产
				</div>

				<div class="ia-head-list ">
					<a href="# " target="_blank " class="pl ">
						<div class="num ">0</div>
						<div class="text ">优惠券</div>
					</a>
					<a href="# " target="_blank " class="pl ">
						<div class="num ">0</div>
						<div class="text ">红包</div>
					</a>
					<a href="# " target="_blank " class="pl money ">
						<div class="num ">￥0</div>
						<div class="text ">余额</div>
					</a>
				</div>

			</div>
			<div id="foot-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					足迹
				</div>
			</div>
			<div id="brand-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					收藏
				</div>
			</div>
			<div id="broadcast-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					充值
				</div>
			</div>
		</div>
	</body>

</html>