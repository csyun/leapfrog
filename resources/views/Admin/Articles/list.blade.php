@extends('Admin.head')
@section('content')
<!-- 内容区域 -->
<div class="tpl-content-wrapper">
    <div class="row-content am-cf">
        <div class="row">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                <div class="widget am-cf">
                    <div class="widget-head am-cf">
                        <div class="widget-title  am-cf">文章列表</div>


                    </div>
                    <div class="widget-body  am-fr">

                        <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                            <div class="am-form-group">
                                <div class="am-btn-toolbar">
                                    <li style="color:#00ff6a"></li>
                                    <script>



                                    </script>
                                </div>
                            </div>
                        </div>
                        <form action="{{url('admin/articles')}}" method="get">
                        <div class="am-u-sm-12 am-u-md-12 am-u-lg-3">
                            <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
                                @if(session('msg'))

                                @endif
                                <input type="text" name="keywords" value="" placeholder="请输入标题关键字" class="am-form-field ">
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
                                    <th>排序</th>
                                    <th>文章缩略图</th>
                                    <th>文章标题</th>
                                    <th>作者</th>
                                    <th>时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($articles as $k=>$v)
                                <tr class="gradeX">
                                    <td>
                                        <input type="text" style="background: #5D6468;width:30px;margin-top: 30px;margin-left: 10px;" name="number" value="{{$v->number}}" onchange="changeOrder(this,{{$v->aid}}) "></td>
                                    <td>
                                        <img src="http://p0a39ed4q.bkt.clouddn.com/{{$v->art_thumb}}" style="width: 80px;height: 80px;" class="tpl-table-line-img" alt="">
                                    </td>
                                    <td class="am-text-middle">{{$v->title}}</td>
                                    <td class="am-text-middle">{{$v->auth}}</td>
                                    <td class="am-text-middle">{{date('Y-m-d H:i:s',$v->create_time)}}</td>
                                    <td class="am-text-middle">
                                        <div class="tpl-table-black-operation">
                                            <a href="{{url('admin/articles/'.$v->aid.'/edit')}}"">
                                                <i class="am-icon-pencil"></i> 编辑
                                            </a>
                                            <a href="javascript:;" onclick="cateDel({{$v->aid}})" class="tpl-table-black-operation-del">
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
                                {!! $articles->appends($request->all())->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="http://leapfrog.com/layer/layer.js"></script>

<script>
    var str = "{{session('msg')}}";
    if(str!=''){
        layer.msg(str,{icon: 6});
    }
    function changeOrder(obj,aid){
        var number = $(obj).val();
        $.post("{{url('admin/articles/changeorder')}}",{'_token':"{{csrf_token()}}","aid":aid,"number":number},function(data){

            if(data.status == 0){

                layer.msg(data.msg,{icon: 6});
                location.href = location.href;
            }else{
                layer.msg(data.msg,{icon: 5});
                location.href = location.href;
            }
        })
    }
    function cateDel(id) {

        layer.confirm('您确认要删除吗?',{
            btn:['确认','取消']
        },function () {
            $.post("{{url('admin/articles')}}/"+id,{"_method":"delete","_token":"{{csrf_token()}}"},function(data){

//                    删除成功
                if(data.error == 0){
                    layer.msg(data.msg, {icon: 6});
                    var t=setTimeout("location.href = location.href;",2000);
                }else if(data.error == 1){
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
