@extends('Layouts.home')
@section('title')
	<title>跳蛙--首页</title>
@endsection
@section('body')
	<link href="{{asset('/Home/css/jsstyle.css')}}" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="{{asset('/Home/js/address.js')}}"></script>
	<script src="{{asset('/layer/layer.js')}}"></script>
			<div class="concent">
					<!--订单 -->
					<div class="concent">
						<div id="payTable">
							<h3>我发布的商品</h3>
							<div class="cart-table-th">
								<div class="wp">
									<div class="th th-oplist">
										<div class="td-inner">缩略图</div>
									</div>
									<div class="th th-price">
										<div class="td-inner">商品名称</div>
									</div>
									<div class="th th-oplist">
										<div class="td-inner">单价</div>
									</div>

									<div class="th th-oplist">
										<div class="td-inner">商品描述</div>
									</div>




								</div>
							</div>
							<div class="clear"></div>
							<div class="clear"></div>
							</div>
						@foreach($goods as $k=>$v)
							<tr id="J_BundleList_s_1911116345_1" class="item-list">
								<div id="J_Bundle_s_1911116345_1_0" class="bundle  bundle-last">
									<div class="bundle-main">
										<ul class="item-content clearfix">
											<div class="pay-phone">
												<li class="td td-price">
													<div class="item-price price-promo-promo">
														<div class="price-content">
															<img src="{{$v->gpurl}}"/>
														</div>
													</div>
												</li>

												<li class="td td-price">
													<div class="item-price price-promo-promo">
														<div class="price-content">
															<em class="J_Price price-now">{{$v->gname}}</em>
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
													<span class="phone-title">商品描述</span>
													<div class="pay-logis">
														{!! $v->gdesc !!}
													</div>
												</div>
											</li>
											<li class="td td-item">

												<div class="item-info">
													<div class="item-basic-info">
														<a href="javascript:;" onclick="gstatus({{$v->gid}},{{$v->status}})">
															<i class="am-icon-pencil"></i>
															@if($v->status == 0)
																下架
															@elseif($v->status == 1)
																上架
															@endif
														</a>
														</button>
														<a href="{{url('home/goods/edit/'.$v->gid)}}">
															<i class="am-icon-pencil"></i> 编辑
														</a>
														<a href="javascript:;" onclick="goodsDel({{$v->gid}})"class="tpl-table-black-operation-del">
															<i class="am-icon-trash"></i> 删除
														</a>
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
								<script type="text/javascript">
                                    function  gstatus(gid,status) {
                                        if(status  == 0){
                                            var tanchu =  '您确认要下架吗?'
                                        }else{
                                            var tanchu =  '您确认要上架吗?'
                                        };
                                        layer.confirm(tanchu,{
                                            btn:['确认','取消']
                                        },function () {
                                            $.get("{{url('admin/goods/gstatus')}}/"+gid,function(data){

//                    修改状态成功
                                                if(data.gg == 0){
                                                    layer.msg(data.msg, {icon: 6});
                                                    var t=setTimeout("location.href = location.href;",2000);
                                                }else if(data.gg == 1){
                                                    layer.msg(data.msg, {icon: 5});

                                                    var t=setTimeout("location.href = location.href;",2000);
                                                }else{
                                                    layer.msg(data.msg, {icon: 2});
                                                    var t=setTimeout("location.href = location.href;",2000);
                                                }
                                            });

                                        })
                                    }
                                    function goodsDel(gid) {

                                        layer.confirm('您确认要删除吗?',{
                                            btn:['确认','取消']
                                        },function () {
                                            $.post("{{url('admin/goods')}}/"+gid,{"_method":"delete","_token":"{{csrf_token()}}"},function(data){

//                    删除成功
                                                if(data.gg == 0){
                                                    layer.msg(data.msg, {icon: 6});
                                                    var t=setTimeout("location.href = location.href;",2000);
                                                }else if(data.gg == 1){
                                                    layer.msg(data.msg, {icon: 5});

                                                    var t=setTimeout("location.href = location.href;",2000);
                                                }else{
                                                    layer.msg(data.msg, {icon: 2});
                                                    var t=setTimeout("location.href = location.href;",2000);
                                                }


                                            });

                                        })
                                    }

								</script>
						<div class="clear"></div>
					</div>
				</div>
			</div>
			<div class="theme-popover-mask"></div>
			<div class="theme-popover">

			</div>

			<div class="clear"></div>
	@stop