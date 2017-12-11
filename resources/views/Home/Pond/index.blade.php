@extends('Home.Pond.head')
@section('content')
		<script src="{{asset('/layer/layer.js')}}"></script>
					<div class="user-collection">
						<!--标题 -->
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">蛙塘列表</strong> / <small>My&nbsp;Collection</small></div>
						</div>
						<hr/>

						<div class="you-like">

							<div class="s-content">
								
									
							@foreach($data as $k=>$v)
								<div class="s-item-wrap">
									<div class="s-item">

										<div class="s-pic"  >
											<a href="#" class="s-pic-link">
												<img style="height: 190px" src="{{$v->avatar}}" alt="" title="" class="s-pic-img s-guess-item-img">
											</a>
										</div>
										<div class="s-info">
											<div class="s-title"><a href="#" title="">{{$v->mname}}</a></div>
											<div class="s-title">
												{{$v->desc}}
											</div>
											<div class="s-extra-box">
												<span class="s-comment">塘主:</span>
												<span class="s-sales">{{$v->creator}}</span>
											</div>
										</div>
										<div class="s-tp">
											<a href="{{asset('/pondlist?mid='.$v->mid)}}">
											<span class="ui-btn-loading-before">进入蛙塘</span>
											</a>
											@if(in_array($v->mid,$arr))
											<i class="am-icon-shopping-cart"></i>
											<a href="javascript:;">
											<span class="ui-btn-loading-before buy">已收藏</span>
											</a>
											@else
											<i class="am-icon-shopping-cart"></i>
											<a href="{{asset('/collectpond?mid='.$v->mid)}}">
											<span class="ui-btn-loading-before buy">收藏蛙塘</span>
											</a>
											@endif
										</div>
									</div>
								</div>
							@endforeach
							</div>
							

							

						</div>
								{!! $data->render() !!}
					</div>

@stop