@extends('Home.Pond.head')


@section('content')
		<script src="{{asset('/layer/layer.js')}}"></script>
					<div class="user-info">
						<!--标题 -->
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">{{$marketinfo->mname}}</strong> / <small>{{$marketinfo->creator}}</small></div>
						</div>
						<hr/>

						<!--个人信息 -->
								<div class="m-bg"></div>
								<div class="m-userinfo">
									<div class="m-baseinfo">
										<a href="information.html">
											<img src="{{$marketinfo->avatar}}">
										</a>
										<em class="s-name">塘主:{{$marketinfo->creator}}<span class="vip1"></em>
										<div class="s-prestige am-btn am-round">
											</span>蛙塘收藏人数:{{$count}}</div>
									</div>
									<div class="m-right">
										@if($isinpond)
										<div class="m-new">
											<a href="javascript:;">
											<div  class="am-btn am-btn-secondary">已收藏</div>
											</a>
										</div>
										@else
										<div class="m-new">
											<a href="{{asset('/collectpond?mid='.$marketinfo->mid)}}">
											<div  class="am-btn am-btn-secondary">收藏蛙塘</div>
											</a>
										</div>
										@endif

										<a href="{{url('/comment?mid='.$marketinfo->mid)}}">
											<div  class="am-btn am-btn-secondary">蛙塘评价</div>
										</a>
									</div>
								</div>
						
						@foreach($data as $k=>$v)		
						<div class="goods">
							<div class="goods-box first-box">
								<div class="goods-pic">
									<div class="goods-pic-box">
										<a class="goods-pic-link" target="_blank" href="#" title="">
											<img src="{{$v->gpurl}}" class="goods-img"></a>
									</div>
									@if($v->status == 1)
									<div class="goods-status goods-status-show"><span class="desc">宝贝已下架</span></div>
									@elseif($v->status == 0)
									<div class="goods-status goods-status-show"><span class="desc">宝贝在售</span></div>
									@else
									<div class="goods-status goods-status-show"><span class="desc">宝贝已售出</span></div>
									@endif
									
								</div>

								<div class="goods-attr">
									<div class="good-title">
										<a class="title" href="#" target="_blank">{{$v->gname}}</a>
									</div>
									<div class="goods-price">
										<span class="g_price">                                    
                                        <span>¥</span><strong>{{$v->gprice}}</strong>
										</span>
										<span class="g_price g_price-original">                                    
                                        <span>¥</span><strong>{{$v->gprice+99}}</strong>
										</span>
									</div>
									<div class="clear"></div>
									<div class="goods-num">
										<div class="match-recom">
											@if($v->status == 0)
											<a href="{{url('/home/shopcart/cart/buy/'.$v->gid)}}" class="match-recom-item">立即购买</a>
											<a href="#" onclick="cart({{$v->gid}})" class="match-recom-item">加入购物车</a>
											<i><em></em><span></span></i>
											@endif
										</div>
									</div>
								</div>
							</div>
						</div>		

						@endforeach









						
					</div>
					

<script type="text/javascript">
 
 			function cart(id) {

   
                    $.get("{{url('/home/shopcart')}}/" + id, function (data) {
					//添加成功
                        if (data.error == 0) {
                            layer.msg(data.msg, {icon: 6});
					//var t = setTimeout("location.href = location.href;", 2000);
                        } else if (data.error == 1) {
                            layer.msg(data.msg, {icon: 5});
					//var t = setTimeout("location.href = location.href;", 2000);
                        }else{
                            layer.msg(data.msg, {icon: 2});
					//var t = setTimeout("location.href = location.href;", 2000);
                        }
                    });              

                
            }

</script>
@stop