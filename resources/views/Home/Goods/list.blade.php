@extends('Layouts.home')
@section('title')
	<title>跳蛙--商品</title>
@endsection
@section('body')

							<div class="search-content">

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
							</div>
							<div class="clear"></div>

						</div>
					</div>


					</div>
				</div>

			</div>

		<!--引导 -->
		@stop