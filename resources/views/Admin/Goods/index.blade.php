@extends('Admin.head')

@section('content')

<script src="{{asset('/layer/layer.js')}}"></script>

        <!-- 内容区域 -->
        <div class="tpl-content-wrapper">
            <div class="row-content am-cf">
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title  am-cf">商品列表</div>
                                <ul>
                                    @if(session('msg'))
                                        <li style="color:#00ff6a">{{session('msg')}}</li>
                                    @endif
                                </ul>


                            </div>
                            <div class="widget-body  am-fr">

                                <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                                    <div class="am-form-group">
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <a href="{{url('admin/goods/create')}}">  <button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 新增</button></a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{url('admin/goods')}}" method="get">
                                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-3">
                                        商品名称:
                                    </div>

                                <div class="am-u-sm-12 am-u-md-12 am-u-lg-3">
                                    <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
                                        <input type="text" class="am-form-field " name="keywords1" value="{{$request->keywords1}}">
                                        <span class="am-input-group-btn">
            <button class="am-btn  am-btn-default am-btn-success tpl-table-list-field am-icon-search" type="submit"></button>
          </span>
                                    </div>
                                </div>
                                </form>
                                <div class="am-u-sm-12">
                                    <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black ">
                                        <thead>
                                            <tr>
                                                <th>商品缩略图</th>
                                                <th>商品名称</th>
                                                <th>商品价格</th>
                                                <th>商品描述</th>
                                                <th>商品状态</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($good as $k=>$v)
                                            <tr class="gradeX">
                                                <td>
                                                    <img src="{{$v->gpurl}}" class="tpl-table-line-img" alt="">
                                                </td>
                                                <td class="am-text-middle">{{$v->gname}}</td>
                                                <td class="am-text-middle">{{$v->gprice}}</td>
                                                <td class="am-text-middle">{!!$v->gdesc!!}</td>
                                                @if($v->status == 2)
                                                    <td class="am-text-middle"><button  class="am-icon-pencil">
                                                            已售出
                                                        </button></td>
                                                @else
                                                <td class="am-text-middle"><button  class="am-icon-pencil" onclick="gstatus({{$v->gid}},{{$v->status}})">
                                                        @if($v->status == 0)
                                                            下架
                                                            @elseif($v->status == 1)
                                                            上架
                                                            @endif
                                                    </button></td>
                                                @endif

                                                <td class="am-text-middle">
                                                    <div class="tpl-table-black-operation">
                                                        <a href="{{url('admin/goods/'.$v->gid.'/edit')}}">
                                                            <i class="am-icon-pencil"></i> 编辑
                                                        </a>
                                                        {{--<a href="{{url('admin/goods/detailsimg/')}}">--}}
                                                            {{--<i class="am-icon-pencil"></i> 添加商品细节--}}
                                                        {{--</a>--}}
                                                        <a href="javascript:;" onclick="goodsDel({{$v->gid}})"class="tpl-table-black-operation-del">
                                                            <i class="am-icon-trash"></i> 删除
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            <!-- more data -->
                                        </tbody>
                                    </table>
                                </div>
                                <div class="am-u-lg-12 am-cf">

                                    <div class="am-fr">
                                        {{--appends(['keyword1'=>'a','keyword2'=>'aaa@q163.com','num'=>2])--}}
                                        {!! $good->appends($request->all())->render() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                $.get("{{url('admin/goods/gstatus')}}/"+gid,function(data){

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
                $.post("{{url('admin/goods')}}/"+gid,{"_method":"delete","_token":"{{csrf_token()}}"},function(data){

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
    @stop