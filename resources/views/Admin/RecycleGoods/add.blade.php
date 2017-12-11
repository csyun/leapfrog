@extends('Admin.head')
@section('content')

    <div class="row" style="margin-left:100px;">

        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">

                <div class="widget-body am-fr">

                    <form action="{{url('/admin/recyclegoods')}}" id="art_form" class="am-form tpl-form-border-form tpl-form-border-br" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}

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
                            <label for="user-name" class="am-u-sm-3 am-form-label">商品名称 <span class="tpl-form-line-small-title">Name</span></label>
                            <div class="am-u-sm-9">
                                <input style="width: 400px;" type="text" class="tpl-form-input" id="user-name" placeholder="请输入名称" name="rgname" value="{{old('rgname')}}">
                                <small>请填写文字2-10字左右。</small>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label class="am-u-sm-3 am-form-label">商品基价 <span class="tpl-form-line-small-title">Price</span></label>
                            <div class="am-u-sm-9">
                                <input type="text" value="{{old('rgprice')}}" name="rgprice" placeholder="输入商品基础价格" style="width: 400px;">
                            </div>
                        </div>
                                <div class="am-form-group">
                                    <label for="user-phone" class="am-u-sm-3 am-form-label">商品类型 <span class="tpl-form-line-small-title">Type</span></label>
                                    <div class="am-u-sm-9">
                                        <select data-am-selected="{searchBox: 1}" style="display: none;" name="type_id" onchange="getAttr(this)">
                                            @foreach($recyclegoodtype as $k=>$v)
                                                <option value="{{$v->type_id}}"> {{$v->type_name}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
<div id="attr-content">
                                @if ($recycleattr)
                                    @foreach($recycleattr as $k=>$v)
                                        <div class="am-form-group">
                                            <label for="user-phone" class="am-u-sm-3 am-form-label">{{$v->attr_name}} <span class="tpl-form-line-small-title">Type</span></label>
                                            <div class="am-u-sm-9" id="select-id{{$v->type_id}}">
                                                <select  name="attr_value[]" style="width: 200px;color: #888;" >
                                                    @foreach($v->attr_values as $k1=>$v1)
                                                        <option value="{{$v1}}"> {{$v1}}</option>
                                                    @endforeach
                                                </select>
                                                <input type="text" value="" name="attr_price[]" placeholder="输入属性价格" style="margin-left: 232px;width: 200px;margin-top: -33px;">
                                                <input type="hidden" value="{{$v->type_id}}" name="attr_id[]" placeholder="输入属性价格" style="margin-left: 232px;width: 200px;margin-top: -33px;">
                                                <span style="margin-right:267px;width:100px;margin-top: -33px;float: right"  class="addtag" onclick="addSel({{$v->type_id}})">+</span>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
</div>
                        <div class="am-form-group">
                            <label for="user-weibo" class="am-u-sm-3 am-form-label">商品图 <span class="tpl-form-line-small-title">Images</span></label>
                            <div class="am-u-sm-9">
                                <input type="text" size="40" id="art_thumb" name="rgpic" value="{{old('rgpic')}}" style="width: 400px;" >
                                <input id="file_upload" name="file_upload" type="file" multiple="true" style="margin-top: 20px;">
                                <br>
                                <img src="" id="img1" alt="" style="width:80px;height:80px">
                                <script type="text/javascript">
                                    $(function () {
                                        $("#file_upload").change(function () {
                                            $('img1').show();
                                            uploadImage();
                                        });
                                    });
                                    function uploadImage() {
                                        // 判断是否有选择上传文件
                                        var imgPath = $("#file_upload").val();
                                        if (imgPath == "") {
                                            alert("请选择上传图片！");
                                            return;
                                        }
                                        //判断上传文件的后缀名
                                        var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
                                        if (strExtension != 'jpg' && strExtension != 'gif'
                                            && strExtension != 'png' && strExtension != 'bmp') {
                                            alert("请选择图片文件");
                                            return;
                                        }
                                        var formData = new FormData($('#art_form')[0]);
                                        {{--var formData = new FormData();--}}
                                        {{--formData.append('file_upload', $('#file_upload')[0].files[0]);--}}
                                        {{--formData.append('_token',"{{csrf_token()}}");--}}
                                        $.ajax({
                                            type: "POST",
                                            url: "/upload",
                                            data: formData,
                                            async: true,
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            success: function(data) {
                                                //$('#img1').attr('src','/uploads/'+data);
                                                $('#img1').attr('src','http://leapfrog.oss-cn-beijing.aliyuncs.com/'+data);

                                                $('#art_thumb').val(data);
                                            },
                                            error: function(XMLHttpRequest, textStatus, errorThrown) {
                                                alert("上传失败，请检查网络后重试");
                                            }
                                        });
                                    }
                                </script>

                        </div>

                        <div class="am-form-group">
                            <div class="am-u-sm-9 am-u-sm-push-3">
                                <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success ">提交</button>
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