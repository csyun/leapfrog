<!DOCTYPE html>
<html>

  <head lang="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

    <title>个人资料</title>

    <link href="{{asset('/Home/assets/css/admin.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/Home/assets/css/amazeui.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('/layer/layer.js')}}"></script>
    <link href="{{asset('/Home/css/personal.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/Home/css/infstyle.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/Home/css/colstyle.css')}}" rel="stylesheet" type="text/css">
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
                  <a href="#" target="_top" class="h">亲，请登录</a>
                  <a href="#" target="_top">免费注册</a>
                </div>
              </div>
            </ul>
            <ul class="message-r">
              <div class="topMessage home">
                <div class="menu-hd"><a href="#" target="_top" class="h">商城首页</a></div>
              </div>
              <div class="topMessage my-shangcheng">
                <div class="menu-hd MyShangcheng"><a href="#" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
              </div>
              <div class="topMessage mini-cart">
                <div class="menu-hd"><a id="mc-menu-hd" href="#" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">0</strong></a></div>
              </div>
              <div class="topMessage favorite">
                <div class="menu-hd"><a href="#" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
            </ul>
            </div>

            <!--悬浮搜索框-->

            <div class="nav white">
              <div class="logoBig">
                <li><img src="{{asset('/Home/images/logobig.png')}}"" /></li>
              </div>

              <div class="search-bar pr">
                <a name="index_none_header_sysc" href="#"></a>
                <form>
                  <input id="searchInput" name="index_none_header_sysc" type="text" placeholder="搜索" autocomplete="off">
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
                <li class="index"><a href="#">首页</a></li>
                                <li class="qc"><a href="#">闪购</a></li>
                                <li class="qc"><a href="#">限时抢</a></li>
                                <li class="qc"><a href="#">团购</a></li>
                                <li class="qc last"><a href="#">大包装</a></li>
              </ul>
                <div class="nav-extra">
                  <i class="am-icon-user-secret am-icon-md nav-user"></i><b></b>我的福利
                  <i class="am-icon-angle-right" style="padding-left: 10px;"></i>
                </div>
            </div>
      </div>
      <b class="line"></b>


    <div class="center">
      <div class="col-main">
        <div class="main-wrap">





@yield('content')










 </div>
        <!--底部-->
        <div class="footer">
          <div class="footer-hd">
            <p>
              <a href="#">恒望科技</a>
              <b>|</b>
              <a href="#">商城首页</a>
              <b>|</b>
              <a href="#">支付宝</a>
              <b>|</b>
              <a href="#">物流</a>
            </p>
          </div>
          <div class="footer-bd">
            <p>
              <a href="#">关于恒望</a>
              <a href="#">合作伙伴</a>
              <a href="#">联系我们</a>
              <a href="#">网站地图</a>
              <em>© 2015-2025 Hengwang.com 版权所有. 更多模板 <a href="http://www.cssmoban.com/" target="_blank" title="模板之家">模板之家</a> - Collect from <a href="http://www.cssmoban.com/" title="网页模板" target="_blank">网页模板</a></em>
            </p>
          </div>
        </div>
      </div>

      <aside class="menu">
        <ul>
          <li class="person">
            <a href="index.html">蛙塘中心</a>
          </li>
          <li class="person">
            <a href="#">我的蛙塘</a>
            <ul>
              <li class="active"> <a href="{{url('/pond/create')}}">创建蛙塘</a></li>
              <li> <a href="{{url('/mypond')}}">我的蛙塘</a></li>
              <li> <a href="{{url('/pondcollect')}}">收藏的蛙塘</a></li>
            </ul>
          </li>
          <li class="person">
            <a href="#">蛙塘中心</a>
            <ul>
              <li><a href="{{url('/pond')}}">蛙塘列表</a></li>
              <li> <a href="change.html">退款售后</a></li>
            </ul>
          </li>
          <li class="person">
            <a href="#">我的资产</a>
            <ul>
              <li> <a href="coupon.html">优惠券 </a></li>
              <li> <a href="bonus.html">红包</a></li>
              <li> <a href="bill.html">账单明细</a></li>
            </ul>
          </li>

          <li class="person">
            <a href="#">我的小窝</a>
            <ul>
              <li> <a href="collection.html">收藏</a></li>
              <li> <a href="foot.html">足迹</a></li>
              <li> <a href="comment.html">评价</a></li>
              <li> <a href="news.html">消息</a></li>
            </ul>
          </li>

        </ul>

      </aside>
    </div>

  </body>

</html>

