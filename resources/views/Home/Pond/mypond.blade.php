@extends('Home.Pond.head')
@section('content')
		<script src="{{asset('/layer/layer.js')}}"></script>
					<div class="user-collection">
						<!--标题 -->
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">蛙塘列表</strong> / <small>My&nbsp;Collection</small></div>
						</div>
						<hr/>
						@if (count($errors) > 0)
		                <div id="lan" class="alert alert-danger" style="display:none">
		                    <ul>
		                        @if(is_object($errors))
		                        @foreach ($errors->all() as $error)
		                        	<li class="aa" style="display:none">{{ $error }}</li>
		                            <script type="text/javascript">
		                            var a = $(".aa").html();
			                            layer.alert(a, {
		  									icon: 6,
		  									skin: 'layer-ext-moon' //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
										});
		                            </script>
		                        @endforeach
		                        @else
		                            <li class="aa" style="display:none">{{ $errors}}</li>
		                            <script type="text/javascript">
			                            var a = $(".aa").html();
			                            layer.alert(a, {
		  									icon: 6,
		  									skin: 'layer-ext-moon' //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
										});
		                            </script>                           	
		                        @endif
		                    </ul>
		                </div>
		                @endif


						<div class="you-like">
							<div class="s-bar">
								我的蛙塘

							</div>
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
										@if($v->status == 0)
										<div class="s-tp" style="background-color: green" >
											<a href="javascript:;" >
											<span class="ui-btn-loading-before">等待审核</span>
											</a>
										</div>										
										@elseif($v->status == 1)

										<div class="s-tp">
											<a href="{{asset('/pondlist?mid='.$v->mid)}}">
											<span class="ui-btn-loading-before">进入蛙塘</span>
											</a>
										</div>
										@else
										<div class="s-tp" style="background-color: red">
											<a href="javascript:;" >
											<span class="ui-btn-loading-before">未通过审核</span>
											</a>
										</div>	
										@endif
									</div>
								</div>
								
							@endforeach
							</div>
							



						</div>
					{!! $data->render() !!}
					</div>

@stop