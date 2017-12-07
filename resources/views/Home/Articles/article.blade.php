@extends('Layouts.home')
@section('title')
    <title>头条资讯</title>
@endsection
@section('body')
    <div class="am-g am-g-fixed blog-g-fixed bloglist">
        <div class="am-u-md-9">
            <article class="blog-main">
                <h3 class="am-article-title blog-title">
                    <a href="#">{{$articleinfo->title}}</a>
                </h3>
                <h4 class="am-article-meta blog-meta">2014-06-17 09:52</h4>

                <div class="am-g blog-content">
                    <div class="am-u-sm-12">
                        {!! $articleinfo->content !!}

                    </div>

                </div>

            </article>


            <hr class="am-article-divider blog-hr">
            <ul class="am-pagination blog-pagination">
                <li class="am-pagination-prev"><a href="">&laquo; 上一页</a></li>
                <li class="am-pagination-next"><a href="">下一页 &raquo;</a></li>
            </ul>
        </div>

        <div class="am-u-md-3 blog-sidebar">
            <div class="am-panel-group">

                <section class="am-panel am-panel-default">
                    <div class="am-panel-hd">热门话题</div>
                    <ul class="am-list blog-list">
                        <li><a href="#"><p>[特惠]闺蜜喊你来囤国货啦</p></a></li>
                        <li><a href="#"><p>[公告]华北、华中部分地区配送延迟</p></a></li>
                        <li><a href="#"><p>[特惠]家电狂欢千亿礼券 买1送1！</p></a></li>
                        <li><a href="#"><p>[公告]商城与广州市签署战略合作协议</p></a></li>
                        <li><a href="#"><p>[特惠]洋河年末大促，低至两件五折</p></a></li>
                    </ul>
                </section>

            </div>
        </div>

    </div>
@endsection