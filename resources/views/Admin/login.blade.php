@extends('Layouts.admin')
@section('title')
    <title>后台管理系统登录界面</title>
@endsection
@section('body')


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
                        @foreach ($errors->all() as $error)
                            <li style="color:red">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form class="am-form tpl-form-line-form" action="{{url('/admin/dologin')}}" method="post">
                    {{csrf_field()}}
                    <div class="am-form-group">
                        <input type="text" name="username" class="tpl-form-input" id="user-name" placeholder="请输入账号">

                    </div>

                    <div class="am-form-group">
                        <input type="password" name="password" class="tpl-form-input" id="user-name" placeholder="请输入密码">

                    </div>
                    <div class="am-form-group">
                        <img id="codeImg" src="{{url('/getcode')}}" >

                    </div>
                    <div class="am-form-group">
                        <input type="text" name="code" class="tpl-form-input" id="user-name" placeholder="请输入验证码">

                    </div>
                    
                    <div class="am-form-group tpl-login-remember-me">
                        <input id="remember-me" type="checkbox" name="remember" value="1">
                        <label for="remember-me">
       
                        记住密码
                         </label>

                    </div>

                    <div class="am-form-group">

                        <button type="submit" class="am-btn am-btn-primary  am-btn-block tpl-btn-bg-color-success  tpl-login-btn">提交</button>

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

        

    </script>
@endsection
