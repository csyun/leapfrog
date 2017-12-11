<!-- /**
 *前台用户登录页面 
 * @author [苏波] <386249656@qq.com>
 * @data 2017-12-2 13:00
 * 
 */ -->

<!DOCTYPE html>
<html>

	<head lang="en">
		<meta charset="UTF-8">
		<title>登录</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		<meta name="renderer" content="webkit">
		<meta http-equiv="Cache-Control" content="no-siteapp" />
		<script src="{{asset('/Adminui/assets/js/jquery.min.js')}}"></script>
		<script src="{{asset('/layer/layer.js')}}"></script>

		<link rel="stylesheet" href="{{asset('/Home/assets/css/amazeui.css')}}" />
		<link href="{{asset('/Home/css/dlstyle.css')}}" rel="stylesheet" type="text/css">
	</head>

	<body>

		<div class="login-boxtitle">
			<a href="{{asset('/')}}"><img alt="logo" src="{{asset('/Home/images/logo-home.png')}}" /></a>
						    
		</div>
		
		<div class="login-banner">
			<div class="login-main">
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

				<div class="login-box">

							<h3 class="title">登录商城</h3>

							<div class="clear"></div>
						
						<div class="login-form">
						  <form action="{{asset('/dologin')}}" method="post">
						  	{{csrf_field()}}
							   <div class="user-name">
								    <label for="user"><i class="am-icon-user"></i></label>
								    <input type="text" name="username" id="user" placeholder="邮箱/手机/用户名">
                 				</div>
                 <div class="user-pass">
								    <label for="password"><i class="am-icon-lock"></i></label>
								    <input type="password" name="password" id="password" placeholder="请输入密码">
                 </div>
             
           </div>
            
            <div class="login-links">
                <label for="remember-me"><input id="remember-me" type="checkbox">记住密码</label>
								<a href="/forget" class="am-fr">忘记密码</a>
								<a href="{{asset('/register')}}" class="zcnext am-fr am-btn-default">注册</a>

								<br />
            </div>
								<div class="am-cf">
									<input type="submit" name="btn" value="登 录" class="am-btn am-btn-primary am-btn-sm">
								</div>
				</form>
						<div class="partner">		
								<h3>合作账号</h3>
							<div class="am-btn-group">
								<li><a href="#"><i class="am-icon-qq am-icon-sm"></i><span>QQ登录</span></a></li>
								<li><a href="#"><i class="am-icon-weibo am-icon-sm"></i><span>微博登录</span> </a></li>
								<li><a href="#"><i class="am-icon-weixin am-icon-sm"></i><span>微信登录</span> </a></li>
							</div>
						</div>	

				</div>
			</div>
		</div>


					<div class="footer ">
						<div class="footer-hd ">
							<p>
								<a href="# ">恒望科技</a>
								<b>|</b>
								<a href="# ">商城首页</a>
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

		var d=/^\w{6,20}$/;
        
        $("input").focus(function() {
            $(this).prev().css("color","#008DE8");
        });
        
        
        $("[name='username']").blur(function() {
            var v=$(this).val();
            if (v=='') {
                layer.msg("登陆账号不能为空！", {icon: 6});
            }else{
                $(this).prev().css("color","#0EA74A");
                $("[name='username']").next().html("");
            } 
               
            
        });

        $("[name='password']").blur(function() {
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

       


        
       
        $('#btn').click(function(){
        
        var username=$("[name='username']").val();
        var password=$("[name='password']").val();
        

      	
        if (username=="") {
           	layer.msg("邮箱号不能为空！", {icon: 6});
            return false;
        }
        if (password=='') {
            layer.msg("密码不能为空！", {icon: 6});
            return false;
        }else if(!password.match(d)){
            layer.msg("密码应该为6到20位！", {icon: 6});
            
            return false;
        }
                
        });
	</script>


</html>