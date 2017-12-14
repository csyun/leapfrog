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
		<title>忘记密码</title>
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

                            <ul class="am-tabs-nav am-nav am-nav-tabs am-nav-justify">
                                <li class="am-active"><a href="">邮箱账号密码遗忘</a></li>
                                <li><a href="">手机账号密码遗忘</a></li>

                            </ul>
                              
                
							<div class="am-tabs-bd">
								<div class="am-tab-panel am-active">
									<form action="{{url('/dopassword')}}" method="post">
									{{csrf_field()}}	
                                
							     <div class="user-email">
										<label for="email"><i class="am-icon-envelope-o"></i></label>
										<input type="email" name="email" value="{{old('email')}}" id="email" placeholder="请输入邮箱账号">
                                </div>										

                          	<div class="user-pass">
            				    <label for="passwordRepeat"><i class="am-icon-lock"></i></label>
            				     <input type="text" name="code"  id="code" placeholder="请输入验证码">

                            </div>

                             <div class="user-pass">
                                    <img id="codeImg" src="{{url('/getcode')}}" >

                             </div>                 
                                                  
							<div class="am-cf" >
								<input type="submit" id="btn" name="" value="发送重置密码邮件" class="am-btn am-btn-primary am-btn-sm am-fl">
							</div>
							
							
				            </form>
                            <div class="am-cf" >
                                <a href="{{asset('/login')}}" style="background-color: red" class="am-btn am-btn-primary am-btn-sm am-fl">返回登陆页面</a>    
                            </div>
                            </div>
                            


							<div class="am-tab-panel">
                                <form action="{{url('/phonepassword')}}" method="post">
                                    {{csrf_field()}}
                                    
                                    <div class="user-phone">
                                    <label for="phone"><i class="am-icon-mobile-phone am-icon-md"></i></label>
                                    <input type="tel" name="telphone" id="telphone" placeholder="请输入手机号">
                                    </div>                                                                         
                                        <div class="verification">
                                            <label for="code"><i class="am-icon-code-fork"></i></label>
                                            <input type="tel" name="code" id="phonecode" placeholder="请输入验证码">
                                            <a class="btn" href="javascript:void(0);" onclick="sendcode();" id="sendcode">
                                                <span id="dyMobileButton">获取</span></a>
                                        </div>
                            
                                    
                               
                                        <div class="am-cf">
                                            <input type="submit" id="phonebtn" name="btn" value="确认重置" class="am-btn am-btn-primary am-btn-sm am-fl">
                                        </div>
                                </form>
                                    <div class="am-cf" >
                                        <a href="{{asset('/login')}}" style="background-color: red" class="am-btn am-btn-primary am-btn-sm am-fl">返回登陆页面</a>    
                                    </div>

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
			
					                   <div class="footer " style="text-align: center;">
                        <div class="footer-hd ">
                            <p style="text-align: center;">
                                @foreach($links as $k=>$v)
                                <a href="{{url($v->url)}}">{{$v->lname}}</a>
                                <b>|</b>
                                @endforeach
                            </p>
                        </div>
                        <div class="footer-bd ">
                            <p style="text-align: center;">

                                <a href="# ">联系我们</a>
                                <a href="# ">网站地图</a>
                                <em>© 2015-2025 leapfrog.com 版权所有. 侵权必究</em>


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

        var h=/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;

             
        $("input").focus(function() {
            $(this).prev().css("color","#008DE8");
        });
              
        $("#email").blur(function() {
            var v=$(this).val();
            $.ajax({
                    type:"post",
                    url:"{{url('/password/ajax')}}",
                    data:{"email":v,"_token":"{{csrf_token()}}"},
                    success:function(data){
                        if(!data){
                             layer.msg("邮箱未注册！无法找回", {icon: 6});
                        }
                    },

                    dataType: "json",

             });
                 
            if (v=='') {
                layer.msg("邮箱不能为空！", {icon: 6});
            }else if(!v.match(h)){
                layer.msg("邮箱格式不符合要求！", {icon: 6});
               
            }else{
                $(this).prev().css("color","#0EA74A");
                $("[name='username']").next().html("");
            } 
        });
       
         $("[name='code']").blur(function() {
            var v=$(this).val();
            if (v=='') {
               layer.msg("验证码不能为空！", {icon: 6});
            }
        });

        $('#btn').click(function(){
        
        var email=$("#email").val();
        var codeImg=$("[name='code']").val();

        if (email=="") {
           	layer.msg("邮箱号不能为空！", {icon: 6});
            return false;
        }else if(!email.match(h)){
            layer.msg("邮箱格式不正确！", {icon: 6});
            
            return false;
        }
       
       
        if (codeImg=='') {
            layer.msg("验证码不能为空！", {icon: 6});
            $("[name='code']").prev().css("color","#f00");
            return false;
        }
        
        });

// ===============================================================
        

        //手机表单验证
        var x = /^1[3|4|5|8][0-9]\d{4,8}$/;
        $("input").focus(function() {
            $(this).prev().css("color","#008DE8");
        });
              
        $("#telphone").blur(function() {
            var v=$(this).val();
            $.ajax({
                    type:"post",
                    url:"{{url('/password/phoneajax')}}",
                    data:{"telphone":v,"_token":"{{csrf_token()}}"},
                    success:function(data){
                        if(!data){
                             layer.msg("手机未注册！", {icon: 6});
                        }
                    },

                    dataType: "json",

             });
                 
            if (v=='') {
                layer.msg("手机号不能为空！", {icon: 6});
            }else if(!v.match(x)){
                layer.msg("手机格式不符合要求！", {icon: 6});
               
            }else{
                $(this).prev().css("color","#0EA74A");
                $("[name='username']").next().html("");
            } 
        });

        
        //获取验证码
        function sendcode(){
            //1. 获取要发送的手机号
            $phone = $('#telphone').val();
            //alert($phone);

            //2. 向服务器的发送短信的接口发送ajax请求
            if($phone != "" && $phone.match(x)){
                $.post("{{url('sendcode')}}",{'phone':$phone,'_token':'{{csrf_token()}}'},function(data){
                    console.log(data);
                    var obj = JSON.parse(data);
                    if(obj.status == 0){
                        layer.msg(obj.message, {icon: 6,area: ['100px', '80px']});
                    }else{
                        layer.msg(obj.message, {icon: 5,area: ['100px', '80px']});
                    }
                })
            }else{
                layer.msg("电话格式不符合要求", {icon: 6});
            }
        }
        
         $("#phonecode").blur(function() {
            var v=$(this).val();
            if (v=='') {
               layer.msg("验证码不能为空！", {icon: 6});
            }
        });

        $('#phonebtn').click(function(){
        
        var telphone=$("#telphone").val();
        var codeImg=$("#phonecode").val();






        if (telphone=="") {
            layer.msg("手机号不能为空！", {icon: 6});
            return false;
        }else if(!telphone.match(x)){
            layer.msg("手机格式不正确！", {icon: 6});
            
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