@extends('Layouts.home')
@section('title')
    <title>跳蛙--首页</title>
@endsection
@section('body')

		
          <b class="line"></b>
			<div class="shopNav">
				<div class="slideall" style="height: auto;">
			        
					   <div class="long-title"><span class="all-goods">全部分类</span></div>
					   <div class="nav-cont">
							<ul>
								<li class="index"><a href="#">首页</a></li>
                                <li class="qc"><a href="#">闪购</a></li>
                                <li class="qc"><a href="#">限时抢</a></li>
                                <li class="qc"><a href="#">团购</a></li>
                                <li class="qc last"><a href="#">大包装</a></li>
							</ul>
						    <div class="nav-extra">
						    	<i ></i><b style="background-image:url({{asset('/Home/images/logo-s.png')}}); height: 40px;margin-right:10px; "></b>蛙塘社区
						    	<i class="am-icon-angle-right" style="padding-left: 10px;"></i>

						    </div>

						</div>
                
			    <div class="bannerTwo">
                      <!--轮播 -->
						<div class="am-slider am-slider-default scoll" data-am-flexslider id="demo-slider-0">
							<ul class="am-slides">
								<li class="banner1"><a href="introduction.html"><img src="{{asset('/Home/images/ad5.jpg')}}" /></a></li>
								<li class="banner2"><a><img src="{{asset('/Home/images/ad6.jpg')}}" /></a></li>
								<li class="banner3"><a><img src="{{asset('/Home/images/ad7.jpg')}}" /></a></li>
								<li class="banner4"><a><img src="{{asset('/Home/images/ad8.jpg')}}" /></a></li>
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
											<li>
												<div class="category-info">
													<h3 class="category-name b-category-name"><i><img src="{{asset('/Home/images/cake.png')}}"></i><a class="ml-22" title="点心">点心/蛋糕</a></h3>
													<em>&gt;</em></div>
												<div class="menu-item menu-in top">
													<div class="area-in">
														<div class="area-bg">
															<div class="menu-srot">
																<div class="sort-side">
																	<dl class="dl-sort">
																	<dt><span title="蛋糕">蛋糕</span></dt>
																		<dd><a title="蒸蛋糕" href="#"><span>蒸蛋糕</span></a></dd>
																		<dd><a title="脱水蛋糕" href="#"><span>脱水蛋糕</span></a></dd>
																		<dd><a title="瑞士卷" href="#"><span>瑞士卷</span></a></dd>
																															
																	</dl>
																	<dl class="dl-sort">
																		<dt><span title="蛋糕">点心</span></dt>
																		<dd><a title="蒸蛋糕" href="#"><span>蒸蛋糕</span></a></dd>
																		
																		
																		<dd><a title="甜甜圈" href="#"><span>甜甜圈</span></a></dd>
																		<dd><a title="蒸三明治" href="#"><span>蒸三明治</span></a></dd>
																		<dd><a title="铜锣烧" href="#"><span>铜锣烧</span></a></dd>
																	</dl>

																</div>
																<div class="brand-side">
																	<dl class="dl-sort"><dt><span>实力商家</span></dt>
																		<dd><a rel="nofollow" title="呵官方旗舰店" target="_blank" href="#" rel="nofollow"><span  class="red" >呵官方旗舰店</span></a></dd>
																		<dd><a rel="nofollow" title="格瑞旗舰店" target="_blank" href="#" rel="nofollow"><span >格瑞旗舰店</span></a></dd>
																		
																	</dl>
																</div>
															</div>
														</div>
													</div>
												</div>
											<b class="arrow"></b>	
											</li>

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
									$(this).children("div.menu-in").css("display", "block")
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
					<li><a><img src="{{asset('/Home/images/row1.jpg')}}"/></a></li>
					<li><a><img src="{{asset('/Home/images/row2.jpg')}}"/></a></li>
					<li><a><img src="{{asset('/Home/images/row3.jpg')}}"/></a></li>
					<li><a><img src="{{asset('/Home/images/row4.jpg')}}"/></a></li>
				</div>
				<div class="clear"></div>	
					<!--走马灯 -->

					<div class="marqueenTwo">
						<span class="marqueen-title"><i class="am-icon-volume-up am-icon-fw"></i>商城头条<em class="am-icon-angle-double-right"></em></span>
						<div class="demo">

							<ul>
								<li class="title-first"><a target="_blank" href="#">
									<img src="{{asset('/Home/images/TJ2.jpg')}}"></img>
									<span>[特惠]</span>洋河年末大促，低至两件五折							
								</a></li>
								<li class="title-first"><a target="_blank" href="#">
									<span>[公告]</span>商城与广州市签署战略合作协议
								     <img src="{{asset('/Home/images/TJ.jpg')}}"></img>
								     <p>XXXXXXXXXXXXXXXXXX</p>
							    </a></li>																    							    
								<li><a target="_blank" href="#"><span>[特惠]</span>女生节商城爆品1分秒	</a></li>
								<li><a target="_blank" href="#"><span>[公告]</span>华北、华中部分地区配送延迟</a></li>
								<li><a target="_blank" href="#"><span>[特惠]</span>家电狂欢千亿礼券 买1送1！</a></li>
								<li><a target="_blank" href="#"><span>[特惠]</span>洋河年末大促，低至两件五折</a></li>
								<li><a target="_blank" href="#"><span>[公告]</span>华北、华中部分地区配送延迟</a></li>
						
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

					<div class="am-container">
					
                     <div class="sale-mt">
		                   <i></i>
		                   <em class="sale-title">限时秒杀</em>
		                   <div class="s-time" id="countdown">
			                    <span class="hh">01</span>
			                    <span class="mm">20</span>
			                    <span class="ss">59</span>
		                   </div>
	                  </div>

					
					  <div class="am-g am-g-fixed sale">
						<div class="am-u-sm-3 sale-item">
							<div class="s-img">
								<a href="# "><img src="{{asset('/Home/images/sale3.jpg')}}" /></a>
							</div>
                           <div class="s-info">
                           	   <a href="#"><p class="s-title">ZEK 原味海苔</p></a>
                           	   <div class="s-price">￥<b>9.90</b>
                           	   	  <a class="s-buy" href="#">秒杀</a>
                           	   </div>                          	  
                           </div>								
						</div>
						
						<div class="am-u-sm-3 sale-item">
							<div class="s-img">
								<a href="# "><img src="{{asset('/Home/images/sale2.jpg')}}" /></a>
							</div>
                           <div class="s-info">
                           	   <a href="#"><p class="s-title">ZEK 原味海苔</p></a>
                           	   <div class="s-price">￥<b>9.90</b>
                           	   	  <a class="s-buy" href="#">秒杀</a>
                           	   </div>                          	  
                           </div>								
						</div>					
						
						<div class="am-u-sm-3 sale-item">
							<div class="s-img">
								<a href="# "><img src="{{asset('/Home/images/sale1.jpg')}}" /></a>
							</div>
                           <div class="s-info">
                           	   <a href="#"><p class="s-title">ZEK 原味海苔</p></a>
                           	   <div class="s-price">￥<b>9.90</b>
                           	   	  <a class="s-buy" href="#">秒杀</a>
                           	   </div>                          	  
                           </div>								
						</div>
						
						<div class="am-u-sm-3 sale-item">
							<div class="s-img">
								<a href="# "><img src="{{asset('/Home/images/sale2.jpg')}}" /></a>
							</div>
                           <div class="s-info">
                           	   <a href="#"><p class="s-title">ZEK 原味海苔</p></a>
                           	   <div class="s-price">￥<b>9.90</b>
                           	   	  <a class="s-buy" href="#">秒杀</a>
                           	   </div>                          	  
                           </div>								
						</div>
						
					  </div>
                   </div>
					<div class="clear "></div>
            <div class="f1">
					<!--甜点-->
					
					<div class="am-container " >
						<div class="shopTitle ">
							<h4 class="floor-title">甜品</h4>
							<div class="floor-subtitle"><em class="am-icon-caret-left"></em><h3>每一道甜品都有一个故事</h3></div>
							<div class="today-brands " style="right:0px ;top:13px;">
								<a href="# ">桂花糕</a>|
								<a href="# ">奶皮酥</a>|
								<a href="# ">栗子糕 </a>|
								<a href="# ">马卡龙</a>|
								<a href="# ">铜锣烧</a>|
								<a href="# ">豌豆黄</a>
							</div>

						</div>
					</div>
					
					<div class="am-g am-g-fixed floodSix ">				
						<div class="am-u-sm-5 am-u-md-3 text-one list">
							<div class="word">
								<a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>
								<a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>
								<a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>	
								<a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>
								<a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>
								<a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>	
								<a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>
								<a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>
								<a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>								
							</div>							
							<a href="# ">
								<img src="{{asset('/Home/images/5.jpg')}}" />
								<div class="outer-con ">
									<div class="title ">
										零食大礼包开抢啦
									</div>
									<div class="sub-title ">
										当小鱼儿恋上软豆腐
									</div>
								</div>
							</a>
							<div class="triangle-topright"></div>	
						</div>
						
						<div class="am-u-sm-7 am-u-md-5 am-u-lg-2 text-two big">
							
								<div class="outer-con ">
									<div class="title ">
										雪之恋和风大福
									</div>
									<div class="sub-title ">
										¥13.8
									</div>
									
								</div>
								<a href="# "><img src="{{asset('/Home/images/act1.png')}}" /></a>						
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
            <div class="f2">

					<!--坚果-->
					<div class="am-container ">
						<div class="shopTitle ">
							<h4 class="floor-title">坚果</h4>
							<div class="floor-subtitle"><em class="am-icon-caret-left"></em><h3>酥酥脆脆，回味无穷</h3></div>
							<div class="today-brands " style="right:0px ;top:13px">
								<a href="# ">腰果</a>|
								<a href="# ">松子</a>|
								<a href="# ">夏威夷果 </a>|
								<a href="# ">碧根果</a>|
								<a href="# ">开心果</a>|
								<a href="# ">核桃仁</a>
							</div>
						</div>
					</div>
					<div class="am-g am-g-fixed floodSeven">
						<div class="am-u-sm-5 am-u-md-4 text-one list ">
							<div class="word">
								<a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>
								<a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>
								<a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>	
								<a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>
								<a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>
								<a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>
								<a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>
								<a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>
								<a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>								
							</div>
							<a href="# ">
								<div class="outer-con ">
									<div class="title ">
									零食大礼包开抢啦！
									</div>
									<div class="sub-title ">
										零食大礼包
									</div>									
								</div>
                                  <img src="{{asset('/Home/images/11.jpg')}}" />								
							</a>
							<div class="triangle-topright"></div>						
						</div>
						
							<div class="am-u-sm-7 am-u-md-4 text-two big">
								
								<div class="outer-con ">
									<div class="title ">
										雪之恋和风大福
									</div>									
									<div class="sub-title ">
										¥13.8
									</div>
									
								</div>
								<a href="# "><img src="{{asset('/Home/images/act2.png')}}" /></a>
								
							</div>
                        
                        <li>
							<div class="am-u-sm-7 am-u-md-4 text-two">
								<div class="boxLi"></div>
								<div class="outer-con ">
									<div class="title ">
										雪之恋和风大福
									</div>
									<div class="sub-title ">
										¥13.8
									</div>
									
								</div>
								<a href="# "><img src="{{asset('/Home/images/6.jpg')}}" /></a>
							</div>
                        </li>
                        <li>
						<div class="am-u-sm-3 am-u-md-2 text-three sug">
							<div class="boxLi"></div>
							<div class="outer-con ">
								<div class="title ">
									小优布丁
								</div>
								<div class="sub-title ">
									¥4.8
								</div>
								
							</div>
							<a href="# "><img src="{{asset('/Home/images/7.jpg')}}" /></a>
						</div>
                        </li>
                        <li>
						<div class="am-u-sm-3 am-u-md-2 text-three big">
							<div class="boxLi"></div>
							<div class="outer-con ">
								<div class="title ">
									小优布丁
								</div>
								<div class="sub-title ">
									¥4.8
								</div>
								
							</div>
							<a href="# "><img src="{{asset('/Home/images/10.jpg')}}" /></a>
						</div>
                        </li>
                        <li>
						<div class="am-u-sm-3 am-u-md-2 text-three ">
							<div class="boxLi"></div>
							<div class="outer-con ">
								<div class="title ">
									小优布丁
								</div>
								<div class="sub-title ">
									¥4.8
								</div>
								
							</div>
							<a href="# "><img src="{{asset('/Home/images/8.jpg')}}" /></a>
						</div>
                        </li>
                        <li>
						<div class="am-u-sm-3 am-u-md-2 text-three ">
							<div class="boxLi"></div>
							<div class="outer-con ">
								<div class="title ">
									小优布丁
								</div>
								<div class="sub-title ">
									¥4.8
								</div>
								
							</div>
							<a href="# "><img src="{{asset('/Home/images/9.jpg')}}" /></a>
						</div>
						</li>
					</div>
                 <div class="clear "></div>                 
            </div>
@endsection