<!-- /**
 *前台用户注册页面 
 * @author [苏波] <386249656@qq.com>
 * @data 2017-12-3 13:00
 * 
 */ -->

<!DOCTYPE html>
<html>

	<head lang="en">
		<meta charset="UTF-8">
		<title>重置密码</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		<meta name="renderer" content="webkit">
		<meta http-equiv="Cache-Control" content="no-siteapp" />

		<link rel="stylesheet" href="{{asset('/Home/assets/css/amazeui.min.css')}}" />
		<link href="{{asset('/Home/css/dlstyle.css')}}" rel="stylesheet" type="text/css">
		<script src="{{asset('/Home/assets/js/jquery.min.js')}}"></script>
		<script src="{{asset('/Home/assets/js/amazeui.min.js')}}"></script>

		<script src="{{asset('/layer/layer.js')}}"></script>

	</head>

	<body>

		<div class="login-boxtitle">
			<a href="{{asset('/')}}"><img alt="" src="{{asset('/Home/images/logo-home.png')}}" /></a>
		</div>

		<div class="res-banner">
			<div class="res-main">
				<div class="login-banner-bg"><span></span><img src="{{asset('/Home/images/big.jpg')}}" /></div>
				 @if (count($errors) > 0)
                <div id="lan" class="alert alert-danger">
                    <ul>
                        @if(is_object($errors))
                        @foreach ($errors->all() as $error)
                        	<li class="aa" style="display:none">{{ $error }}</li>
                            <script type="text/javascript">
                            var a = $(".aa").html();
	                            layer.alert(a, {
  									icon: 5,
  									skin: 'layer-ext-moon' //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
								});
                            </script>
                        @endforeach
                            @else
                            <li class="aa" style="display:none">{{ $errors}}</li>
                            <script type="text/javascript">
	                            var a = $(".aa").html();
	                            layer.alert(a, {
  									icon: 5,
  									skin: 'layer-ext-moon' //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
								});
                            </script>                           	
                            @endif
                    </ul>
                </div>
                @endif
				<div class="login-box">


						<div class="am-tabs" id="doc-my-tabs">

                           <a href="{{asset('/login')}}" class="zcnext am-fr am-btn-default">登陆页面</a>       
                
							<div class="am-tabs-bd">
								<div class="am-tab-panel am-active">
									<form action="{{url('/doreset')}}" method="post">
									{{csrf_field()}}	
                                
                               <div class="user-name">
                                    <label for="user"><i class="am-icon-user"></i></label>
                                    <input type="text" name="username" id="user" style="display:none"  value="{{$user->uname}}">
                                    <input type="text" name="username" id="user" disabled="" value="{{$user->uname}}">
                                </div>	
                                <br>									
                            <div class="user-pass">
								    <label for="password"><i class="am-icon-lock"></i></label>
								    <input type="password" name="password" id="password" placeholder="设置新密码">
                            </div>										
                            <div class="user-pass">
								    <label for="passwordRepeat"><i class="am-icon-lock"></i></label>
								    <input type="password" name="repassword" id="passwordRepeat" placeholder="确认密码">

                            </div>
                          	<div class="user-pass">
            				    <label for="passwordRepeat"><i class="am-icon-lock"></i></label>
            				     <input type="text" name="code"  id="code" placeholder="请输入验证码">

                            </div>

                             <div class="user-pass">
                                    <img id="codeImg" src="{{url('/getcode')}}" >

                             </div>                 
                                                  
							<div class="am-cf" >
								<input type="submit" id="btn" name="" value="确认更改" class="am-btn am-btn-primary am-btn-sm am-fl">
							</div>
							
							
				            </form>

                            </div>
                            


						
								

								<script>
									$(function() {
									    $('#doc-my-tabs').tabs();
									  })
								</script>

							</div>
						</div>

				</div>
			</div>
			
					<div class="footer ">
						<div class="footer-hd ">
							<p>
								<a href="# ">恒望科技</a>
								<b>|</b>
								<a href="{{asset('/')}} ">商城首页</a>
								<b>|</b>
								<a href="# ">支付宝</a>
								<b>|</b>
								<a href="# ">物流</a>
							</p>
						</div>
						<div class="footer-bd ">
							<p>
								<a href="# ">关于恒望</a>
								<a href="# ">合作伙伴</a>
								<a href="# ">联系我们</a>
								<a href="# ">网站地图</a>
								<em>© 2015-2025 Hengwang.com 版权所有. 更多模板 <a href="http://www.cssmoban.com/" target="_blank" title="模板之家">模板之家</a> - Collect from <a href="http://www.cssmoban.com/" title="网页模板" target="_blank">网页模板</a></em>
							</p>
						</div>
					</div>
	</body>


	<script type="text/javascript">


    //邮箱表单验证
		function rand(m,n)
        {
            return Math.ceil(Math.random()*(n-m+1))+m-1;
        }


        document.getElementById('codeImg').onclick = function()
        {
            var src = "{{url('/getcode')}}"+"?a="+rand(1000,9999);
            this.src = src;
        }

 
        var d=/^\w{6,20}$/;

             
        $("input").focus(function() {
            $(this).prev().css("color","#008DE8");
        });
              

        $("#password").blur(function() {
            var v=$(this).val();
            if (v=='') {
            	layer.msg("密码不能为空！", {icon: 6});
               
            }else if(!v.match(d)){
            	layer.msg("密码为6到20位！", {icon: 6});
                
            }else{
                $(this).prev().css("color","#0EA74A");
                $("[name='password']").next().html("");
            } 
        });

        $("#passwordRepeat").blur(function() {
            var v=$(this).val();  
            var password = $("#password").val();
            if (v=='') {
            	layer.msg("密码不能为空！", {icon: 6});
               
            }else if(v!= password){
            	layer.msg("两次密码不一致", {icon: 6});
                
            }else{
                $(this).prev().css("color","#0EA74A");
                $("[name='password']").next().html("");
            } 
        });


        
         $("[name='code']").blur(function() {
            var v=$(this).val();
            if (v=='') {
               layer.msg("验证码不能为空！", {icon: 6});
            }
        });

        $('#btn').click(function(){        
            var password=$("#password").val();
            var repassword = $("#passwordRepeat").val();
            var codeImg=$("[name='code']").val();

            if (password=='') {
                layer.msg("密码不能为空！", {icon: 6});
                return false;
            }else if(!password.match(d)){
                layer.msg("密码应该为6到20位！", {icon: 6});
                
                return false;
            }
            if(repassword == ''){
            	layer.msg("确认密码不能为空！", {icon: 6});
                return false;
            }else if(repassword != password){
            	layer.msg("两次密码不一致！", {icon: 6});
                return false;        	
            }

            
            if (codeImg=='') {
                layer.msg("验证码不能为空！", {icon: 6});
                $("[name='code']").prev().css("color","#f00");
                return false;
            }
        
        });

        

	</script>

</html>