@extends('Admin.head')

@section('content')

    <div class="tpl-content-wrapper">
        <div class="row-content am-cf">
            <div class="row">
                <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                    <div class="widget am-cf">
                        <div class="widget-head am-cf">
                            <div class="widget-title  am-cf">轮播图列表</div>


                        </div>
                        <div class="widget-body  am-fr">

                            <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                                <div class="am-form-group">
                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                            <a href="{{url('admin/slideshow/create')}}">  <button type="button" class="am-btn am-btn-default am-btn-success"> <span class="am-icon-plus"></span> 新增</button></a>

                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="am-u-sm-12">
                                <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
                                    <thead>
                                    <tr>
                                        <th>排序</th>
                                        <th>轮播图Id</th>
                                        <th>轮播图</th>
                                        <th>名称</th>
                                        <th>跳转网址</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    @foreach($slideshows as $k=>$v)
                                        <tbody>
                                        <tr class="gradeX">
                                            <td>
                                                <input type="text" style="background: #5D6468;width:30px;margin-top: 30px;margin-left: 10px;" name="number" value="{{$v->order}}" onchange="changeOrder(this,{{$v->sid}}) "></td>
                                            <td>{{$v->sid}}</td>
                                            <td>
                                                <img src="http://leapfrog.oss-cn-beijing.aliyuncs.com/{{$v->art_thumb}}" style="width: 80px;height: 80px;" class="tpl-table-line-img" alt="">
                                            </td>

                                            <td>{{$v->slidiesname}}</td>
                                            <td>{{$v->surl}}</td>
                                            <td>
                                                <div class="tpl-table-black-operation">
                                                    <a href="{{url('admin/slideshow/'.$v->sid.'/edit')}}">
                                                        <i class="am-icon-pencil"></i> 编辑
                                                    </a>
                                                    <a href="javascript:;" onclick="cateDel({{$v->sid}})" class="tpl-table-black-operation-del">
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
        var str = "{{session('msg')}}";
        if(str!=''){
            layer.msg(str,{icon: 6});
        }
        function changeOrder(obj,sid){
            var order = $(obj).val();
            $.post("{{url('admin/slideshow/changeorder')}}",{'_token':"{{csrf_token()}}","sid":sid,"order":order},function(data){

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
                $.post("{{url('admin/slideshow')}}/"+id,{"_method":"delete","_token":"{{csrf_token()}}"},function(data){

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