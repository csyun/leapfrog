@extends('Home.UserInfo.common')
@section('content')
    <link href="{{asset('/Home/css/orstyle.css')}}" rel="stylesheet" type="text/css">

    <div class="info-main">
        <div class="order-left" style="width:950px;margin-left: -70px;">
            @foreach($goods as $k=>$v)
            <ul class="item-list" style="width: 950px;">
                <li class="td td-item" style="width: 140px;">
                    <div class="item-pic" style="margin-top: 5px;margin-left: 5px;">
                        <a href="#" class="J_MakePoint">
                            <img src="{{$v->gpurl}}" class="itempic J_ItemImg">
                        </a>
                    </div>

                </li>
                <li class="td td-price" style="width: 80px;text-align: left;">
                    <div class="item-price">
                        价格:{{$v->gprice}}
                    </div>
                </li>
                <li class="td td-price">
                    <div class="item-price" style="width: 300px;text-align: left;">
                        商品名称:{{$v->gname}}
                    </div>
                </li>
                <li class="td td-price">
                    <div class="item-price" style="width: 300px;text-align: left;margin-left: 40px;">
                        商品描述:{!! $v->gdesc !!}
                    </div>
                </li>
                <li class="td td-price">
                    <div class="item-price" style="width: 80px;text-align: left;margin-left: 240px;">
                        状态:
                        @if($v->status==0)上架
                            @elseif($v->status==1)下架
                            @elseif($v->status==2)已售出
                            @endif
                    </div>
                </li>
                <li class="td td-price">
                    <div class="item-price" style="width: 150px;text-align: left;margin-left: 240px;">
                        操作:
                        @if($v->status == 2)
                        <a href="">已售出</a>
                        @else
                            <a href="javascript:;" onclick="gstatus({{$v->gid}},{{$v->status}})">
                                @if($v->status == 0)
                                    下架
                                @elseif($v->status == 1)
                                    上架
                                @endif
                            </a>
                        @endif

                            <a href="{{url('goods/gstatus/'.$v->gid)}}"> 编辑  </a><a href="javascript:;" onclick="goodsDel({{$v->gid}})">  删除</a>

                    </div>
                </li>
            </ul>
        @endforeach
                <script type="text/javascript">
                    function  gstatus(gid,status) {
                        if(status  == 0){
                            var tanchu =  '您确认要下架吗?'
                        }else{
                            var tanchu =  '您确认要上架吗?'
                        };
                        layer.confirm(tanchu,{
                            btn:['确认','取消']
                        },function () {
                            $.get("{{url('home/goods/gstatus')}}/"+gid,function(data){

//                    修改状态成功
                                if(data.gg == 0){
                                    layer.msg(data.msg, {icon: 6});
                                    var t=setTimeout("location.href = location.href;",2000);
                                }else if(data.gg == 1){
                                    layer.msg(data.msg, {icon: 5});

                                    var t=setTimeout("location.href = location.href;",2000);
                                }else{
                                    layer.msg(data.msg, {icon: 2});
                                    var t=setTimeout("location.href = location.href;",2000);
                                }
                            });

                        })
                    }

                    function goodsDel(gid) {

                        layer.confirm('您确认要删除吗?',{
                            btn:['确认','取消']
                        },function () {
                            $.get("{{url('home/goods/goodsdel')}}/"+gid,function(data){

//                    删除成功
                                if(data.gg == 0){
                                    layer.msg(data.msg, {icon: 6});
                                    var t=setTimeout("location.href = location.href;",2000);
                                }else if(data.gg == 1){
                                    layer.msg(data.msg, {icon: 5});

                                    var t=setTimeout("location.href = location.href;",2000);
                                }else{
                                    layer.msg(data.msg, {icon: 2});
                                    var t=setTimeout("location.href = location.href;",2000);
                                }



                            });

                        })
                    }
                </script>

        </div>

    </div>
@endsection