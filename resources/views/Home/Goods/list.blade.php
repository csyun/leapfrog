@extends('Layouts.home')
@section('title')
	<title>跳蛙--商品</title>
@endsection
@section('body')

							<div class="search-content">
								<div class="sort">
									<li class="first"><a title="综合">综合排序</a></li>
									<li><a title="销量">销量排序</a></li>
									<li><a title="价格">价格优先</a></li>
									<li class="big"><a title="评价" href="#">评价为主</a></li>
								</div>
								<div class="clear"></div>

								<ul class="am-avg-sm-2 am-avg-md-3 am-avg-lg-4 boxes">
									@foreach($goods as $k=>$v)
									<li>
										<div class="i-pic limit">
											<a href="{{url('/home/goods/details/'.$v->gid)}}"><img src="{{$v->gpurl}}" /></a>
											<p class="title fl"><a href="{{url('/home/goods/details/'.$v->gid)}}">{{$v->gname}}</a></p>
											<p class="price fl">

												<strong>{{$v->gprice}}</strong>
												<b>元</b>
											</p>
											<p class="number fl">
											</p>
										</div>
									</li>
										@endforeach




								</ul>
							</div>
							<div class="search-side">

								<div class="side-title">
									经典搭配
								</div>

								<li>
									<div class="i-pic check">
										<a href="introduction.html"><img src="../images/cp.jpg" /></a>
										<a href="introduction.html"><p class="check-title">萨拉米 1+1小鸡腿</p></a>
										<p class="price fl">
											<b>¥</b>
											<strong>29.90</strong>
										</p>
										<p class="number fl">
											销量<span>1110</span>
										</p>
									</div>
								</li>

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

						</div>
					</div>


					</div>
				</div>

			</div>

		<!--引导 -->
		@stop