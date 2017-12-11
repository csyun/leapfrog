@extends('Admin.head')
@section('content')

 <div class="row" style="margin-left:100px;">

        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">

                <div class="widget-body am-fr">
                          
                    <form action="{{url('/admin/config/'.$config->conf_id)}}" id="art_form" class="am-form tpl-form-border-form tpl-form-border-br" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{ method_field('put') }}
                        <div class="am-form-group">
                            @if (count($errors) > 0)
                                <div style="margin-left: 300px;">
                                    <ul>
                                        @if(is_object($errors))
                                            @foreach ($errors->all() as $error)
                                                <li style="color:red">{{ $error }}</li>
                                            @endforeach
                                        @else
                                            <li style="color:red">{{ $errors }}</li>
                                        @endif
                                    </ul>
                                </div>
                            @endif
                            <label for="user-name" class="am-u-sm-3 am-form-label">标题 <span class="tpl-form-line-small-title">Title</span></label>
                            <div class="am-u-sm-9">
                                <input style="width: 400px;" type="text" class="tpl-form-input" id="user-name" placeholder="配置项标题必须填写" name="conf_title" value="{{$config->conf_title}}" >
                                <small></small>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-phone" class="am-u-sm-3 am-form-label">名称: <span class="tpl-form-line-small-title">Name</span></label>
                            <div class="am-u-sm-9">
                                <input type="text" name="conf_name" value="{{$config->conf_name}}" placeholder="输入配置项名称" style="width: 400px;">
                            </div>
                        </div>
                    
                        <div class="am-form-group">
                            <label for="user-phone" class="am-u-sm-3 am-form-label">配置内容: <span class="tpl-form-line-small-title">content</span></label>
                            <div class="am-u-sm-9">
                                <input type="text" name="conf_content" value="{{$config->conf_content}}" placeholder="输入配置项内容" style="width: 400px;">
                            </div>
                        </div>



                        <div class="am-form-group">
                            <label class="am-u-sm-3 am-form-label">配置序号 <span class="tpl-form-line-small-title">序号</span></label>
                            <div class="am-u-sm-9">
                                <input type="text" value="{{$config->conf_order}}" name="conf_order" placeholder="输入排序" style="width: 400px;">
                            </div>
                        </div>

                        <!-- <div class="am-form-group">
                            <label for="user-weibo" class="am-u-sm-3 am-form-label">类型: <span class="tpl-form-line-small-title">type</span></label>
                            <div class="am-u-sm-9">
                                <input type="radio" size="10" id="art_thumb" name="field_type" value="{{$config->conf_type}}" style="width: 20px;" checked onclick="showTr(this)">input
                                <input type="radio" size="10" id="art_thumb" name="field_type" value="{{$config->conf_type}}" style="width: 20px;" onclick="showTr(this)">textarea
                                <input type="radio" size="10" id="art_thumb" name="field_type" value="{{$config->conf_type}}" style="width: 20px;" onclick="showTr(this)">radio
                              

                            </div>
                        </div>
                            
                        <div class="am-form-group">
                        <div class="field_value" style="display: none">
                            <label for="user-weibo" class="am-u-sm-3 am-form-label">类型值 <span class="tpl-form-line-small-title">类型值</span></label>
                            <div class="am-u-sm-9">
                                 
                                <input type="text" name="field_value" value="field_value" id="user-weibo" placeholder="类型值只有在radio的情况下才需要配置，格式 1|开启,0|关闭" style="width: 400px;">
                                <p><i class="fa fa-exclamation-circle yellow"></i>类型值只有在radio的情况下才需要配置，格式 1|开启,0|关闭</p>
                               
                                
                            </div>
                        </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-weibo" class="am-u-sm-3 am-form-label">配置说明</label>
                            <div class="am-u-sm-9">
                                <textarea id="" cols="30" rows="10" name="conf_tips"></textarea>
                            </div>
                        </div> -->

                        <div class="am-form-group">
                            <div class="am-u-sm-9 am-u-sm-push-3">
                                <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success ">提交</button>

                                <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success" onclick="history.go(-1)">返回</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">

        //实例化编辑器
        //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
        //var ue = UE.getEditor('editor');
   
        function showTr(obj){
            switch($(obj).val()){
                case 'input':
                    $('.field_value').hide();
                    break;
                case 'textarea':
                    $('.field_value').hide();
                    break;

                case 'radio':
                    $('.field_value').show();
            }

        }
    </script>


@stop









