@extends('Layouts.admin')
@section('title')
    <title>后台管理系统登录界面</title>
@endsection
@section('body')

<style type="text/css">
    .button{
    color:#fff;
    background:#007eff;border: solid 1px #007eff;
}
.button:hover{
    background:#f00;
    color:#fff;
}

input{outline: none; position: relative;}
</style>
    <script src="{{asset('/Admin/assets/js/theme.js')}}"></script>
    <div class="am-g tpl-g">
        <!-- 风格切换 -->
        
        <div class="tpl-login">
            <div class="tpl-login-content">
                <div class="">
                    <img src="{{asset('/Admin/assets/img/logo-4.png')}}" width="300px" height="300px">
                </div>


                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @if(is_object($errors))
                        @foreach ($errors->all() as $error)
                            <li style="color:red">{{ $error }}</li>
                        @endforeach
                            @else
                            <li style="color:red">{{ $errors}}</li>
                            @endif
                    </ul>
                </div>
                @endif

                <form class="am-form tpl-form-line-form" action="{{url('/admin/dologin')}}" method="post">
                    {{csrf_field()}}
                    <div class="am-form-group">
                        <input type="text" name="username" value="{{ old('username') }}" class="tpl-form-input" id="user-name" placeholder="请输入账号">
                        <span style='position:absolute;left:800px;bottom:272px;font-size:13px;color: #f00;'></span>

                    </div>

                    <div class="am-form-group">
                        <input type="password" name="password" value="{{ old('password') }}"  class="tpl-form-input" id="user-name" placeholder="请输入密码">
                        <span style='position:absolute;left:800px;bottom:222px;font-size:13px;color: #f00;'></span>

                    </div>
                    <div class="am-form-group">
                        <img id="codeImg" src="{{url('/getcode')}}" >

                    </div>
                    <div class="am-form-group">
                        <input type="text" name="code" class="tpl-form-input" id="user-name" placeholder="请输入验证码">
                        <span style='position:absolute;left:800px;bottom:122px;font-size:13px;color: #f00;'></span>

                    </div>
                    
                    <div class="am-form-group tpl-login-remember-me">
                        <input id="remember-me" type="checkbox" name="remember" value="1">
                        <label for="remember-me">
       
                        记住密码
                         </label>

                    </div>

                    <div class="am-form-group">

                        <button type="submit" id="btn" class="am-btn am-btn-primary  am-btn-block tpl-btn-bg-color-success  tpl-login-btn">提交</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
   
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

        var h=/^\w{2,20}$/;;
        var d=/^\w{6,20}$/;
        
        $("input").focus(function() {
            $(this).prev().css("color","#008DE8");
        });
        
        
        $("[name='username']").blur(function() {
            var v=$(this).val();
            if (v=='') {
                $("[name='username']").next().html("账号不能为空！");
                $(this).prev().css("color","#f00");
            }else if(!v.match(h)){
                $("[name='username']").next().html("账号不合法,请输入2-20为数字字母下划线！");
                $("[name='username']").prev().css("color","#f00");
            }else{
                $(this).prev().css("color","#0EA74A");
                $("[name='username']").next().html("");
            } 
        });
        $("[name='password']").blur(function() {
            var v=$(this).val();
            if (v=='') {
                $("[name='password']").next().html("密码不能为空！");
                $(this).prev().css("color","#f00");
            }else if(!v.match(d)){
                $("[name='password']").next().html("密码至少6位！");
                $("[name='password']").prev().css("color","#f00");
            }else{
                $(this).prev().css("color","#0EA74A");
                $("[name='password']").next().html("");
            } 
        });
        
         $("[name='code']").blur(function() {
            var v=$(this).val();
            if (v=='') {
                $("[name='code']").next().html("验证码不能为空！");
                $(this).prev().css("color","#f00");
            }
        });
        $('#btn').click(function(){
        
        var name=$("[name='username']").val();
        var password=$("[name='password']").val();
        var codeImg=$("[name='code']").val();
        if (name=="") {
            $("[name='username']").next().html("账号不能为空！");
            return false;
        }else if(!name.match(h)){
            $("[name='username']").next().html("账号不合法！");
            $("[name='username']").prev().css("color","#f00");
            return false;
        }
        if (password=='') {
            $("[name='password']").next().html("密码不能为空！");
            return false;
        }else if(!password.match(d)){
            $("[name='password']").next().html("请填写正确的密码！");
            $("[name='password']").prev().css("color","#f00");
            return false;
        }
        
        if (codeImg=='') {
            $("[name='code']").next().html("验证码不能为空！");
            $("[name='code']").prev().css("color","#f00");
            return false;
        }
        
        });

    </script>
@endsection
