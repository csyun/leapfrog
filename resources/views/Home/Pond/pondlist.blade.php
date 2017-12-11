@extends('Home.Pond.head')


@section('content')
		<script src="{{asset('/layer/layer.js')}}"></script>
					<div class="user-info">
						<!--标题 -->
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">{{$marketinfo->mname}}</strong> / <small>{{$marketinfo->creator}}</small></div>
						</div>
						<hr/>

						<!--头像 -->
						<div class="user-infoPic">

							<div class="filePic">
								<input type="file" class="inputPic" allowexts="gif,jpeg,jpg,png,bmp" accept="image/*">
								<img style="height:100px" class="am-circle am-img-thumbnail" src="{{$marketinfo->avatar}}" alt=""/>
							</div>

							<p class="am-form-help"></p>

							<div class="info-m">
								<div><b>塘主：<i>{{$marketinfo->creator}}</i></b></div>

								<div class="u-safety">
									<a href="safety.html">
									 蛙塘成员:
									<span class="u-profile"><i class="bc_ee0000" style="width: 60px;" width="0">{{$count}}</i></span>
									</a>
								</div>
								@if($isinpond)
								
									<div disabled class="am-btn am-btn-secondary">已加入</div>
								
								@else
								<a href="">
									<div  class="am-btn am-btn-secondary">加入蛙塘</div>
								</a>
								@endif
							</div>
						</div>
					
								
									











						
					</div>
					


@stop