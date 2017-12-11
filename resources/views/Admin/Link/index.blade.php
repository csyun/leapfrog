@extends('Admin.head')

@section('content')

    <div class="tpl-content-wrapper">
        <div class="row-content am-cf">
            <div class="row">
                <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                    <div class="widget am-cf">
                        <div class="widget-head am-cf">
                            <div class="widget-title  am-cf">友情链接列表</div>


                        </div>
                        <div class="widget-body  am-fr">

                            <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                                <div class="am-form-group">
                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                            <a href="{{url('admin/link/create')}}">  <button type="button" class="am-btn am-btn-default am-btn-success"> <span class="am-icon-plus"></span> 新增</button></a>

                                        </div>
                                    </div>
                                </div>
                            </div>


                     <form action="{{url('admin/link')}}" method="get">
                            <div class="am-u-sm-12">
                                <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r" style=" border-width:0px;">
                                    <thead>
                                    <tr>

                                        <th>友情链接Id</th>
                                        <th>友情链接名称</th>
                                        <th>友情链接URL</th>
                                        <th>友情链接排序</th>

                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    @foreach($link as $k=>$v)
                                        <tbody>
                                        <tr class="gradeX" style=" border-width:0px;">

                                            <td>{{$v->lid}}</td>


                                            <td>{{$v->lname}}</td>
                                            <td>{{$v->url}}</td>
                                            <td>
                                                <input type="text" style="background: #5D6468;width:30px;margin-top: 30px;margin-left: 10px;" name="order" value="{{$v->order}}" onchange="changeOrder(this,{{$v->lid}}) "></td>
                                            <td>
                                                <div class="tpl-table-black-operation">
                                                    <a href="{{url('admin/link/'.$v->lid.'/edit')}}">
                                                        <i class="am-icon-pencil"></i> 编辑
                                                    </a>
                                                    <a href="javascript:;" onclick="linkDel({{$v->lid}})" class="tpl-table-black-operation-del">
                                                        <i class="am-icon-trash"></i> 删除
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- more data -->
                                        </tbody>
                                    @endforeach
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="http://leapfrog.com/layer/layer.js"></script>
    <script>
          
        function changeOrder(obj,lid){
        var order = $(obj).val();
        $.post("{{url('admin/link/changeorder')}}",{'_token':"{{csrf_token()}}","lid":lid,"order":order},function(link){

            if(link.status == 0){

                layer.msg(link.msg,{icon: 6});
                location.href = location.href;
            }else{
                layer.msg(link.msg,{icon: 5});
                location.href = location.href;
            }
        })
    }


        function linkDel(id) {

            layer.confirm('您确认要删除吗?',{
                btn:['确认','取消']
            },function () {
                $.post("{{url('admin/link')}}/"+id,{"_method":"delete","_token":"{{csrf_token()}}"},function(link){

//                    删除成功
                    if(link.error == 0){
                        layer.msg(link.msg, {icon: 6});
                        var t=setTimeout("location.href = location.href;",2000);
                    }else if(link.error == 1){
                        layer.msg(link.msg, {icon: 5});

                        var t=setTimeout("location.href = location.href;",2000);
                    }else{
                        layer.msg(link.msg, {icon: 2});
                        var t=setTimeout("location.href = location.href;",2000);
                    }


                });

            })
        }
    </script>
@stop