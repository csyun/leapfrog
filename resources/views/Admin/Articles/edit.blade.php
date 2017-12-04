@extends('Admin.head')
@section('content')

    <div class="row" style="margin-left:100px;">

        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">

                <div class="widget-body am-fr">

                    <form action="{{url('/admin/articles/'.$data->aid)}}" id="art_form" class="am-form tpl-form-border-form tpl-form-border-br" method="post" enctype="multipart/form-data">
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
                            <label for="user-name" class="am-u-sm-3 am-form-label">标题 <span class="tpl-form-line-small-title">Title</span></label>
                            <div class="am-u-sm-9">
                                <input style="width: 400px;" type="text" class="tpl-form-input" id="user-name" placeholder="请输入标题文字" name="title" value="{{$data->title}}">
                                <small>请填写标题文字10-20字左右。</small>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-phone" class="am-u-sm-3 am-form-label">作者 <span class="tpl-form-line-small-title">Author</span></label>
                            <div class="am-u-sm-9">
                                <input type="text" name="auth" value="{{$data->auth}}" placeholder="输入作者名称" style="width: 400px;">
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label class="am-u-sm-3 am-form-label">文章序号 <span class="tpl-form-line-small-title">序号</span></label>
                            <div class="am-u-sm-9">
                                <input type="text" value="{{$data->number}}" name="number" placeholder="输入列表排序" style="width: 400px;">
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-weibo" class="am-u-sm-3 am-form-label">封面图 <span class="tpl-form-line-small-title">Images</span></label>
                            <div class="am-u-sm-9">
                                <input type="text" size="40" id="art_thumb" name="art_thumb" value="{{$data->art_thumb}}" style="width: 400px;" >
                                <input id="file_upload" name="file_upload" type="file" multiple="true" style="margin-top: 20px;">
                                <br>
                                <img src="http://p0a39ed4q.bkt.clouddn.com/{{$data->art_thumb}}" id="img1" alt="" style="width:80px;height:80px">
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
                                        var formData = new FormData();
                                        formData.append("file_upload", $('#file_upload')[0].files[0]);
                                        formData.append("_token", '{{csrf_token()}}');

                                        $.ajax({
                                            type: "POST",
                                            url: "/admin/upload",
                                            data: formData,
                                            async: true,
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            success: function(data) {
                                          //$('#img1').attr('src','/uploads/'+data);
                                            $('#img1').attr('src','http://p0a39ed4q.bkt.clouddn.com/uploads/'+data);

                                                $('#art_thumb').val('/uploads/'+data);
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
                            <label for="user-weibo" class="am-u-sm-3 am-form-label">添加标签 <span class="tpl-form-line-small-title">Tag</span></label>
                            <div class="am-u-sm-9">
                                <input type="text" name="tags" value="{{$data->tags}}" id="user-weibo" placeholder="请添加分类用点号隔开" style="width: 400px;">
                                <div>

                                </div>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-intro" class="am-u-sm-3 am-form-label">文章内容</label>
                            <div class="am-u-sm-9">
                                <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
                                <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
                                <script id="editor" type="text/plain" name="content"  style="width:700px;height:300px;">
                                    {!! $data->content !!}
                                </script>
                            </div>
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
    <script type="text/javascript">

        //实例化编辑器
        //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
        var ue = UE.getEditor('editor');
        function isFocus(e){
            alert(UE.getEditor('editor').isFocus());
            UE.dom.domUtils.preventDefault(e)
        }

    </script>

@stop