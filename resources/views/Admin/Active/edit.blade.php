@extends('Admin.head')
@section('content')


    <!-- 内容区域 -->
        <div class="tpl-content-wrapper">

            <div class="row-content am-cf">
                <div class="row">

                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">修改活动商品</div>
                                <div class="widget-function am-fr">
                                    <a href="javascript:;" class="am-icon-cog"></a>
                                </div>
                            </div>
                            <div class="widget-body am-fr">

<form id="art_form" class="am-form tpl-form-line-form" action="{{url('admin/active')}}" method="post">
                                    {{csrf_field()}}
                                    <div class="am-form-group">
                                        <label for="user-phone" class="am-u-sm-3 am-form-label"> <span class="tpl-form-line-small-title"></span>选择活动类型</label>
                                        <div class="am-u-sm-9">
                                          <select data-am-selected="{searchBox: 1}" style="display: none;" name="acttype">
                                              <option value ="限时秒杀活动" selected>限时秒杀活动</option>
                                              <option value ="价格满减活动">价格满减活动</option>
                                            </select

                                        </div>
                                    </div>


                                    <div class="am-form-group">
                                        <label for="user-weibo" class="am-u-sm-3 am-form-label">添加商品图片 <span class="tpl-form-line-small-title"></span></label>
                                        <div class="am-u-sm-9">
                                <input type="text" size="40" id="art_thumb" name="apic" value="{{old('apic')}}" style="width: 400px;" >
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
                                    </div>
                                    <div class="am-form-group">
                                        <label for="user-weibo" class="am-u-sm-3 am-form-label">添加商品名称 <span class="tpl-form-line-small-title"></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" id="user-weibo" placeholder="请添加商品名称" name="name" value="{{old('name')}}">
                                            <div>

                                            </div>
                                        </div>
                                    </div>
                                                                        <div class="am-form-group">
                                        <label for="user-weibo" class="am-u-sm-3 am-form-label">添加商品价格 <span class="tpl-form-line-small-title"></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" id="user-weibo" placeholder="请添加商品价格" name="price" value="{{old('price')}}">
                                            <div>

                                            </div>
                                        </div>
                                    </div>
                                                                        <div class="am-form-group">
                                        <label for="user-weibo" class="am-u-sm-3 am-form-label">序号 <span class="tpl-form-line-small-title"></span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" id="user-weibo" placeholder="请添加排序" name="order" value="{{old('order')}}">
                                            <div>

                                            </div>
                                        </div>
                                    </div>
                                                                        

                                            </div>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <div class="am-u-sm-9 am-u-sm-push-3">
                                            <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success ">提交</button>
                                        </div>
                                    </div>
                                </form>      </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@stop