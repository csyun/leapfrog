@extends('Admin.head')

<!--
 * 后台用户列表页
 * @author [苏波] <386249656@qq.com>
 * @data 2017-11-27 20:10
 * 
  -->

@section('content')
    
        <div class="tpl-content-wrapper">
            <div class="row-content am-cf">
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title  am-cf"><h2>等待审核蛙塘列表</h2></div>
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
                                                <a href="{{url('admin/pond/passlist')}}"><button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 
                                                已通过蛙塘列表</button></a>

                                            </div>
                                             <div class="am-btn-group am-btn-group-xs">
                                                <a href="{{url('admin/pond/notpasslist')}}"><button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 
                                                未通过蛙塘列表</button></a>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- 搜索 -->
                                <form action="{{url('/admin/pond')}}" method="get">
                                {{csrf_field()}}
                                
                                <div class="am-u-sm-12 am-u-md-12 am-u-lg-3">
                                    <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
                                        <input type="text" class="am-form-field " name="key" placeholder="请输入蛙塘名关键字" value="{{$request->key}}">
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
                                                <th>蛙塘名</th>
                                                <th>最后登陆时间</th>
                                                <th>创建者</th>
                                                <th>蛙塘头像</th>
                                                <th>状态</th>
                                              
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                          @foreach($data as $k=>$v)
											<tr>
                                                <td>{{$v->mname}}</td>
												<td>{{date('Y-m-d H:i:s',$v->creat_time)}}</td>
                                                <td>{{$v->creator}}</td>
                                                <td><img style="height: 60px" src="{{url($v->avatar)}}"></td>
                                                <td>等待审核</td>
												
												<td>
                                                    <div class="tpl-table-black-operation">
                                                        
                                                        
                                                        <a href="javascript:;" id="pass" onclick="pass({{$v->mid}})" class="tpl-table-black-operation-del">
                                                            <i class="am-icon-trash"></i> 通过审核
                                                        </a>
                                                        <a href="javascript:;" onclick="notpass({{$v->mid}})" class="tpl-table-black-operation-del">
                                                            <i class="am-icon-trash"></i> 审核未通过
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


          

            function pass(id) {

                // layer.alert('内容');
           
                layer.confirm('您确认通过审核吗？', {
                    btn: ['确认','取消'] //按钮
                }, function(){

                $.ajax({
                    type:"post",
                    url:"{{url('/admin/pond/pass')}}",
                    data:{"mid":id,"_token":"{{csrf_token()}}"},
                    success:function(data){
                        if(data){
                            layer.msg("通过审核！", {icon: 6});
                            var t=setTimeout("location.href = location.href;",2000);
                        }else{
                            layer.msg("通过审核操作失败！", {icon: 6});
                            var t=setTimeout("location.href = location.href;",2000);
                        }
                    },

                    dataType: "json",

                });                   

                }, function(){

                });
            }

            //不通过审核
            function notpass(id) {

                // layer.alert('内容');
           
                layer.confirm('您确认该蛙塘不通过审核吗？', {
                    btn: ['确认','取消'] //按钮
                }, function(){

                $.ajax({
                    type:"post",
                    url:"{{url('/admin/pond/notpass')}}",
                    data:{"mid":id,"_token":"{{csrf_token()}}"},
                    success:function(data){
                        if(data){
                            layer.msg("该蛙塘未通过审核！", {icon: 6});
                            var t=setTimeout("location.href = location.href;",2000);
                        }else{
                            layer.msg("不通过审核操作失败！", {icon: 6});
                            var t=setTimeout("location.href = location.href;",2000);
                        }
                    },

                    dataType: "json",

                });                   

                }, function(){

                });
            }




        </script>
@stop







