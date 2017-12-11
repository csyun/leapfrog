@extends('Layouts.home')
@section('title')
	<title>跳蛙--首页</title>
@endsection
@section('body')
	<link href="{{asset('/Home/css/jsstyle.css')}}" rel="stylesheet" type="text/css" />

	<script type="text/javascript" src="{{asset('/Home/js/address.js')}}"></script>
			<div class="concent">
				<ul>
					@if(is_object($errors))
						@foreach ($errors->all() as $error)
							<li style="color:red">{{ $error }}</li>
						@endforeach
					@else
						<li style="color:red">{{ $errors }}</li>
					@endif
				</ul>
					<!--订单 -->
					<div class="concent">
						<div id="payTable">
							<h3>确认订单信息</h3>
							<div class="cart-table-th">
								<div class="wp">

									<div class="th th-item">
										<div class="td-inner">商品信息</div>
									</div>
									<div class="th th-price">
										<div class="td-inner">单价</div>
									</div>
									<div class="th th-oplist">
										<div class="td-inner">配送方式</div>
									</div>

								</div>
							</div>
							<div class="clear"></div>
							<div class="clear"></div>
							</div>
						@foreach($goods as $k=>$v)
							<?php $sum=0; $sum+=$v->gprice ?>
							<tr id="J_BundleList_s_1911116345_1" class="item-list">
								<div id="J_Bundle_s_1911116345_1_0" class="bundle  bundle-last">
									<div class="bundle-main">
										<ul class="item-content clearfix">
											<div class="pay-phone">
												<li class="td td-item">
													<div class="item-pic">
														<a href="{{url('/home/goods/details/'.$v->gid)}}" class="J_MakePoint">
															<img src="{{$v->gpurl}}" class="itempic J_ItemImg"></a>
													</div>
													<div class="item-info">
														<div class="item-basic-info">
															<a href="{{url('/home/goods/details/'.$v->gid)}}" target="_blank" title="美康粉黛醉美唇膏 持久保湿滋润防水不掉色" class="item-title J_MakePoint" data-point="tbcart.8.11">{{$v->gname}}</a>
														</div>
													</div>
												</li>

												<li class="td td-price">
													<div class="item-price price-promo-promo">
														<div class="price-content">
															<em class="J_Price price-now">{{$v->gprice}}</em>
														</div>
													</div>
												</li>
											</div>

											<li class="td td-oplist">
												<div class="td-inner">
													<span class="phone-title">配送方式</span>
													<div class="pay-logis">
														包邮
													</div>
												</div>
											</li>

										</ul>
										<div class="clear"></div>

									</div>
							</tr>
							@endforeach
							</div>
							<div class="clear"></div>
							<div class="pay-total">
						<form action="{{url('/home/order/doadd')}}" method="post">
							{{csrf_field()}}
							<div class="order-extra">
								<div class="order-user-info">
									<div id="holyshit257" class="memo">
										<label>买家留言：</label>
										<textarea style="height:190px;width:500px;"name="usg"></textarea>
										<div class="msg hidden J-msg">
											<p class="error">最多输入500个字符</p>
										</div>
									</div>
								</div>

							</div>
							<!--优惠券 -->
							<div class="buy-agio">
								<li class="td td-coupon">
									<div class="pay-confirm clearfix">
									<div class="box">
										<div tabindex="0" id="holyshit267" class="realPay"><em class="t">总价：</em>
											<span class="price g_price ">
                                    <span>¥</span> <em class="style-large-bold-red " id="J_ActualFee"><?php echo $sum;?></em>
											</span>
										</div>

										<div id="holyshit268" class="pay-address">

											<p class="buy-footer-address">
												<span class="buy-line-title buy-line-title-type">寄送至：</span>
												<span class="buy--address-detail">
												<span class="street"><input style="width:300px;height:80px;"type="text" name="addr" placeholder="请输入详细地址" ></span>
												</span>
												</span>
											</p>
											<p class="buy-footer-address">
												<span class="buy-line-title">收货人：</span>
												<span class="buy-address-detail">
                                         <span class="buy-user"><input placeholder="名字" type="text" name="rec" style="width:50px;height:30px"></span>
												<span class="buy-phone"><input placeholder="手机号" type="text" name="tel" style="width:100px;height:30px"></span>
												</span>
											</p>
										</div>
									</div>
								</li>
							</div>
							<div class="clear"></div>
							</div>

							<div class="order-go clearfix">


										<div class="go-btn-wrap">
											<input type="submit" class="am-btn am-btn-danger"value="提交订单"/></div>
										</div>

									<div class="clear"></div>
								</div>
							</div>
						</div>
					</form>

						<div class="clear"></div>
					</div>
				</div>
			</div>
			<div class="theme-popover-mask"></div>
			<div class="theme-popover">

			</div>

			<div class="clear"></div>
	@stop