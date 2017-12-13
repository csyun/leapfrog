@extends('Layouts.home')
@section('title')
    <title>跳蛙--首页</title>
@endsection
@section('body')


			    <div class="bannerTwo">
                      <!--轮播 -->
						<div class="am-slider am-slider-default scoll" data-am-flexslider id="demo-slider-0">
							<ul class="am-slides">
								@foreach($slideshows as $k=>$v)
								<li class="banner1"><a href="{{$v->surl}}"><img style="width: 760px;height: 320px;" src="http://leapfrog.oss-cn-beijing.aliyuncs.com/{{$v->art_thumb}}" /></a></li>

								@endforeach

							</ul>
						</div>
						<div class="clear"></div>
			    </div>

						<!--侧边导航 -->
						<div id="nav" class="navfull" style="position: static;height: 550px;">
							<div class="area clearfix">
								<div class="category-content" id="guide_2">

									<div class="category" style="box-shadow:none ;margin-top: 2px;">
										<ul class="category-list navTwo" id="js_climit_li">
											@foreach($cate as $k=>$v)
												@if($v->pid == 0)
											<li>

												<div class="category-info">

													<h3 class="category-name b-category-name"><i><img src="{{asset('/Home/images/cake.png')}}"></i><a class="ml-22" title="点心">{{$v->cname}}</a></h3>

													<em>&gt;</em></div>
												<div class="menu-item menu-in top">
													<div class="area-in">
														<div class="area-bg">
															<div class="menu-srot">
																<div class="sort-side">
																	@foreach($cate as $m=>$n)
																		@if($n->pid==$v->cid)
																	<dl class="dl-sort">
																		<dt><span ><a class="ml-22" href="{{url('home/goods/list/'.$n->cid)}}">{{$n->cname}}</a></span></dt>
																	</dl>
																		@endif
																	@endforeach
																</div>

															</div>
														</div>
													</div>
												</div>
											<b class="arrow"></b>
											</li>
													@endif
											@endforeach

										</ul>
									</div>
								</div>

							</div>
						</div>
						<!--导航 -->
						<script type="text/javascript">
							(function() {
								$('.am-slider').flexslider();
							});
							$(document).ready(function() {
								$("li").hover(function() {
									$(".category-content .category-list li.first .menu-in").css("display", "none");
									$(".category-content .category-list li.first").removeClass("hover");
									$(this).addClass("hover");
									$(this).children("div.menu-in").css("display", "block");
								}, function() {
									$(this).removeClass("hover")
									$(this).children("div.menu-in").css("display", "none")
								});

							})

						</script>
					<!--小导航 -->
					<div class="am-g am-g-fixed smallnav">
						<div class="am-u-sm-3">
							<a href="sort.html"><img src="{{asset('/Home/images/navsmall.jpg')}}" />
								<div class="title">商品分类</div>
							</a>
						</div>
						<div class="am-u-sm-3">
							<a href="#"><img src="{{asset('/Home/images/huismall.jpg')}}" />
								<div class="title">大聚惠</div>
							</a>
						</div>
						<div class="am-u-sm-3">
							<a href="#"><img src="{{asset('/Home/images/mansmall.jpg')}}" />
								<div class="title">个人中心</div>
							</a>
						</div>
						<div class="am-u-sm-3">
							<a href="#"><img src="{{asset('/Home/images/moneysmall.jpg')}}" />
								<div class="title">投资理财</div>
							</a>
						</div>
					</div>
				<!--各类活动-->
				<div class="row">

					@foreach($advers as $k=>$v)
					<li><a href="{{$v->aurl}}"><img style="width: 249px;height: 200px;" src="http://leapfrog.oss-cn-beijing.aliyuncs.com/{{$v->apic}}"/></a></li>
					@endforeach
				</div>
				<div class="clear"></div>
					<!--走马灯 -->
					<div class="marqueenTwo" style="height: 100px;">
						<span><a href=""><img style="width: 105px;height: 100%;margin-top: 1px;" src="{{asset('/Home/images/fabu.png')}}"></a></span>
						<span><a href="{{url('/recyclegoods')}}"><img style="width: 105px;height: 100%;" src="{{asset('/Home/images/huishou.png')}}"></a></span>
					</div>
					<div class="marqueenTwo" style="margin-top: 110px;">
						<span class="marqueen-title"><i class="am-icon-volume-up am-icon-fw"></i>头条资讯<em class="am-icon-angle-double-right"></em></span>
						<div class="demo">

							<ul>
								@foreach($articles as $k=>$v)
								<li class="title-first"><a target="_blank" href="#">
									<img src="{{asset('/Home/images/TJ2.jpg')}}"></img>
									<span>[{{$v->tags}}]</span><a href="{{url('/articles/')}}/{{$v->aid}}">{{$v->title}}</a>
								</a></li>
								@endforeach



							</ul>

						</div>
					</div>
					<div class="clear"></div>

				</div>


				<script type="text/javascript">
					if ($(window).width() < 640) {
						function autoScroll(obj) {
							$(obj).find("ul").animate({
								marginTop: "-39px"
							}, 500, function() {
								$(this).css({
									marginTop: "0px"
								}).find("li:first").appendTo(this);
							})
						}
						$(function() {
							setInterval('autoScroll(".demo")', 3000);
						})
					}
				</script>
			</div>
			<div class="shopMainbg">
				<div class="shopMain" id="shopmain">

					<!--热门活动 -->


					<div class="clear "></div>
            <div class="f1">
					<!--甜点-->

					@foreach($recommends as $k=>$v)
					<div class="am-container " >
						<div class="shopTitle ">
							<h4 class="floor-title" style="width: 150px;">{{$v->rname}}</h4>
							<div class="floor-subtitle" ><em class="am-icon-caret-left" style="margin-left: 100px;"></em><h3>{{$v->title}}</h3></div>
						</div>
					</div>

					<div class="am-g am-g-fixed floodSix ">

						<div class="am-u-sm-7 am-u-md-5 am-u-lg-2 text-two big">

								<div class="outer-con ">
									<div class="title ">


									</div>
									<div class="sub-title ">


									</div>

								</div>
								<a href="# "><img src="http://leapfrog.oss-cn-beijing.aliyuncs.com/{{$v->rpic}}" /></a>
						</div>

						<li>
						<div class="am-u-md-2 am-u-lg-2 text-three">
							<div class="boxLi"></div>
							<div class="outer-con ">
								<div class="title ">
									小优布丁
								</div>
								<div class="sub-title ">
									¥4.8
								</div>

							</div>
							<a href="# "><img src="{{asset('/Home/images/1.jpg')}} " /></a>
						</div>
						</li>
						<li>
						<div class="am-u-md-2 am-u-lg-2 text-three sug">
							<div class="boxLi"></div>
							<div class="outer-con ">
								<div class="title ">
									小优布丁
								</div>
								<div class="sub-title ">
									¥4.8
								</div>

							</div>
							<a href="# "><img src="{{asset('/Home/images/2.jpg')}} " /></a>
						</div>
						</li>
						<li>
						<div class="am-u-sm-4 am-u-md-5 am-u-lg-4 text-five">
							<div class="boxLi"></div>
							<div class="outer-con ">
								<div class="title ">
									小优布丁
								</div>
								<div class="sub-title ">
									¥4.8
								</div>

							</div>
							<a href="# "><img src="{{asset('/Home/images/5.jpg')}}" /></a>
						</div>
						</li>
						<li>
						<div class="am-u-sm-4 am-u-md-2 am-u-lg-2 text-six">
							<div class="boxLi"></div>
							<div class="outer-con ">
								<div class="title ">
									小优布丁
								</div>
								<div class="sub-title ">
									¥4.8
								</div>

							</div>
							<a href="# "><img src="{{asset('/Home/images/3.jpg')}}" /></a>
						</div>
						</li>
						<li>
						<div class="am-u-sm-4 am-u-md-2 am-u-lg-4 text-six">
							<div class="boxLi"></div>
							<div class="outer-con ">
								<div class="title ">
									小优布丁
								</div>
								<div class="sub-title ">
									¥4.8
								</div>

							</div>
							<a href="# "><img src="{{asset('/Home/images/4.jpg')}}" /></a>
						</div>
						</li>
					</div>

					<div class="clear "></div>
            </div>

	@endforeach


@endsection