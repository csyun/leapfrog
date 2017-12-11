@extends('Admin.head')
@section('content')
<div class="tpl-content-wrapper">
        <div class="row-content am-cf">
            <div class="row">
                <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">

                <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">{{config('webconfig.web_title')}}</a> &raquo; <a href="#" style="color:#0e90D2"><b>网站配置管理</b></a> &raquo; <b style="color: #0e90D2">添加网站配置</b>
    </div>

                    <div class="widget am-cf">
                        <div class="widget-head am-cf">
                            <div class="widget-title  am-cf">网站配置列表</div>


                        </div>
                        <div class="widget-body  am-fr">

                            <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                                <div class="am-form-group">
                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                            <a href="{{url('admin/config/create')}}">  <button type="button" class="am-btn am-btn-default am-btn-success"> <span class="am-icon-plus"></span> 新增</button></a>

                                        </div>
                                    </div>
                                </div>
                            </div>

        
                        
                        <div class="am-u-sm-12 am-u-md-12 am-u-lg-3">
                            <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
                                @if(session('msg'))

                                @endif
                                
                            </div>
                        </div>
                        <form action="{{url('admin/config/contentchange')}}" method="post">
                        <div class="am-u-sm-12">
                            <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black ">
                                
                                <tr>
                                    <th>排序</th>
                                    <th>ID</th>
                                    <th>标题</th>
                                    <th>名称</th>
                                    <th>内容</th>
                                    <th>操作</th>
                                </tr>
                                
                                
                                {{csrf_field()}}
               
                                 @foreach($config as $k=>$v)
                                 
                                <tr class="gradeX">
                                    <td>
                                        <input type="text" style="background: #5D6468;width:30px;margin-top: 30px;margin-left: 10px;" onchange="changeOrder(this,{{$v->conf_id}})" value="{{$v->conf_order}}" >
                                    </td>
                                    <td class="tc">{{$v->conf_id}}</td>

                                    <td>
                                        <a href="#">{{$v->conf_title}}</a>
                                    </td>
                                    <td>{{$v->conf_name}}</td>


                                    <td>  <input type="hidden" style="background: #5D6468;width:30px;margin-top: 30px; margin-left: 10px;" name="conf_id[]" class="i-d" value="{{$v->conf_id}}">

                                       {!! $v->conf_contents !!}
                                    

                                    </td>
                                    <td class="am-text-middle">
                                        <div class="tpl-table-black-operation">
                                            
                                            <a href="{{url('/admin/config/'.$v->conf_id.'/edit')}}">
                                                <i class="am-icon-pencil"></i> 修改
                                            </a>
                                            <a href="javascript:;" onclick="configDel({{$v->conf_id}})" class="tpl-table-black-operation-del">
                                                        <i class="am-icon-trash"></i> 删除
                                                    </a>
                                        </div>  
                                    </td>
                                </tr>
                                  @endforeach
                                <tr >
                                        <td colspan="6" style='text-align:center;'> 
                                        <input type="submit" onclick="configEdit({{$v->conf_id}})" class="am-btn am-btn-primary tpl-btn-bg-color-success " value="提交">
                                        </td>
                                </tr>
                            </table>
                        </div>
                        </form>
                    </div>
                </div>




            </div>
        </div>
    </div>
</div>

        
<script src="http://leapfrog.com/layer/layer.js"></script>
<script>
       
       function changeOrder(obj,config_id){
        var config_order = $(obj).val();
        console.log(config_id);
        $.post("{{url('admin/config/changeorder')}}",{'_token':"{{csrf_token()}}","config_id":config_id,"config_order":config_order},function(data){

            if(data.status == 0){

                layer.msg(data.msg,{icon: 6});
                location.href = location.href;
            }else{
                layer.msg(data.msg,{icon: 5});
                location.href = location.href;
            }
        })
    } 

        function configDel(id) {

            layer.confirm('您确认要删除吗?',{
                btn:['确认','取消']
            },function () {
                $.post("{{url('admin/config')}}/"+id,{"_method":"delete","_token":"{{csrf_token()}}"},function(data){

                    //删除成功
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

        function configEdit(id) {
            layer.confirm('修改成功',{
                btn:['确认','取消']
            },function () {
                
                $.post("{{url('admin/config/contentchange')}}/"+id,{"_method":"update","_token":"{{csrf_token()}}"},function(data){

                    //修改成功
                    console.log(data);
                    if(data.error == 0){
                        layer.msg(data.msg, {icon: 6});
                        // var t=setTimeout("location.href = location.href;",2000);
                    }else if(data.error == 1){
                        layer.msg(data.msg, {icon: 5});

                        // var t=setTimeout("location.href = location.href;",2000);
                    }else{
                        layer.msg(data.msg, {icon: 2});
                        // var t=setTimeout("location.href = location.href;",2000);
                    }
                });

            })
        }




    </script>
        

@stop
