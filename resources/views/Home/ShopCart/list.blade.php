@extends('Layouts.home')
@section('title')
	<title>跳蛙--首页</title>
@endsection
@section('body')
	<script src="{{asset('/layer/layer.js')}}"></script>
			<div class="clear"></div>
			<!--购物车 -->
			<div class="concent">
				<div id="cartTable">
					<div class="cart-table-th">
						<div class="wp">
							<div class="th th-chk">
								<div id="J_SelectAll1" class="select-all J_SelectAll">

								</div>
							</div>
							<div class="th th-item">
								<div class="td-inner">商品信息</div>
							</div>
							<ul>
								@if(session('msg'))
									<script>
                                        layer.alert('购物车没有东西怎么结算呢,小可爱', {icon: 3});
									</script>
								@endif
							</ul>


							<div class="th th-sum">
								<div class="td-inner">金额</div>
							</div>
							<div class="th th-op">
								<div class="td-inner">操作</div>
							</div>
						</div>
					</div>
					<div class="clear"></div>
					<form >
						<?php $sum = 0; ?>
					@if(!empty($goods))
					@foreach($goods as $k=>$v)
						<?php $sum+=$v->gprice; ?>
					<tr class="item-list">
						<div class="bundle  bundle-last ">
							<div class="bundle-hd">
								<div class="bd-promos">
									<div class="bd-has-promo"><span class="bd-has-promo-content"></span>&nbsp;&nbsp;</div>
									<div class="act-promo">
										<span class="gt"></span>
									</div>
								</div>
							</div>
							<div class="clear"></div>
							<div class="bundle-main">
								<ul class="item-content clearfix">
									<li class="td td-chk">
										<div class="cart-checkbox ">

										</div>
									</li>
									<li class="td td-item">
										<div class="item-pic">
											<a href="#" target="_blank" data-title="美康粉黛醉美东方唇膏口红正品 持久保湿滋润防水不掉色护唇彩妆" class="J_MakePoint" data-point="tbcart.8.12">
												<img src="{{$v->gpurl}}" class="itempic J_ItemImg"></a>
										</div>
										<div class="item-info">
											<div class="item-basic-info">
												<a href="#" target="_blank" title="美康粉黛醉美唇膏 持久保湿滋润防水不掉色" class="item-title J_MakePoint" data-point="tbcart.8.11">{{$v->gname}}</a>
											</div>
										</div>
									</li>
									<li class="td td-info">
										<div class="item-props item-props-can">

										</div>
									</li>


									<li class="td td-sum">
										<div class="td-inner">
											<em tabindex="0" class="J_ItemSum number">{{$v->gprice}}</em>
										</div>
									</li>
									<li class="td td-op">
										<div class="td-inner">
											<a href="javascript:;" onclick="cartDel({{$v->gid}},{{$k}})" data-point-url="#" class="delete">
                  删除</a>
										</div>
										<script>
                                                function cartDel(id,k) {

                                                    layer.confirm('您确认要删除吗?', {
                                                        btn: ['确认', '取消']
                                                    }, function () {
                                                        $.post("{{url('/home/shopcart/cart/del')}}/" + id,{"_token":"{{csrf_token()}}",'k':k},function (data) {
                                                            if (data.error == 0) {
                                                                layer.msg(data.msg, {icon: 5});
                                                                var t = setTimeout("location.href = location.href;", 2000);
                                                            } else (data.error == 1)
                                                            {
                                                                layer.msg(data.msg, {icon: 6});

                                                                var t = setTimeout("location.href = location.href;", 2000);
                                                            }
                                                        });
                                                    })
                                                }
										</script>
									</li>
								</ul>
							</div>
						</div>
					</tr>
				@endforeach
						@endif
				</div>
				<div class="clear"></div>

				<div class="float-bar-wrapper">

					<div class="float-bar-right">
						<div class="amount-sum">
							<span class="txt">已选商品</span>
							<em id="J_SelectedItemsCount">{{$n}}</em><span class="txt">件</span>
							<div class="arrow-box">
								<span class="selected-items-arrow"></span>
								<span class="arrow"></span>
							</div>
						</div>
						<div class="price-sum">
							<span class="txt">合计:<?php echo $sum;?></span>
							<strong class="price">¥<em id="J_Total"></em></strong>
						</div>
						<div class="btn-area">
							<a href="{{url('/home/shopcart/cart/pay')}}" id="J_Go" class="submit-btn submit-btn-disabled" aria-label="请注意如果没有选择宝贝，将无法结算">
								<span>结&nbsp;算</span></a>
						</div>
					</div>

				</div>
@stop