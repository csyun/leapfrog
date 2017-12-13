@extends('Admin.head')
@section('content')

    <div class="row" style="margin-left:100px;">

        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">

                <div class="widget-body am-fr">

                    <form action="{{url('/admin/recycleorders/'.$recycleorder->roid)}}" id="art_form" class="am-form tpl-form-border-form tpl-form-border-br" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field('put')}}

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
                            <div class="am-form-group">
                            <label for="user-name" class="am-u-sm-3 am-form-label">商品名称 <span class="tpl-form-line-small-title"></span></label>
                            <div class="am-u-sm-9">
                                <input style="width: 400px;" readonly type="text" class="tpl-form-input" id="user-name" placeholder="请输入名称"  value="{{$goodname}}">

                            </div>
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">回收价格 <span class="tpl-form-line-small-title"></span></label>
                                    <div class="am-u-sm-9">
                                        <input style="width: 400px;" readonly type="text" class="tpl-form-input" id="user-name" placeholder="请输入名称" name="rpice" value="{{$recycleorder->rpice}}">

                                    </div>
                                </div>
                                @foreach($attr_value as $k=>$v)
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">{{$v->attr_type}} <span class="tpl-form-line-small-title"></span></label>
                                    <div class="am-u-sm-9">
                                        <input style="width: 400px;" readonly type="text" class="tpl-form-input" id="user-name" placeholder="请输入名称"  value="{{$v->attr_value}}">

                                    </div>
                                </div>
                                @endforeach
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">联系人 <span class="tpl-form-line-small-title"></span></label>
                                    <div class="am-u-sm-9">
                                        <input style="width: 400px;"  type="text" class="tpl-form-input" id="user-name" placeholder="请输入名称" name="rcname" value="{{$recycleorder->rcname}}">

                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">联系电话 <span class="tpl-form-line-small-title"></span></label>
                                    <div class="am-u-sm-9">
                                        <input style="width: 400px;"  type="text" class="tpl-form-input" id="user-name" placeholder="请输入名称" name="rctel" value="{{$recycleorder->rctel}}">

                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">取货地址 <span class="tpl-form-line-small-title"></span></label>
                                    <div class="am-u-sm-9">
                                        <input style="width: 400px;"  type="text" class="tpl-form-input" id="user-name" placeholder="请输入名称" name="addr" value="{{$recycleorder->addr}}">

                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">订单状态 <span class="tpl-form-line-small-title"></span></label>
                                    <select data-am-selected="{btnSize: 'sm'}" name="status">
                                        <option value="0" @if($recycleorder->status==0) selected @endif>已提交</option>
                                        <option value="1" @if($recycleorder->status==1) selected @endif>已确认</option>
                                        <option value="2" @if($recycleorder->status==2) selected @endif>正在上门回收</option>
                                        <option value="3" @if($recycleorder->status==3) selected @endif>已完成</option>

                                    </select>
                                </div>
                        <div class="am-form-group">
                            <div class="am-u-sm-9 am-u-sm-push-3">
                                <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success ">提交</button>
                            </div>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@stop
<script>
    function addSel(id) {
        var new_div = $('#select-id'+id).clone();
        new_div.find('.addtag').text("-").attr('onclick','delSel(this)');
        new_div.css("margin-left","280px");
        $("#select-id"+id).after(new_div);
    }
    function delSel(obj) {
        $(obj).parent().remove();
    }
    function  getAttr(obj) {
       var type_id = $(obj).parent().find("option:selected").val();
        $.post("{{url('admin/recyclegoods/getTypes')}}",{'_token':"{{csrf_token()}}","type_id":type_id},function(data){
            if(data.status == 0){
                var attr = data.msg;
                var content = '';
                for(var i=0; i<attr.length; i++){
                        content += '<div class="am-form-group">';
                        content += '<label for="user-phone" class="am-u-sm-3 am-form-label">'+attr[i].attr_name+'<span class="tpl-form-line-small-title">Type</span></label>';
                        content += '<div class="am-u-sm-9" id="select-id'+attr[i].attr_id+'">';
                        content += '<select  name="attr_value[]" style="width: 200px;color: #888;" >';
                        var attr_val = attr[i].attr_values;
                            for(var j=0; j<attr_val.length; j++) {
                                content += '<option value="'+attr_val[j]+'"> '+attr_val[j]+'</option>';
                            }
                        content += '</select>';
                        content += '<input type="text" value="" name="attr_price[]" placeholder="输入属性价格" style="margin-left: 232px;width: 200px;margin-top: -33px;">';
                        content += '<input type="hidden" value="'+attr[i].attr_id+'" name="attr_id[]" placeholder="输入属性价格" style="margin-left: 232px;width: 200px;margin-top: -33px;">';
                        content += '<span style="margin-right:267px;width:100px;margin-top: -33px;float: right"  class="addtag" onclick="addSel('+attr[i].attr_id+')">+</span>';
                        content += '</div>';
                        content += '</div>';
                }
               $("#attr-content").html(content);

            }else{
                $("#attr-content").html('');
            }
        })
    }
</script>