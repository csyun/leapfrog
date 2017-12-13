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

										<a href="{{asset('/pondlist?mid='.$marketinfo->mid)}}">
											<div  class="am-btn am-btn-secondary">蛙塘详情</div>
										</a>
										@if($isinpond)
										<a href="{{asset('/commentlist?mid='.$marketinfo->mid)}}">
											<div  class="am-btn am-btn-secondary">发表评论</div>
										</a>
										@else
										<a href="javascript:;">
											<div id="btn" class="am-btn am-btn-secondary">发表评论</div>
										</a>
										<script type="text/javascript">
										$("#btn").on('click',function(){
											layer.msg("您未收藏该鱼塘无法评论！", {icon: 6});
										})
										</script>										
										@endif
									</div>
								</div>





								

						<div class="am-tabs am-tabs-d2 am-margin" data-am-tabs>

							


							@foreach($data as $k=>$v)
							<div class="am-tabs-bd">
								<div class="am-tab-panel am-fade am-in am-active" id="tab1">

									<div class="comment-main">
										<div class="comment-list">
											<ul class="item-list">

												
												<div class="comment-top">
													<div class="th th-price">
														<td class="td-inner">内容</td>
													</div>
													<div class="th th-item">
														<td class="td-inner">标题</td>
													</div>
																									
												</div class="th th-item">
												<li >
													<div class="item-pic" style="height: 120px">
														<p>评论人:<br>{{$v->user->uname}}<br>评论时间:<br>{{date('Y-m-d H:i:s',$v->create_time)}}</p>
													</div>
												</li>

												<li class="td td-comment">
													<div class="item-title">
														<div class="item-opinion"></div>
														<div class="item-name" style="height:100px">
														
																<p class="item-basic-info">{{$v->title}}</p>
													
														</div>
													</div>
													<div class="item-comment" style="height: 100px; width:100px">

														{!!$v->content!!}
													</div>

													<div class="item-info">
														<div>
															

														</div>
													</div>
												</li>

											</ul>

										</div>
									</div>

								</div>

							</div>
						@endforeach



						</div>



						





					</div>
					
	<script type="text/javascript">

	$('img').height('100px');
	</script>					


@stop

