@extends('Admin.head')

@section('content')

    <div class="tpl-content-wrapper">



        <div class="row-content am-cf">


            <div class="row">

                <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                    <div class="widget am-cf">
                        <div class="widget-head am-cf">
                            <div class="widget-title am-fl">添加商品细节</div>
                            <div class="widget-function am-fr">
                                <a href="javascript:;" class="am-icon-cog"></a>
                            </div>
                        </div>
                        <div class="widget-body am-fr">

                            <form class="am-form tpl-form-line-form" id="art_form" action="{{url('admin/goods')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="am-form-group">
                                    <label for="user-weibo" class="am-u-sm-3 am-form-label">商品细节图 <span class="tpl-form-line-small-title">Images</span></label>
                                    <div class="am-u-sm-9">
                                        <div class="am-form-group am-form-file">
                                            <div class="tpl-form-file-img">
                                                <img src="" alt="" id="img1" style="width:80px;height:80px">
                                                <input id="gp_url"type="text" name="gpurl" class="tpl-form-input" id="user-name" >
                                                <small>图片路径。</small>
                                            </div>
                                            <button type="button" class="am-btn am-btn-danger am-btn-sm">
                                                <i class="am-icon-cloud-upload"></i> 添加商品细节图片</button>
                                            <input id="file_upload"  name="gpname"type="file" multiple="true">
                                            <script type="text/javascript">
                                                $(function(){
                                                    $("#file_upload").change(function () {
                                                        $('img1').show();
                                                        uploadImage();
                                                    });
                                                })
                                                function uploadImage() {
                                                    var imgPath = $("#file_upload").val();
                                                    if(imgPath==''){
                                                        layer.msg('请上传图片~!');
                                                        return;
                                                    }
                                                    var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
                                                    if (strExtension != 'jpg' && strExtension != 'gif'
                                                        && strExtension != 'png' && strExtension != 'bmp') {
                                                        layer.msg("请选择图片文件");
                                                        return;
                                                    }
//                                                    var formData = new FormData($('#art_form')[0]);
                                                    var formData = new FormData();
                                                    formData.append('file_upload', $('#file_upload')[0].files[0]);
                                                    formData.append('_token',"{{csrf_token()}}");
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "/admin/upload",
                                                        data: formData,
                                                        async: true,
                                                        cache: false,
                                                        contentType: false,
                                                        processData: false,
                                                        success: function(data) {
                                                            $('#gp_url').val('/uploads/'+data);
                                            $('#img1').attr('src','/uploads/'+data);
//                                            $('#img1').attr('src','http://p09v2gc7p.bkt.clouddn.com/uploads/'+data);
//                                                            $('#img1').attr('src','http://project193.oss-cn-beijing.aliyuncs.com/'+data);
                                                            $('#img1').show();
                                                        },
                                                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                                                            alert("上传失败，请检查网络后重试");
                                                        }
                                                    });
                                                }

                                            </script>
                                        </div>

                                    </div>
                                </div>
                                        <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success ">提交</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
@stop