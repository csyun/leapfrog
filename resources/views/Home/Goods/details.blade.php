<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<title>商品页面</title>

	<link href="{{asset('Home/assets/css/admin.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('Home/assets/css/amazeui.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('/Home/basic/css/demo.css')}}" rel="stylesheet" type="text/css" />
	<link type="text/css" href="{{asset('Home/css/optstyle.css')}}" rel="stylesheet" />
	<link type="text/css" href="{{asset('Home/css/style.css')}}" rel="stylesheet" />

	<script type="text/javascript" src="{{asset('Home/basic/js/jquery-1.7.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('Home/basic/js/quick_links.js')}}"></script>

	<script type="text/javascript" src="{{asset('Home/assets/js/amazeui.js')}}"></script>
	<script type="text/javascript" src="{{asset('Home/js/jquery.imagezoom.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('Home/js/jquery.flexslider.js')}}"></script>
	<script type="text/javascript" src="{{asset('Home/js/list.js')}}"></script>

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
				<div class="menu-hd"><a id="mc-menu-hd" href="{{url('/home/shopcart/cart/index')}}" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">0</strong></a></div>
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
			<form action="{{url('/home/goods/seach')}}" method="post">
				{{csrf_field()}}
				<input id="searchInput" name="gname" type="text" placeholder="搜索" autocomplete="off">
				<input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit">
			</form>
		</div>
	</div>

	<div class="clear"></div>
</div>



	<ol class="am-breadcrumb am-breadcrumb-slash">
		<li><a href="#">首页</a></li>
		<li><a href="#">分类</a></li>
		<li class="am-active">内容</li>
	</ol>
	<script type="text/javascript">
        $(function() {});
        $(window).load(function() {
            $('.flexslider').flexslider({
                animation: "slide",
                start: function(slider) {
                    $('body').removeClass('loading');
                }
            });
        });
	</script>
	<div class="scoll">
		<section class="slider">
			<div class="flexslider">
				<ul class="slides">
					<li>
						<img src="../images/01.jpg" title="pic" />
					</li>
					<li>
						<img src="../images/02.jpg" />
					</li>
					<li>
						<img src="../images/03.jpg" />
					</li>
				</ul>
			</div>
		</section>
	</div>

	<!--放大镜-->

	<div class="item-inform">
		<div class="clearfixLeft" id="clearcontent">

			<div class="box">
				<script type="text/javascript">
                    $(document).ready(function() {
                        $(".jqzoom").imagezoom();
                        $("#thumblist li a").click(function() {
                            $(this).parents("li").addClass("tb-selected").siblings().removeClass("tb-selected");
                            $(".jqzoom").attr('src', $(this).find("img").attr("mid"));
                            $(".jqzoom").attr('rel', $(this).find("img").attr("big"));
                        });
                    });
				</script>

				<div class="tb-booth tb-pic tb-s310">
					<a href=""><img src="{{$goods->gpurl}}" alt="细节展示放大镜特效" rel="{{$goods->gpurl}}" class="jqzoom" /></a>
				</div>

			</div>

			<div class="clear"></div>
		</div>

		<div class="clearfixRight">

			<!--规格属性-->
			<!--名称-->
			<div class="tb-detail-hd">
				<h1>
					{{$goods->gname	}}
				</h1>
			</div>
			<div class="tb-detail-list">
				<!--价格-->
				<div class="tb-detail-price">
					<li class="price iteminfo_price">
						<dt>价格</dt>
						<dd><em>¥</em><b class="sys_item_price">{{$goods->gprice}}</b>  </dd>
					</li>
					<div class="clear"></div>
				</div>

				<!--地址-->


				<!--销量-->
				<div class="clear"></div>

				<!--各种规格-->
				<dl class="iteminfo_parameter sys_item_specpara">
					<dt class="theme-login"><div class="cart-title">可选规格<span class="am-icon-angle-right"></span></div></dt>
					<dd>
						<!--操作页面-->

						<div class="theme-popover-mask"></div>

						<div class="theme-popover">
							<div class="theme-span"></div>
							<div class="theme-poptit">
								<a href="javascript:;" title="关闭" class="close">×</a>
							</div>
							<div class="theme-popbod dform">
								<form class="theme-signin" name="loginform" action="" method="post">

									<div class="theme-signin-left">

										<div class="theme-options">
											<div class="cart-title">成色</div>
											<ul>
												<li class="sku-line selected">九成新<i></i></li>
											</ul>
										</div>
			<div class="clear"></div>

		</div>

		</form>
	</div>
</div>

</dd>
</dl>
<div class="clear"></div>
<!--活动	-->
<div class="shopPromotion gold">
	<div class="hot">

		<div class="gold-list">

		</div>
	</div>
	<div class="clear"></div>
</div>
</div>

<div class="pay">
	<div class="pay-opt">
		<a href="home.html"><span class="am-icon-home am-icon-fw">首页</span></a>
		<a><span class="am-icon-heart am-icon-fw">收藏</span></a>

	</div>
	<li>
		<div class="clearfix tb-btn tb-btn-buy theme-login">
			<a id="LikBuy" title="点此按钮到下一步确认购买信息" href="#">立即购买</a>
		</div>
	</li>
	<li>
		<div class="clearfix tb-btn tb-btn-basket theme-login">
			<a id="LikBasket" title="加入购物车"href="javascript:;" onclick="toCart({{$goods->gid}})"><i></i>加入购物车</a>
		</div>
	</li>
</div>
			<script>
                function toCart(gid) {
                    $.get("{{url('/home/shopcart')}}/" + gid, function (data) {
//                    添加成功
                        if (data.error == 0) {
                            layer.msg(data.msg, {icon: 6});
//                var t = setTimeout("location.href = location.href;", 2000);
                        } else if (data.error == 1) {
                            layer.msg(data.msg, {icon: 5});
//                var t = setTimeout("location.href = location.href;", 2000);
                        }else{
                            layer.msg(data.msg, {icon: 2});
//                var t = setTimeout("location.href = location.href;", 2000);
                        }
                    });
                }

			</script>

</div>

<div class="clear"></div>

</div>



<!-- introduce-->

<div class="introduce">
	<div class="browse">
		<div class="mc">

		</div>
	</div>
	<div class="introduceMain">
		<div class="am-tabs" data-am-tabs>
			<ul class="am-avg-sm-3 am-tabs-nav am-nav am-nav-tabs">
				<li class="am-active">
					<a href="#">

						<span class="index-needs-dt-txt">宝贝详情</span></a>

				</li>

			</ul>

			<div class="am-tabs-bd">

				<div class="am-tab-panel am-fade am-in am-active">
					<div class="J_Brand">

					</div>

					<div class="details">
						<div class="attr-list-hd after-market-hd">
							<h4>商品细节</h4>
						</div>
						<div class="twlistNews">
						{!!  $goods->gdesc!!}
						</div>
					</div>
					<div class="clear"></div>

				</div>

				<div class="am-tab-panel am-fade">


					<div class="clear"></div>
					<div class="tb-r-filter-bar">

					</div>
					<div class="clear"></div>


					</div>
					<div class="clear"></div>




				</div>

			</div>

		</div>

		<div class="clear"></div>

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
<script src="{{asset('/layer/layer.js')}}"></script>
</body>

</html>