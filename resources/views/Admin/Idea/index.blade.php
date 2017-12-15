@extends('Admin.head')


@section('content')
<script src="{{asset('/layer/layer.js')}}"></script>
        <div class="tpl-content-wrapper">
            <div class="row-content am-cf">
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title  am-cf">意见反馈列表</div>
                                @if (count($errors) > 0)
                                        <div id="lan" >
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
                                                <a href="{{url('admin/idea/create')}}"><button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus">添加意见反馈</span> 
                                                </button></a>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- 搜索 -->
                                <form action="{{url('/admin/idea/')}}" method="get">
                                {{csrf_field()}}
                            
                                <div class="am-u-sm-12 am-u-md-12 am-u-lg-3">
                                    <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
                                        <input type="text" class="am-form-field " name="key" placeholder="请输入反馈时间" value="">
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
                                                <th>反馈ID</th>
                                                <th>反馈标题</th>
                                                <th>内容</th>
                                                <th>反馈时间</th>
                                            </tr>
                                        </thead>
                                         @foreach($idea as $k=>$v)
                                        <tbody>                                        
											<tr>
                                                <td>{{$v->did}}</td>
												<td>{{$v->title}}</td>
												<td>{{$v->content}}</td>
												<td>{{$v->create_time}}</td>
												<td>
                                                    <div class="tpl-table-black-operation">
                                                        <a href="javascript:;" onclick="ideahuifu({{$v->did}})">
                                                            <i class="am-icon-pencil"></i> 回复
                                                        </a>
                                                        
                                                        <a href="javascript:;" onclick="ideaDel({{$v->did}})" class="tpl-table-black-operation-del">
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
                                
                                <div class="am-u-lg-12 am-cf">

                                    <div class="am-fr">
                                         {!! $idea->appends($request->all())->render() !!}
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

            function ideaDel(id) {

            layer.confirm('您确认要删除吗?',{
                btn:['确认','取消']
            },function () {
                $.post("{{url('admin/idea')}}/"+id,{"_method":"delete","_token":"{{csrf_token()}}"},function(idea){

                    //删除成功
                    if(idea.error == 0){
                        layer.msg(idea.msg, {icon: 6});
                        var t=setTimeout("location.href = location.href;",2000);
                    }else if(idea.error == 1){
                        layer.msg(idea.msg, {icon: 5});

                        var t=setTimeout("location.href = location.href;",2000);
                    }else{
                        layer.msg(idea.msg, {icon: 2});
                        var t=setTimeout("location.href = location.href;",2000);
                    }
                });
            });
        }

        function ideahuifu(id) {
         var id = id;
         console.log(id);
         var name = $('#hidden').attr('name');
         console.log(name);
           layer.open({
              type: 1,
              skin: 'layui-layer-demo', //样式类名
              closeBtn: 1, //显示关闭按钮
              anim: 2,
              shadeClose: true, //开启遮罩关闭
                                      // <form action="{{url('/admin/idea/')}}" method="get">
              content: '<div id="ids"><form action="{{url('/admin/idea/abc')}}" method="post">{{csrf_field()}}<input type="hidden" id="hidden" name= "did" value="id"><textarea name="huifu" required lay-verify="required" placeholder="请输入" class="layui-textarea"></textarea><hr><button class="layui-btn layui-btn-normal">提交</button></form></div>'
            });
          
        }
 </script>

 <style>
    #ids{
        width:200px;
        height: 200px;
        border:1px solid #ccc;
        padding: 10px;
        margin: 10px;
    }
 </style>
@stop
