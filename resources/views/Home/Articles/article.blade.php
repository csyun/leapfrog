@extends('Layouts.home')
@section('title')
    <title>头条资讯</title>
@endsection
@section('body')
    <div class="am-g am-g-fixed blog-g-fixed bloglist" >
        <div class="am-u-md-9">
            <article class="blog-main">
                <h3 class="am-article-title blog-title">
                    <a href="#">{{$articleinfo->title}}</a>
                </h3>
                <h4 class="am-article-meta blog-meta">{{date("Y-m-d H:i:s",$articleinfo->create_time)}}</h4>

                <div class="am-g blog-content">
                    <div class="am-u-sm-12">
                        {!! $articleinfo->content !!}

                    </div>

                </div>

            </article>


            <hr class="am-article-divider blog-hr">

        </div>

        <div class="am-u-md-3 blog-sidebar">
            <div class="am-panel-group">

                <section class="am-panel am-panel-default">
                    <div class="am-panel-hd">头条资讯</div>
                    <ul class="am-list blog-list">
                        @foreach($articles as $k=>$v)
                        <li><a href="{{url('/articles/')}}/{{$v->aid}}"><p>[{{$v->tags}}]{{$v->title}}</p></a></li>

                        @endforeach
                    </ul>
                </section>

            </div>
        </div>

    </div>
@endsection