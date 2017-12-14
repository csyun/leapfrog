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

											<a href="{{url('/home/goods/details/'.$v->gid)}}"><img style="width:250px;height:200px;" src="{{$v->gpurl}}" /></a>
											<b>商品:</b>
											<strong>{{$v->gname}}</strong>
											</p>
											<b>价格:</b>
												<strong style="font-size:30px;">{{$v->gprice}}</strong>
												<b style="color:red;">元</b>
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