@extends('Home.Pond.head')


@section('content')
		<script src="{{asset('/layer/layer.js')}}"></script>
					<div class="user-info">

	 				@if (count($errors) > 0)
	                <div id="lan" class="alert alert-danger">
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

										<a href="{{asset('/comment?mid='.$marketinfo->mid)}}">
											<div  class="am-btn am-btn-secondary">蛙塘评论页</div>
										</a>

									</div>
								</div>






			<!--蛙塘信息 -->
            <div class="info-main">
              <form action="{{asset('/commentstore')}}" method="post" id="art_form" enctype="multipart/form-data" class="am-form am-form-horizontal" >

                {{csrf_field()}}
                <div class="am-form-group">
                  <label for="user-name2" class="am-form-label">标题名称</label>
                  <div class="am-form-content">
                    <input name="title" type="text" id="title"  placeholder="填入标题名称">

                  </div>
                </div>

             
                                  				
                        <div class="am-form-group">
                            
                            <div class="am-u-sm-9">
                                <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
                                <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
                                <script id="editor" type="text/plain" name="content" id="content"  style="width:700px;height:300px;">
                                    {!!old('content')!!}
                                </script>
                            </div>
                        </div>


             			<input type="hidden" name="mid" value="{{$marketinfo->mid}}">
             			<input type="hidden" name="uid" value="{{$uid}}">

             			<div class="am-form-group">
                            <div class="am-u-sm-9 am-u-sm-push-3">
                                <input type="submit" name="btn"  id="btn" value="创建蛙塘" class="am-btn am-btn-primary am-btn-sm">
                            </div>
                        </div>
               
            
               
          


              </form>
            </div>


								

					

					</div>
<script type="text/javascript">

        //实例化编辑器
        //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
        var ue = UE.getEditor('editor');

   

    $('img').height('100px');

  
        
    $("input").focus(function() {
        $(this).prev().css("color","#008DE8");
    });
    
    
    $("#title").blur(function() {
        var v=$(this).val();
        if (v=='') {
            layer.msg("评论标题不能为空", {icon: 6});
        }else{
            $(this).prev().css("color","#0EA74A");
            $("#mname").next().html("");
        } 
           
        
    });

   

    $("#content").blur(function() {
        var v=$(this).val();
        if (v=='') {
          layer.msg("内容不能为空", {icon: 6});
           
        }else{
            $(this).prev().css("color","#0EA74A");
            $("#art_thumb").next().html("");
        } 
    });    
       


        
       
    $('#btn').click(function(){
    
    var title=$("#title").val();

    var content= $('#content').val();

    
    if (title=="") {
        layer.msg("标题不能为空！", {icon: 6});
        return false;
    }

    if(content == ''){
        layer.msg("内容不能为空！", {icon: 6});
        return false; 
    }
            
    });


</script>					
					


@stop