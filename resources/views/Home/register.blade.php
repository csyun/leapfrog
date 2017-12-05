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
		<title>注册</title>
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
							<ul class="am-tabs-nav am-nav am-nav-tabs ">

								<li class="am-active"><a href="">邮箱注册--暂时只支持邮箱注册</a></li>						
							</ul>
                                <a href="{{asset('/login')}}" class="zcnext am-fr am-btn-default">登陆</a>    

							<div class="am-tabs-bd">
								<div class="am-tab-panel am-active">
									<form action="{{url('/doregister')}}" method="post">
									{{csrf_field()}}	
                                <div class="user-pass">
                                    <label for="password"><i class="am-icon-lock"></i></label>
                                    <input type="text" name="uname" value="{{old('uname')}}" id="uname" placeholder="设置用户名">
                                </div>  
							     <!-- <div class="user-email">
										<label for="email"><i class="am-icon-envelope-o"></i></label>
										<input type="email" name="email" value="{{old('email')}}" id="email" placeholder="请输入邮箱账号">
                                </div> -->										
                            <div class="user-pass">
								    <label for="password"><i class="am-icon-lock"></i></label>
								    <input type="password" name="password" id="password" placeholder="设置密码">
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
								<input type="submit" id="btn" name="" value="注册" class="am-btn am-btn-primary am-btn-sm am-fl">
							</div>
							</div>
							<div class="login-links">
								<label for="reader-me" >
									<input id="reader-me" type="checkbox"> 点击表示您同意商城《服务协议》
								</label>
						  	</div>
				            </form>
								

								

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



		function rand(m,n)
        {
            return Math.ceil(Math.random()*(n-m+1))+m-1;
        }


        document.getElementById('codeImg').onclick = function()
        {
            var src = "{{url('/getcode')}}"+"?a="+rand(1000,9999);
            this.src = src;
        }

        // var h=/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
        var d=/^\w{6,20}$/;
        // var c = /^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u;
        var b = /^\w{2,18}$/;

        
        $("input").focus(function() {
            $(this).prev().css("color","#008DE8");
        });
        
        $("#uname").blur(function() {
            var v=$(this).val();

            $.ajax({
                    type:"post",
                    url:"{{url('/register/ajax')}}",
                    data:{"username":v,"_token":"{{csrf_token()}}"},
                    success:function(data){
                        if(data){
                             layer.msg("用户名已存在！", {icon: 6});
                        }
                    },

                    dataType: "json",

             });
            if (v=='') {
                layer.msg("用户名不能为空！", {icon: 6});
            }else if(!v.match(c)){
                layer.msg("用户名为2到18位！", {icon: 6});
            }else{
                $(this).prev().css("color","#0EA74A");
                $("[name='uname']").next().html("");
            }
             
        });        
        
        // $("[name='email']").blur(function() {
        //     var v=$(this).val();
        //     if (v=='') {
        //         layer.msg("邮箱不能为空！", {icon: 6});
        //     }else if(!v.match(h)){
        //         layer.msg("邮箱格式不符合要求！", {icon: 6});
               
        //     }else{
        //         $(this).prev().css("color","#0EA74A");
        //         $("[name='username']").next().html("");
        //     } 
        // });

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

        $("[name='repassword']").blur(function() {
            var v=$(this).val();  
            var password = $("[name='password']").val();
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
        
        // var email=$("[name='email']").val();
        var password=$("[name='password']").val();
        var uname=$("[name='uname']").val();
        var repassword = $("[name = 'repassword']").val();
        var codeImg=$("[name='code']").val();
        var read = $("#reader-me").prop("checked");

      	if(read == false){
      		layer.msg("未同意服务协议不能注册", {icon: 6});
            return false;
      	}

        if (uname=="") {
            layer.msg("用户名不能为空！", {icon: 6});
            return false;
        }else if(!uname.match(b)){
            layer.msg("用户名为2到18位", {icon: 6});            
            return false;
        }

        // if (email=="") {
        //    	layer.msg("邮箱号不能为空！", {icon: 6});
        //     return false;
        // }else if(!email.match(h)){
        //     layer.msg("邮箱格式不正确！", {icon: 6});
            
        //     return false;
        // }
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