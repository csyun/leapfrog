@extends('Layouts.home')
@section('title')
	<title>商品详情</title>
@endsection
@section('body')
	<link type="text/css" href="{{asset('/Home/css/style.css')}}" rel="stylesheet" />
	<script type="text/javascript" src="{{asset('/Home/basic/js/jquery-1.7.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('/Home/basic/js/quick_links.js')}}"></script>
	<script type="text/javascript" src="{{asset('/Home/js/jquery.imagezoom.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('/Home/js/jquery.flexslider.js')}}"></script>
	<script type="text/javascript" src="{{asset('/Home/js/list.js')}}"></script>
	<ol class="am-breadcrumb am-breadcrumb-slash">
		<li><a href="{{url('/')}}">首页</a></li>
		<li><a href="{{url('/home/goods/list/'.$goods->cid)}}">分类</a></li>
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
					<a href="{{$goods->gpurl}}"><img src="{{$goods->gpurl}}" alt="细节展示放大镜特效" rel="{{$goods->gpurl}}" class="jqzoom" /></a>
				</div>
				<ul class="tb-thumb" id="thumblist">
					<li class="tb-selected">
						<div class="tb-pic tb-s40">
							<a href="#"><img src="{{$goods->gpurl}}" mid="{{$goods->gpurl}}" big="{{$goods->gpurl}}"></a>
						</div>
					</li>
					<li>
						<div class="tb-pic tb-s40">
							<a href="#"><img src="{{$goods->gpurl}}" mid="{{$goods->gpurl}}" big="{{$goods->gpurl}}"></a>
						</div>
					</li>
					<li>
						<div class="tb-pic tb-s40">
							<a href="#"><img src="{{$goods->gpurl}}" mid="{{$goods->gpurl}}" big="{{$goods->gpurl}}"></a>
						</div>
					</li>
				</ul>
			</div>

			<div class="clear"></div>
		</div>

		<div class="clearfixRight">

			<!--规格属性-->
			<!--名称-->
			<div class="tb-detail-hd">
				<h1>
					{{$goods->gname}}
				</h1>
			</div>
			<div class="tb-detail-list">
				<!--价格-->
				<div class="tb-detail-price">
					<li class="price iteminfo_price">
						<dt>价格</dt>
						<dd><em>¥</em><b class="sys_item_price">{{$goods->gprice}}</b>  </dd>
					</li>
					<li class="price iteminfo_mktprice">
						<dt>成色</dt>
						<dd><p>八成新<span></span></p></dd>
					</li>
					<div class="clear"></div>
				</div>




	<div class="clear"></div>
	<!--所在地	-->
	<div class="shopPromotion gold">
		<div class="hot">
			<dt class="tb-metatit">所在地</dt>
			<div class="gold-list">
				<p>北京<span></span></p>
			</div>
		</div>
		<div class="clear"></div>

	</div>
	</div>

	<div class="pay">
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
	<div class="introduce">
		<div class="browse">
			<div class="mc">
				<ul>
					<div class="mt">
						<h2>看了又看</h2>
					</div>

					<li class="first">
						<div class="p-img">
							<a  href="#"> <img class="" src="../images/browse1.jpg"> </a>
						</div>
						<div class="p-name"><a href="#">
								【三只松鼠_开口松子】零食坚果特产炒货东北红松子原味
							</a>
						</div>
						<div class="p-price"><strong>￥35.90</strong></div>
					</li>
					<li>
						<div class="p-img">
							<a  href="#"> <img class="" src="../images/browse1.jpg"> </a>
						</div>
						<div class="p-name"><a href="#">
								【三只松鼠_开口松子】零食坚果特产炒货东北红松子原味
							</a>
						</div>
						<div class="p-price"><strong>￥35.90</strong></div>
					</li>
					<li>
						<div class="p-img">
							<a  href="#"> <img class="" src="../images/browse1.jpg"> </a>
						</div>
						<div class="p-name"><a href="#">
								【三只松鼠_开口松子】零食坚果特产炒货东北红松子原味
							</a>
						</div>
						<div class="p-price"><strong>￥35.90</strong></div>
					</li>
					<li>
						<div class="p-img">
							<a  href="#"> <img class="" src="../images/browse1.jpg"> </a>
						</div>
						<div class="p-name"><a href="#">
								【三只松鼠_开口松子】零食坚果特产炒货东北红松子原味
							</a>
						</div>
						<div class="p-price"><strong>￥35.90</strong></div>
					</li>
					<li>
						<div class="p-img">
							<a  href="#"> <img class="" src="../images/browse1.jpg"> </a>
						</div>
						<div class="p-name"><a href="#">
								【三只松鼠_开口松子218g】零食坚果特产炒货东北红松子原味
							</a>
						</div>
						<div class="p-price"><strong>￥35.90</strong></div>
					</li>

				</ul>
			</div>
		</div>
		<div class="introduceMain">
			<div class="am-tabs" data-am-tabs>
				<ul class="am-avg-sm-3 am-tabs-nav am-nav am-nav-tabs">
					<li class="am-active">
						<a href="#">

							<span class="index-needs-dt-txt">宝贝详情</span></a>

					</li>

					<li>
						<a href="#">

							<span class="index-needs-dt-txt">全部评价</span></a>

					</li>

					<li>
						<a href="#">

							<span class="index-needs-dt-txt">猜你喜欢</span></a>
					</li>
				</ul>

				<div class="am-tabs-bd">

					<div class="am-tab-panel am-fade am-in am-active">
						<div class="J_Brand">

							<div class="attr-list-hd tm-clear">
								<h4>产品参数：</h4></div>
							<div class="clear"></div>
							<ul id="J_AttrUL">
								<li title="">产品类型:&nbsp;烘炒类</li>
								<li title="">原料产地:&nbsp;巴基斯坦</li>
								<li title="">产地:&nbsp;湖北省武汉市</li>
								<li title="">配料表:&nbsp;进口松子、食用盐</li>
								<li title="">产品规格:&nbsp;210g</li>
								<li title="">保质期:&nbsp;180天</li>
								<li title="">产品标准号:&nbsp;GB/T 22165</li>
								<li title="">生产许可证编号：&nbsp;QS4201 1801 0226</li>
								<li title="">储存方法：&nbsp;请放置于常温、阴凉、通风、干燥处保存 </li>
								<li title="">食用方法：&nbsp;开袋去壳即食</li>
							</ul>
							<div class="clear"></div>
						</div>

						<div class="details">
							<div class="attr-list-hd after-market-hd">
								<h4>商品细节</h4>
							</div>
							<div class="twlistNews">
								{!!$goods->gdesc!!}
							</div>
						</div>
						<div class="clear"></div>

					</div>

					<div class="am-tab-panel am-fade">

						<div class="actor-new">
							<div class="rate">
								<strong>100<span>%</span></strong><br> <span>好评度</span>
							</div>
							<dl>
								<dt>买家印象</dt>
								<dd class="p-bfc">
									<q class="comm-tags"><span>味道不错</span><em>(2177)</em></q>
									<q class="comm-tags"><span>颗粒饱满</span><em>(1860)</em></q>
									<q class="comm-tags"><span>口感好</span><em>(1823)</em></q>
									<q class="comm-tags"><span>商品不错</span><em>(1689)</em></q>
									<q class="comm-tags"><span>香脆可口</span><em>(1488)</em></q>
									<q class="comm-tags"><span>个个开口</span><em>(1392)</em></q>
									<q class="comm-tags"><span>价格便宜</span><em>(1119)</em></q>
									<q class="comm-tags"><span>特价买的</span><em>(865)</em></q>
									<q class="comm-tags"><span>皮很薄</span><em>(831)</em></q>
								</dd>
							</dl>
						</div>
						<div class="clear"></div>
						<div class="tb-r-filter-bar">
							<ul class=" tb-taglist am-avg-sm-4">
								<li class="tb-taglist-li tb-taglist-li-current">
									<div class="comment-info">
										<span>全部评价</span>
										<span class="tb-tbcr-num">(32)</span>
									</div>
								</li>

								<li class="tb-taglist-li tb-taglist-li-1">
									<div class="comment-info">
										<span>好评</span>
										<span class="tb-tbcr-num">(32)</span>
									</div>
								</li>

								<li class="tb-taglist-li tb-taglist-li-0">
									<div class="comment-info">
										<span>中评</span>
										<span class="tb-tbcr-num">(32)</span>
									</div>
								</li>

								<li class="tb-taglist-li tb-taglist-li--1">
									<div class="comment-info">
										<span>差评</span>
										<span class="tb-tbcr-num">(32)</span>
									</div>
								</li>
							</ul>
						</div>
						<div class="clear"></div>

						<ul class="am-comments-list am-comments-list-flip">
							<li class="am-comment">
								<!-- 评论容器 -->
								<a href="">
									<img class="am-comment-avatar" src="../images/hwbn40x40.jpg" />
									<!-- 评论者头像 -->
								</a>

								<div class="am-comment-main">
									<!-- 评论内容容器 -->
									<header class="am-comment-hd">
										<!--<h3 class="am-comment-title">评论标题</h3>-->
										<div class="am-comment-meta">
											<!-- 评论元数据 -->
											<a href="#link-to-user" class="am-comment-author">b***1 (匿名)</a>
											<!-- 评论者 -->
											评论于
											<time datetime="">2015年11月02日 17:46</time>
										</div>
									</header>

									<div class="am-comment-bd">
										<div class="tb-rev-item " data-id="255776406962">
											<div class="J_TbcRate_ReviewContent tb-tbcr-content ">
												摸起来丝滑柔软，不厚，没色差，颜色好看！买这个衣服还接到诈骗电话，我很好奇他们是怎么知道我买了这件衣服，并且还知道我的电话的！
											</div>
											<div class="tb-r-act-bar">
												颜色分类：柠檬黄&nbsp;&nbsp;尺码：S
											</div>
										</div>

									</div>
									<!-- 评论内容 -->
								</div>
							</li>
							<li class="am-comment">
								<!-- 评论容器 -->
								<a href="">
									<img class="am-comment-avatar" src="../images/hwbn40x40.jpg" />
									<!-- 评论者头像 -->
								</a>

								<div class="am-comment-main">
									<!-- 评论内容容器 -->
									<header class="am-comment-hd">
										<!--<h3 class="am-comment-title">评论标题</h3>-->
										<div class="am-comment-meta">
											<!-- 评论元数据 -->
											<a href="#link-to-user" class="am-comment-author">l***4 (匿名)</a>
											<!-- 评论者 -->
											评论于
											<time datetime="">2015年10月28日 11:33</time>
										</div>
									</header>

									<div class="am-comment-bd">
										<div class="tb-rev-item " data-id="255095758792">
											<div class="J_TbcRate_ReviewContent tb-tbcr-content ">
												没有色差，很暖和……美美的
											</div>
											<div class="tb-r-act-bar">
												颜色分类：蓝调灰&nbsp;&nbsp;尺码：2XL
											</div>
										</div>

									</div>
									<!-- 评论内容 -->
								</div>
							</li>
							<li class="am-comment">
								<!-- 评论容器 -->
								<a href="">
									<img class="am-comment-avatar" src="../images/hwbn40x40.jpg" />
									<!-- 评论者头像 -->
								</a>

								<div class="am-comment-main">
									<!-- 评论内容容器 -->
									<header class="am-comment-hd">
										<!--<h3 class="am-comment-title">评论标题</h3>-->
										<div class="am-comment-meta">
											<!-- 评论元数据 -->
											<a href="#link-to-user" class="am-comment-author">b***1 (匿名)</a>
											<!-- 评论者 -->
											评论于
											<time datetime="">2015年11月02日 17:46</time>
										</div>
									</header>

									<div class="am-comment-bd">
										<div class="tb-rev-item " data-id="255776406962">
											<div class="J_TbcRate_ReviewContent tb-tbcr-content ">
												摸起来丝滑柔软，不厚，没色差，颜色好看！买这个衣服还接到诈骗电话，我很好奇他们是怎么知道我买了这件衣服，并且还知道我的电话的！
											</div>
											<div class="tb-r-act-bar">
												颜色分类：柠檬黄&nbsp;&nbsp;尺码：S
											</div>
										</div>

									</div>
									<!-- 评论内容 -->
								</div>
							</li>
							<li class="am-comment">
								<!-- 评论容器 -->
								<a href="">
									<img class="am-comment-avatar" src="../images/hwbn40x40.jpg" />
									<!-- 评论者头像 -->
								</a>

								<div class="am-comment-main">
									<!-- 评论内容容器 -->
									<header class="am-comment-hd">
										<!--<h3 class="am-comment-title">评论标题</h3>-->
										<div class="am-comment-meta">
											<!-- 评论元数据 -->
											<a href="#link-to-user" class="am-comment-author">h***n (匿名)</a>
											<!-- 评论者 -->
											评论于
											<time datetime="">2015年11月25日 12:48</time>
										</div>
									</header>

									<div class="am-comment-bd">
										<div class="tb-rev-item " data-id="258040417670">
											<div class="J_TbcRate_ReviewContent tb-tbcr-content ">
												式样不错，初冬穿
											</div>
											<div class="tb-r-act-bar">
												颜色分类：柠檬黄&nbsp;&nbsp;尺码：L
											</div>
										</div>
									</div>
									<!-- 评论内容 -->
								</div>
							</li>

							<li class="am-comment">
								<!-- 评论容器 -->
								<a href="">
									<img class="am-comment-avatar" src="../images/hwbn40x40.jpg" />
									<!-- 评论者头像 -->
								</a>

								<div class="am-comment-main">
									<!-- 评论内容容器 -->
									<header class="am-comment-hd">
										<!--<h3 class="am-comment-title">评论标题</h3>-->
										<div class="am-comment-meta">
											<!-- 评论元数据 -->
											<a href="#link-to-user" class="am-comment-author">b***1 (匿名)</a>
											<!-- 评论者 -->
											评论于
											<time datetime="">2015年11月02日 17:46</time>
										</div>
									</header>

									<div class="am-comment-bd">
										<div class="tb-rev-item " data-id="255776406962">
											<div class="J_TbcRate_ReviewContent tb-tbcr-content ">
												摸起来丝滑柔软，不厚，没色差，颜色好看！买这个衣服还接到诈骗电话，我很好奇他们是怎么知道我买了这件衣服，并且还知道我的电话的！
											</div>
											<div class="tb-r-act-bar">
												颜色分类：柠檬黄&nbsp;&nbsp;尺码：S
											</div>
										</div>

									</div>
									<!-- 评论内容 -->
								</div>
							</li>
							<li class="am-comment">
								<!-- 评论容器 -->
								<a href="">
									<img class="am-comment-avatar" src="../images/hwbn40x40.jpg" />
									<!-- 评论者头像 -->
								</a>

								<div class="am-comment-main">
									<!-- 评论内容容器 -->
									<header class="am-comment-hd">
										<!--<h3 class="am-comment-title">评论标题</h3>-->
										<div class="am-comment-meta">
											<!-- 评论元数据 -->
											<a href="#link-to-user" class="am-comment-author">l***4 (匿名)</a>
											<!-- 评论者 -->
											评论于
											<time datetime="">2015年10月28日 11:33</time>
										</div>
									</header>

									<div class="am-comment-bd">
										<div class="tb-rev-item " data-id="255095758792">
											<div class="J_TbcRate_ReviewContent tb-tbcr-content ">
												没有色差，很暖和……美美的
											</div>
											<div class="tb-r-act-bar">
												颜色分类：蓝调灰&nbsp;&nbsp;尺码：2XL
											</div>
										</div>

									</div>
									<!-- 评论内容 -->
								</div>
							</li>
							<li class="am-comment">
								<!-- 评论容器 -->
								<a href="">
									<img class="am-comment-avatar" src="../images/hwbn40x40.jpg" />
									<!-- 评论者头像 -->
								</a>

								<div class="am-comment-main">
									<!-- 评论内容容器 -->
									<header class="am-comment-hd">
										<!--<h3 class="am-comment-title">评论标题</h3>-->
										<div class="am-comment-meta">
											<!-- 评论元数据 -->
											<a href="#link-to-user" class="am-comment-author">b***1 (匿名)</a>
											<!-- 评论者 -->
											评论于
											<time datetime="">2015年11月02日 17:46</time>
										</div>
									</header>

									<div class="am-comment-bd">
										<div class="tb-rev-item " data-id="255776406962">
											<div class="J_TbcRate_ReviewContent tb-tbcr-content ">
												摸起来丝滑柔软，不厚，没色差，颜色好看！买这个衣服还接到诈骗电话，我很好奇他们是怎么知道我买了这件衣服，并且还知道我的电话的！
											</div>
											<div class="tb-r-act-bar">
												颜色分类：柠檬黄&nbsp;&nbsp;尺码：S
											</div>
										</div>

									</div>
									<!-- 评论内容 -->
								</div>
							</li>
							<li class="am-comment">
								<!-- 评论容器 -->
								<a href="">
									<img class="am-comment-avatar" src="../images/hwbn40x40.jpg" />
									<!-- 评论者头像 -->
								</a>

								<div class="am-comment-main">
									<!-- 评论内容容器 -->
									<header class="am-comment-hd">
										<!--<h3 class="am-comment-title">评论标题</h3>-->
										<div class="am-comment-meta">
											<!-- 评论元数据 -->
											<a href="#link-to-user" class="am-comment-author">h***n (匿名)</a>
											<!-- 评论者 -->
											评论于
											<time datetime="">2015年11月25日 12:48</time>
										</div>
									</header>

									<div class="am-comment-bd">
										<div class="tb-rev-item " data-id="258040417670">
											<div class="J_TbcRate_ReviewContent tb-tbcr-content ">
												式样不错，初冬穿
											</div>
											<div class="tb-r-act-bar">
												颜色分类：柠檬黄&nbsp;&nbsp;尺码：L
											</div>
										</div>
									</div>
									<!-- 评论内容 -->
								</div>
							</li>
							<li class="am-comment">
								<!-- 评论容器 -->
								<a href="">
									<img class="am-comment-avatar" src="../images/hwbn40x40.jpg" />
									<!-- 评论者头像 -->
								</a>

								<div class="am-comment-main">
									<!-- 评论内容容器 -->
									<header class="am-comment-hd">
										<!--<h3 class="am-comment-title">评论标题</h3>-->
										<div class="am-comment-meta">
											<!-- 评论元数据 -->
											<a href="#link-to-user" class="am-comment-author">b***1 (匿名)</a>
											<!-- 评论者 -->
											评论于
											<time datetime="">2015年11月02日 17:46</time>
										</div>
									</header>

									<div class="am-comment-bd">
										<div class="tb-rev-item " data-id="255776406962">
											<div class="J_TbcRate_ReviewContent tb-tbcr-content ">
												摸起来丝滑柔软，不厚，没色差，颜色好看！买这个衣服还接到诈骗电话，我很好奇他们是怎么知道我买了这件衣服，并且还知道我的电话的！
											</div>
											<div class="tb-r-act-bar">
												颜色分类：柠檬黄&nbsp;&nbsp;尺码：S
											</div>
										</div>

									</div>
									<!-- 评论内容 -->
								</div>
							</li>
							<li class="am-comment">
								<!-- 评论容器 -->
								<a href="">
									<img class="am-comment-avatar" src="../images/hwbn40x40.jpg" />
									<!-- 评论者头像 -->
								</a>

								<div class="am-comment-main">
									<!-- 评论内容容器 -->
									<header class="am-comment-hd">
										<!--<h3 class="am-comment-title">评论标题</h3>-->
										<div class="am-comment-meta">
											<!-- 评论元数据 -->
											<a href="#link-to-user" class="am-comment-author">l***4 (匿名)</a>
											<!-- 评论者 -->
											评论于
											<time datetime="">2015年10月28日 11:33</time>
										</div>
									</header>

									<div class="am-comment-bd">
										<div class="tb-rev-item " data-id="255095758792">
											<div class="J_TbcRate_ReviewContent tb-tbcr-content ">
												没有色差，很暖和……美美的
											</div>
											<div class="tb-r-act-bar">
												颜色分类：蓝调灰&nbsp;&nbsp;尺码：2XL
											</div>
										</div>

									</div>
									<!-- 评论内容 -->
								</div>
							</li>
							<li class="am-comment">
								<!-- 评论容器 -->
								<a href="">
									<img class="am-comment-avatar" src="../images/hwbn40x40.jpg" />
									<!-- 评论者头像 -->
								</a>

								<div class="am-comment-main">
									<!-- 评论内容容器 -->
									<header class="am-comment-hd">
										<!--<h3 class="am-comment-title">评论标题</h3>-->
										<div class="am-comment-meta">
											<!-- 评论元数据 -->
											<a href="#link-to-user" class="am-comment-author">b***1 (匿名)</a>
											<!-- 评论者 -->
											评论于
											<time datetime="">2015年11月02日 17:46</time>
										</div>
									</header>

									<div class="am-comment-bd">
										<div class="tb-rev-item " data-id="255776406962">
											<div class="J_TbcRate_ReviewContent tb-tbcr-content ">
												摸起来丝滑柔软，不厚，没色差，颜色好看！买这个衣服还接到诈骗电话，我很好奇他们是怎么知道我买了这件衣服，并且还知道我的电话的！
											</div>
											<div class="tb-r-act-bar">
												颜色分类：柠檬黄&nbsp;&nbsp;尺码：S
											</div>
										</div>

									</div>
									<!-- 评论内容 -->
								</div>
							</li>
							<li class="am-comment">
								<!-- 评论容器 -->
								<a href="">
									<img class="am-comment-avatar" src="../images/hwbn40x40.jpg" />
									<!-- 评论者头像 -->
								</a>

								<div class="am-comment-main">
									<!-- 评论内容容器 -->
									<header class="am-comment-hd">
										<!--<h3 class="am-comment-title">评论标题</h3>-->
										<div class="am-comment-meta">
											<!-- 评论元数据 -->
											<a href="#link-to-user" class="am-comment-author">h***n (匿名)</a>
											<!-- 评论者 -->
											评论于
											<time datetime="">2015年11月25日 12:48</time>
										</div>
									</header>

									<div class="am-comment-bd">
										<div class="tb-rev-item " data-id="258040417670">
											<div class="J_TbcRate_ReviewContent tb-tbcr-content ">
												式样不错，初冬穿
											</div>
											<div class="tb-r-act-bar">
												颜色分类：柠檬黄&nbsp;&nbsp;尺码：L
											</div>
										</div>
									</div>
									<!-- 评论内容 -->
								</div>
							</li>

						</ul>

						<div class="clear"></div>

						<!--分页 -->
						<ul class="am-pagination am-pagination-right">
							<li class="am-disabled"><a href="#">&laquo;</a></li>
							<li class="am-active"><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">5</a></li>
							<li><a href="#">&raquo;</a></li>
						</ul>
						<div class="clear"></div>

						<div class="tb-reviewsft">
							<div class="tb-rate-alert type-attention">购买前请查看该商品的 <a href="#" target="_blank">购物保障</a>，明确您的售后保障权益。</div>
						</div>

					</div>

					<div class="am-tab-panel am-fade">
						<div class="like">
							<ul class="am-avg-sm-2 am-avg-md-3 am-avg-lg-4 boxes">
								<li>
									<div class="i-pic limit">
										<img src="../images/imgsearch1.jpg" />
										<p>【良品铺子_开口松子】零食坚果特产炒货
											<span>东北红松子奶油味</span></p>
										<p class="price fl">
											<b>¥</b>
											<strong>298.00</strong>
										</p>
									</div>
								</li>
								<li>
									<div class="i-pic limit">
										<img src="../images/imgsearch1.jpg" />
										<p>【良品铺子_开口松子】零食坚果特产炒货
											<span>东北红松子奶油味</span></p>
										<p class="price fl">
											<b>¥</b>
											<strong>298.00</strong>
										</p>
									</div>
								</li>
								<li>
									<div class="i-pic limit">
										<img src="../images/imgsearch1.jpg" />
										<p>【良品铺子_开口松子】零食坚果特产炒货
											<span>东北红松子奶油味</span></p>
										<p class="price fl">
											<b>¥</b>
											<strong>298.00</strong>
										</p>
									</div>
								</li>
								<li>
									<div class="i-pic limit">
										<img src="../images/imgsearch1.jpg" />
										<p>【良品铺子_开口松子】零食坚果特产炒货
											<span>东北红松子奶油味</span></p>
										<p class="price fl">
											<b>¥</b>
											<strong>298.00</strong>
										</p>
									</div>
								</li>
								<li>
									<div class="i-pic limit">
										<img src="../images/imgsearch1.jpg" />
										<p>【良品铺子_开口松子】零食坚果特产炒货
											<span>东北红松子奶油味</span></p>
										<p class="price fl">
											<b>¥</b>
											<strong>298.00</strong>
										</p>
									</div>
								</li>
								<li>
									<div class="i-pic limit">
										<img src="../images/imgsearch1.jpg" />
										<p>【良品铺子_开口松子】零食坚果特产炒货
											<span>东北红松子奶油味</span></p>
										<p class="price fl">
											<b>¥</b>
											<strong>298.00</strong>
										</p>
									</div>
								</li>
								<li>
									<div class="i-pic limit">
										<img src="../images/imgsearch1.jpg" />
										<p>【良品铺子_开口松子】零食坚果特产炒货
											<span>东北红松子奶油味</span></p>
										<p class="price fl">
											<b>¥</b>
											<strong>298.00</strong>
										</p>
									</div>
								</li>
								<li>
									<div class="i-pic limit">
										<img src="../images/imgsearch1.jpg" />
										<p>【良品铺子_开口松子】零食坚果特产炒货
											<span>东北红松子奶油味</span></p>
										<p class="price fl">
											<b>¥</b>
											<strong>298.00</strong>
										</p>
									</div>
								</li>
								<li>
									<div class="i-pic limit">
										<img src="../images/imgsearch1.jpg" />
										<p>【良品铺子_开口松子】零食坚果特产炒货
											<span>东北红松子奶油味</span></p>
										<p class="price fl">
											<b>¥</b>
											<strong>298.00</strong>
										</p>
									</div>
								</li>
								<li>
									<div class="i-pic limit">
										<img src="../images/imgsearch1.jpg" />
										<p>【良品铺子_开口松子】零食坚果特产炒货
											<span>东北红松子奶油味</span></p>
										<p class="price fl">
											<b>¥</b>
											<strong>298.00</strong>
										</p>
									</div>
								</li>
								<li>
									<div class="i-pic limit">
										<img src="../images/imgsearch1.jpg" />
										<p>【良品铺子_开口松子】零食坚果特产炒货
											<span>东北红松子奶油味</span></p>
										<p class="price fl">
											<b>¥</b>
											<strong>298.00</strong>
										</p>
									</div>
								</li>
								<li>
									<div class="i-pic limit">
										<img src="../images/imgsearch1.jpg" />
										<p>【良品铺子_开口松子】零食坚果特产炒货
											<span>东北红松子奶油味</span></p>
										<p class="price fl">
											<b>¥</b>
											<strong>298.00</strong>
										</p>
									</div>
								</li>
							</ul>
						</div>
						<div class="clear"></div>

						<!--分页 -->
						<ul class="am-pagination am-pagination-right">
							<li class="am-disabled"><a href="#">&laquo;</a></li>
							<li class="am-active"><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">5</a></li>
							<li><a href="#">&raquo;</a></li>
						</ul>
						<div class="clear"></div>

					</div>

				</div>

			</div>

			<div class="clear"></div>



@stop