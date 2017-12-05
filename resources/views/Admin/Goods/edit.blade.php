@extends('Admin.head')

@section('content')

    <div class="tpl-content-wrapper">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
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


        <div class="row-content am-cf">


            <div class="row">

                <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                    <div class="widget am-cf">
                        <div class="widget-head am-cf">
                            <div class="widget-title am-fl">修改商品</div>
                            <div class="widget-function am-fr">
                                <a href="javascript:;" class="am-icon-cog"></a>
                            </div>
                        </div>
                        <div class="widget-body am-fr">

                            <form class="am-form tpl-form-line-form" id="art_form" action="{{url('admin/goods/'.$good->gid)}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                {{method_field('put')}}
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">商品名称<span class="tpl-form-line-small-title">name</span></label>
                                    <div class="am-u-sm-9">
                                        <input type="text" name="gname" class="tpl-form-input" id="user-name" placeholder="请输入商品名称" value="{{$good->gname}}">
                                        <small>请输入商品名称。</small>
                                    </div>
                                </div>



                                <div class="am-form-group">
                                    <label for="user-phone" class="am-u-sm-3 am-form-label">商品分类 <span class="tpl-form-line-small-title">cate</span></label>
                                    <div class="am-u-sm-9">
                                        <select data-am-selected="{searchBox: 1}" style="display: none;" name="cid">
                                            @foreach($cates as $k=>$v)
                                            <option
                                                    @if(in_array($v->cid,$pid))
                                                    disabled
                                                    @endif
                                                    @if($v->cid==$good->cid)
                                                    selected
                                                    @endif
                                                    value="{{$v->cid}}">{{$v->cnames}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label for="user-phone" class="am-u-sm-3 am-form-label">商品状态 <span class="tpl-form-line-small-title">status</span></label>
                                    <div class="am-u-sm-9">
                                        <select data-am-selected="{searchBox: 1}" style="display: none;" name="status">
                                                <option
                                                        @if($good->status==0)
                                                                selected
                                                        @endif
                                                        value="0">上架</option>
                                                <option
                                                        @if($good->status==1)
                                                        selected
                                                        @endif
                                                        value="1">下架</option>
                                        </select>

                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">商品价格<span class="tpl-form-line-small-title">price</span></label>
                                    <div class="am-u-sm-9">
                                        <input type="text" name="gprice" class="tpl-form-input" id="user-name" placeholder="请输入商品价格"value="{{$good->gprice}}">
                                        <small>请输入商品价格。</small>
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label for="user-weibo" class="am-u-sm-3 am-form-label">商品图片 <span class="tpl-form-line-small-title">Images</span></label>
                                    <div class="am-u-sm-9">
                                        <div class="am-form-group am-form-file">
                                            <div class="tpl-form-file-img">
                                                <img src="{{$good->gpurl}}" alt="" id="img1" style="width:80px;height:80px">
                                                <input id="gp_url"type="text" name="gpurl" class="tpl-form-input" id="user-name" value="{{$good->gpurl}}">
                                                <small>图片路径。</small>
                                            </div>
                                            <button type="button" class="am-btn am-btn-danger am-btn-sm">
                                                <i class="am-icon-cloud-upload"></i> 添加商品图片</button>
                                            <input id="file_upload"  type="file" multiple="true" >
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




                                <div class="am-form-group">
                                    <label for="user-intro" class="am-u-sm-3 am-form-label">商品描述</label>
                                    <div class="am-u-sm-9">
                                        <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
                                        <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
                                        <script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>
                                        <script id="editor" name="gdesc" type="text/plain" style="width:600;px;height:300px;">{!!$good->gdesc!!}</script>
                                        <script>
                                            var ue = UE.getEditor('editor');
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
@stop