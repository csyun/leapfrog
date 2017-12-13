@extends('Layouts.home')
@section('title')
    <title>跳蛙--回收估价</title>
@endsection
@section('body')
    <link href="{{asset('/Home/huishou/common_new.css')}}" rel="Stylesheet" type="text/css">
    <link href="{{asset('/Home/huishou/index.css')}}" rel="stylesheet">
    <link href="{{asset('/Home/css/personal.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/Home/css/addstyle.css')}}" rel="stylesheet" type="text/css">
    <script src="http://code.jquery.com/jquery-1.8.1.min.js"></script>

    <script src="{{asset('/Home/huishou/index_1211.js')}}"></script>

    <div class="center">




                    <!--标题 -->


                    <div class="am-modal am-modal-no-btn" id="doc-modal-1">

                        <div class="add-dress" style="width: 700px;">

                            <!--标题 -->
                            <div class="am-cf am-padding" style="margin-left: 40px;">
                                <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">添加商品</strong> / <small>add goods</small></div>
                            </div>
                            <hr/>

                            <div class="am-u-md-12 am-u-lg-8" style="margin-top: 20px;">
                                <form class="am-form am-form-horizontal" method="post" action="{{url('home/goods/doadd')}}">
                                    {{csrf_field()}}
                                    <div class="am-form-group">
                                        <label for="user-phone" class="am-u-sm-3 am-form-label">商品分类 </label>

                                            <select data-am-selected="{searchBox: 1}" style="display: none;" name="cid">
                                                @foreach($cates as $k=>$v)
                                                    <option
                                                            @if(in_array($v->cid,$pid))
                                                            disabled
                                                            @endif
                                                            value="{{$v->cid}}"><?php echo str_repeat("&nbsp;",4*$v->lev);?> {{$v->cname}}</option>
                                                @endforeach
                                            </select>


                                    </div>
                                    <div class="am-form-group">
                                        <label for="user-phone" class="am-u-sm-3 am-form-label">商品状态</label>
                                            <select data-am-selected="{searchBox: 1}" style="display: none;" name="status">
                                                <option value="0">上架</option>
                                                <option value="1">下架</option>
                                            </select>
                                    </div>
                                    <div class="am-form-group">
                                        <label for="user-name" class="am-form-label">商品名称</label>
                                        <div class="am-form-content">
                                            <input type="text" id="user-name" placeholder="商品名称" name="gname">
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <label for="user-phone" class="am-form-label">商品价格</label>
                                        <div class="am-form-content">
                                            <input id="user-phone" placeholder="商品价格" type="text" name="gprice">
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label for="user-weibo" class="am-u-sm-3 am-form-label">商品封面 </label>
                                        <div class="am-u-sm-9">
                                            <div class="am-form-group am-form-file">
                                                <div class="tpl-form-file-img">
                                                    <img src="" alt="" id="img1" style="width:80px;height:80px">
                                                    <input id="gp_url"type="text" name="gpurl" class="tpl-form-input" id="user-name" >
                                                    <small>图片路径。</small>
                                                </div>
                                                <button type="button" class="am-btn am-btn-danger am-btn-sm">
                                                    <i class="am-icon-cloud-upload"></i> 添加商品封面</button>
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

                                    <div class="am-form-group">
                                        <label for="user-intro" class="am-form-label">商品描述</label>
                                        <div class="am-form-content">
                                        <textarea name="gdesc" style="height: 100px;"></textarea>
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <div class="am-u-sm-9 am-u-sm-push-3">
                                            <button type="submit" class="am-btn am-btn-danger">添加</button>
                                            <a href="javascript: void(0)" class="am-close am-btn am-btn-danger" data-am-modal-close>取消</a>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>





                <script type="text/javascript">
                    $(document).ready(function() {
                        $(".new-option-r").click(function() {
                            $(this).parent('.user-addresslist').addClass("defaultAddr").siblings().removeClass("defaultAddr");
                        });

                        var $ww = $(window).width();
                        if($ww>640) {
                            $("#doc-modal-1").removeClass("am-modal am-modal-no-btn")
                        }

                    })
                </script>

                <div class="clear"></div>

            </div>
            <!--底部-->




    </div>



@endsection