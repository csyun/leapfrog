<!DOCTYPE html>
<html>

  <head lang="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

    <title>蛙塘中心</title>

    <link href="{{asset('/Home/assets/css/admin.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/Home/assets/css/amazeui.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('/layer/layer.js')}}"></script>
    <link href="{{asset('/Home/css/personal.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/Home/css/infstyle.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/Home/css/colstyle.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/Home/css/footstyle.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/Home/css/systyle.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/Home/css/cmstyle.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/Home/css/blstyle.css')}}" rel="stylesheet" type="text/css">

    
    <script src="{{asset('/Home/assets/js/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/Home/assets/js/amazeui.js')}}" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

      
  </head>

  <body>
    <!--头 -->
    <header>
      <article>
        <div class="mt-logo">
          <!--顶部导航条 -->
          <div class="am-container header">
            <ul class="message-l">
              <div class="topMessage">
                <div class="menu-hd">
                  <a href="#" target="_top" class="h">你好,{{Session::get('homeuser.uname')}}</a>
                  <a href="#" target="_top"></a>
                </div>
              </div>
            </ul>
            <ul class="message-r">
              <div class="topMessage home">
                <div class="menu-hd"><a href="{{url('/')}}" target="_top" class="h">商城首页</a></div>
              </div>
              <div class="topMessage my-shangcheng">
                <div class="menu-hd MyShangcheng"><a href="{{url('/userinfo')}}" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
              </div>
              <div class="topMessage mini-cart">
                <div class="menu-hd"><a id="mc-menu-hd" href="{{url('/home/shopcart/cart/index')}}" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">0</strong></a></div>
              </div>
              <div class="topMessage favorite">
               
            </ul>
            </div>

            <!--悬浮搜索框-->

            <div class="nav white">
              <div class="logoBig">
                <li><img src="{{asset('/Home/images/logo-home.png')}}"" /></li>
              </div>

              <div class="search-bar pr">
                <a name="index_none_header_sysc" href="#"></a>
                <form action="{{url('/home/goods/seach')}}" method="post">
                  {{csrf_field()}}
                  <input id="searchInput" name="gname" type="text" placeholder="搜索" autocomplete="off">
                  <input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit">
                </form>
              </div>
            </div>

            <div class="clear"></div>
          </div>
        </div>
      </article>
    </header>
            <div class="nav-table">
             <div class="long-title"><span class="all-goods">全部分类</span></div>
             <div class="nav-cont">
              <ul>
                <li class="index"><a href="{{asset('/')}}">首页</a></li>
            @foreach($navs as $k=>$v)
            <li class="qc"><a href="{{url($v->nav_url)}}">{{$v->nav_name}}</a></li>
            @endforeach
              </ul>

            </div>
      </div>
      <b class="line"></b>


    <div class="center">
      <div class="col-main">
        <div class="main-wrap">





@yield('content')










 </div>
        <!--底部-->

      </div>

      <aside class="menu">
        <ul>
          <li class="person">
            <a href="index.html">蛙塘中心</a>
          </li>
          <li class="person">
            <a href="#">蛙塘</a>
            <ul>
              <li class="active"> <a href="{{url('/pond/create')}}">创建蛙塘</a></li>
              <li> <a href="{{url('/mypond')}}">我的蛙塘</a></li>
              
            </ul>
          </li>
          <li class="person">
            <a href="#">蛙塘中心</a>
            <ul>
              <li> <a href="{{url('/pondcollect')}}">收藏的蛙塘</a></li>
              <li><a href="{{url('/pond')}}">蛙塘列表</a></li>         
            </ul>
          </li>
          

        </ul>

      </aside>
    </div>

  </body>

</html>

