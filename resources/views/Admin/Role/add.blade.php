@extends('Admin.head')
<!--
 * 后台用户添加页
 * @author [苏波] <386249656@qq.com>
 * @data 2017-11-27 20:10
 * 
  -->

@section('content')
<script src="{{asset('/layer/layer.js')}}"></script>
        <!-- 内容区域 -->
        <div class="tpl-content-wrapper">



            <div class="row-content am-cf" >



            
                <div class="row" >

                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                
                                <div class="widget-function am-fr">
                                    <a href="javascript:;" class="am-icon-cog"></a>
                                </div>
                                <div class="row">
                                <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                                    <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 角色添加: <small>users</small></div>
                                    <p class="page-header-description">添加角色</p>
                                    @if (count($errors) > 0)
                                    <div id="lan" class="alert alert-danger" style="display:none">
                                        <ul>
                                            @if(is_object($errors))
                                                @foreach ($errors->all() as $error)
                                                <li class="aa" style="display:none">{{ $error }}</li>
                                                <script type="text/javascript">
                                                var a = $(".aa").html();
                                                    layer.alert(a, {
                                                        icon: 5,
                                                        skin: 'layer-ext-moon' ,
                                                    });
                                                </script>
                                                @endforeach
                                                @else
                                                <li class="aa" style="display:none">{{ $errors}}</li>
                                                <script type="text/javascript">
                                                    var a = $(".aa").html();
                                                    layer.alert(a, {
                                                        icon: 5,
                                                        skin: 'layer-ext-moon' ,
                                                    });
                                                </script>                               
                                            @endif
                                        </ul>
                                    </div>
                                    @endif
                                            
                                </div>

                                </div>
                            </div>
                            <div class="widget-body am-fr">

                                <form action="{{url('/admin/role/')}}" method="post" enctype="multipart/form-data" class="am-form tpl-form-border-form tpl-form-border-br">
                                    {{csrf_field()}}
                                    <div class="am-form-group">

                                        <label for="user-name" class="am-u-sm-3 am-form-label">角色名 : <span  class="tpl-form-line-small-title"></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" name="rname" id="rname"  class="tpl-form-input"  placeholder="请输入角色名">
                                            <small></small>
                                        </div>
                                    </div>
                                    <br>
                                    
                                    <div class="am-form-group">

                                        <label for="user-name" class="am-u-sm-3 am-form-label">描述 : <span  class="tpl-form-line-small-title"></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" name="desc" value="" class="tpl-form-input" id="desc" placeholder="请输入角色描述">
                                            <small></small>
                                        </div>
                                    </div>
                                    <br>                                 

                                

              
                                    <div class="am-form-group">
                                        <div class="am-u-sm-9 am-u-sm-push-3">
                                            <button type="submit" id="btn"  class="am-btn am-btn-primary tpl-btn-bg-color-success ">提交</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                


            </div>
        </div>


    <script type="text/javascript">

    
       
        $("#rname").blur(function() {

            var v= $(this).val();
            $.ajax({
                    type:"post",
                    url:"{{url('/admin/role/ajax')}}",
                    data:{"rname":v,"_token":"{{csrf_token()}}"},
                    success:function(data){
                        if(data){
                             layer.msg("角色名已存在！", {icon: 6});
                        }
                    },

                    dataType: "json",

             });


            if (v == '') {
                layer.msg("角色名不能为空！", {icon: 6});
            }else{
                $(this).prev().css("color","#0EA74A");
                $("#rname").next().html("");
            }
             
        });        
        
       

        $("#desc").blur(function() {
            var v=$(this).val();
            if (v=='') {
                layer.msg("描述不能为空！", {icon: 6});
               
            }else{
                $(this).prev().css("color","#0EA74A");
                $("#desc").next().html("");
            } 
        });

        
        $('#btn').click(function(){
              
            var rname=$("#rname").val();            
            var desc=$("#desc").val();
          
            if (rname=="") {
                layer.msg("角色名不能为空！", {icon: 6});
                return false;
            }
           
            if (desc=='') {
                layer.msg("描述不能为空！", {icon: 6});
                return false;
            }
                    
        });

    </script>

@stop

