@extends('Admin.head')

@section('content')

    <div class="tpl-content-wrapper">
        <div class="row-content am-cf">
            <div class="row">
                <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                    <div class="widget am-cf">
                        <div class="widget-head am-cf">
                            <div class="widget-title  am-cf">回收商品列表</div>


                        </div>
                        <div class="widget-body  am-fr">

                            <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                                <div class="am-form-group">
                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                            <a href="{{url('admin/recyclegoods/create')}}">  <button type="button" class="am-btn am-btn-default am-btn-success"> <span class="am-icon-plus"></span> 新增</button></a>

                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="am-u-sm-12">
                                <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
                                    <thead>
                                    <tr>
                                        <th>商品Id</th>
                                        <th>商品名称</th>
                                        <th>商品图</th>
                                        <th>商品基价</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    @foreach($recyclegoods as $k=>$v)
                                        <tbody>
                                        <tr class="gradeX">

                                            <td>{{$v->rgid}}</td>
                                            <td>{{$v->rgname}}</td>
                                            <td>
                                                <img src="http://p0a39ed4q.bkt.clouddn.com{{$v->rgpic}}" style="width: 80px;height: 80px;" class="tpl-table-line-img" alt="">
                                            </td>
                                            <td>{{$v->rgprice}}</td>

                                            <td>
                                                <div class="tpl-table-black-operation">
                                                    <a href="{{url('admin/recyclegoods/'.$v->rgid.'/edit')}}">
                                                        <i class="am-icon-pencil"></i> 编辑
                                                    </a>
                                                    <a href="javascript:;" onclick="cateDel({{$v->rgid}})" class="tpl-table-black-operation-del">
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

        function cateDel(id) {

            layer.confirm('您确认要删除吗?',{
                btn:['确认','取消']
            },function () {
                $.post("{{url('admin/recyclegoods')}}/"+id,{"_method":"delete","_token":"{{csrf_token()}}"},function(data){

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