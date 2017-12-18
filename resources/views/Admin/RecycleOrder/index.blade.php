@extends('Admin.head')

@section('content')
 <script src="{{asset('/layer/layer.js')}}"></script>
    <div class="tpl-content-wrapper">
        <div class="row-content am-cf">
            <div class="row">
                <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                    <div class="widget am-cf">
                        <div class="widget-head am-cf">
                            <div class="widget-title  am-cf">回收商品订单列表</div>


                        </div>
                        <div class="widget-body  am-fr">

                            <div class="am-u-sm-12">
                                <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
                                    <thead>
                                    <tr>

                                        <th>订单编号</th>
                                        <th>联系人</th>
                                        <th>电话</th>
                                        <th>下单时间</th>
                                        <th>订单状态</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    @foreach($recycleorders as $k=>$v)
                                        <tbody>
                                        <tr class="gradeX">
                                            <td>{{$v->roid}}</td>
                                            <td>{{$v->rcname}}</td>
                                            <td>{{$v->rctel}}</td>
                                            <td>{{date('Y-m-d H:i:s',$v->creat_time)}}</td>
                                            <td>
                                                @if($v->status==0)提交
                                                    @elseif($v->status==1)确认
                                                @elseif($v->status==2)上门回收中
                                                @elseif($v->status==3)已完成
                                                    @endif
                                            </td>
                                            <td>
                                                <div class="tpl-table-black-operation">
                                                    <a href="{{url('admin/recycleorders/'.$v->roid)}}">
                                                        <i class="am-icon-pencil"></i> 查看
                                                    </a>
                                                    <a href="javascript:;" onclick="cateDel({{$v->roid}})" class="tpl-table-black-operation-del">
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
                $.post("{{url('admin/recyclegoodattribute')}}/"+id,{"_method":"delete","_token":"{{csrf_token()}}"},function(data){

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