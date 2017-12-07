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
                                    <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 角色授权: <small>users</small></div>
                                    <p class="page-header-description">角色授权</p>
                                    @if (count($errors) > 0)
                                    <div id="lan" class="alert alert-danger">
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

                                <form action="{{url('/admin/users/doauth/'.$data->uid)}}" method="get" enctype="multipart/form-data" class="am-form tpl-form-border-form tpl-form-border-br">
                                  
                                    {{csrf_field()}}
                                    
                                    <div class="am-form-group">

                                        <label for="user-name"  class="am-u-sm-3 am-form-label">用户名 : <span  class="tpl-form-line-small-title"></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" name="uname" disabled id="uname" value="{{$data->uname}}"  class="tpl-form-input"  placeholder="请输入角色名">
                                            <small></small>
                                        </div>
                                    </div>
                                    <br>
                                    
                                    
                                    <hr>

                                    <h2>角色</h2>
                                    @foreach($roles as $k=>$v)
                                    <div class="am-form-group">
                                        <label for="user-intro" class="am-u-sm-3 am-form-label">{{$v->rname}}</label>
                                        <div class="am-u-sm-9">
                                            <div class="tpl-switch">
                                        @if(in_array($v->rid,$a))
                                                <input type="checkbox" name="role[]" checked value="{{$v->rid}}" class="ios-switch bigswitch tpl-switch-btn">
                                        @else
                                                <input type="checkbox" name="role[]" value="{{$v->rid}}" class="ios-switch bigswitch tpl-switch-btn">
                                                
                                        @endif
                                                <div class="tpl-switch-btn-view">
                                                    <div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    
                                    @endforeach

                                

              
                                    <div class="am-form-group">
                                        <div class="am-u-sm-9 am-u-sm-push-3">
                                            <button type="submit" id="btn"  class="am-btn am-btn-primary tpl-btn-bg-color-success ">确认更改</button>
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

    
       
       
    </script>

@stop