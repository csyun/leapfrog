@extends('Admin.head')

<!--
 * 后台用户列表页
 * @author [苏波] <386249656@qq.com>
 * @data 2017-11-27 20:10
 * 
  -->

@section('content')
<script src="{{asset('/layer/layer.js')}}"></script>
        <div class="tpl-content-wrapper">
            <div class="row-content am-cf">
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title  am-cf">后台用户列表</div>
                                @if (count($errors) > 0)
                                        <div id="lan" style="display:none" >
                                            <ul>
                                             @if(is_object($errors))
                                                @foreach ($errors->all() as $error)
                                                    <li class="aa" style="display:none">{{ $error }}</li>
                                                    <script type="text/javascript">
                                                        var a = $(".aa").html();
                                                        layer.msg(a, {icon: 6});
                                                    </script>                                                    
                                                @endforeach
                                            @else
                                                <li class="aa" style="display:none">{{ $errors }}</li>
                                                <script type="text/javascript">
                                                    var a = $(".aa").html();
                                                     layer.msg(a, {icon: 6});   
                                                </script>                                                
                                            @endif
                                            </ul>
                                        </div>
                                @endif
                            </div>
                            
                            <div class="widget-body  am-fr">

                                <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                                    <div class="am-form-group">
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <a href="{{url('admin/permission/create')}}"><button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 
                                                添加权限</button></a>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- 搜索 -->
                                <form action="{{url('/admin/permission/')}}" method="get">
                                {{csrf_field()}}
                            
                                <div class="am-u-sm-12 am-u-md-12 am-u-lg-3">
                                    <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
                                        <input type="text" class="am-form-field " name="key" placeholder="请输入用户名关键字" value="{{$request->key}}">
                                        <span class="am-input-group-btn">
                                        <button class="am-btn  am-btn-default am-btn-success tpl-table-list-field am-icon-search" type="submit"></button>
                                      </span>
                                    </div>
                                </div>
                                </from>

                                
                                <div class="am-u-sm-12">
                                    <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
                                        <thead>
                                            <tr>
                                                <th>权限名</th>
                                                <th>描述</th>
                                              
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                          @foreach($data as $k=>$v)
											<tr>
                                                <td>{{$v->pname}}</td>
												<td>{{$v->desc}}</td>
												
												
												<td>
                                                    <div class="tpl-table-black-operation">
                                                        
                                                        <a href="{{url('/admin/permission/'.$v->pid.'/edit')}}">
                                                            <i class="am-icon-pencil"></i> 编辑
                                                        </a>
                                                        <a href="javascript:;" onclick="userDel({{$v->pid}})" class="tpl-table-black-operation-del">
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
                                         {!! $data->appends($request->all())->render() !!}
                                    </div>
                                </div>
                                


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>

    
          

            function userDel(id) {

                // layer.alert('内容');
           
                layer.confirm('您确认删除吗？', {
                    btn: ['确认','取消'] //按钮
                }, function(){
                    //如果用户发出删除请求，应该使用ajax向服务器发送删除请求
                    //$.get("请求服务器的路径","携带的参数", 获取执行成功后的额返回数据);

                    $.post("{{url('admin/permission')}}/"+id,{"_method":"delete","_token":"{{csrf_token()}}"},function(data){

                        //data是json格式的字符串，在js中如何将一个json字符串变成json对象

                        //删除成功
                        if(data.error == 0){
                            //console.log("错误号"+res.error);
                            //console.log("错误信息"+res.msg);
                            layer.msg(data.msg, {icon: 6});
                            //location.href = location.href;
                            var t=setTimeout("location.href = location.href;",2000);
                        }else{
                            layer.msg(data.msg, {icon: 5});

                            var t=setTimeout("location.href = location.href;",2000);
                            //location.href = location.href;
                        }


                    });


                }, function(){

                });
            }



        </script>
@stop