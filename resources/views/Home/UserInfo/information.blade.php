@extends('Home.UserInfo.common')
@section('content')
    <div class="info-main">
        <div class="user-infoPic">

            <div class="filePic">
                <input type="file" class="inputPic" allowexts="gif,jpeg,jpg,png,bmp" accept="image/*">
                @if($userinfo->avatar!=null)
                    <img class="am-circle am-img-thumbnail" src="http://leapfrog.oss-cn-beijing.aliyuncs.com/{{$userinfo->avatar}}" alt="" />
                @else
                    <img class="am-circle am-img-thumbnail" src="{{asset('/Home/images/getAvatar.do.jpg')}}" alt="" />
                    @endif
            </div>

            <p class="am-form-help">头像</p>
            <div class="info-m">
                <div><b>用户名：<i>{{$username}}</i></b></div>

            </div>
        </div>
        <form id="art_form" class="am-form am-form-horizontal" action="{{url('/userinfo/addinformation')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="am-form-group">
                <label for="user-name2" class="am-form-label">昵称</label>
                <div class="am-form-content">
                    <input type="text" id="user-name2" placeholder="nickname" name="nickname" value="{{$userinfo->nickname}}">
                    <small>昵称长度不能超过40个汉字</small>
                </div>
            </div>

            <div class="am-form-group">
                <label class="am-form-label">性别</label>
                <div class="am-form-content sex">
                    <label class="am-radio-inline">
                        <input type="radio" name="sex" value="1" data-am-ucheck> 男
                    </label>
                    <label class="am-radio-inline">
                        <input type="radio" name="sex" value="2" data-am-ucheck> 女
                    </label>
                    <label class="am-radio-inline">
                        <input type="radio" name="sex" value="3" data-am-ucheck> 保密
                    </label>
                </div>
            </div>
            <div class="am-form-group">
                <label for="user-phone" class="am-form-label">年龄</label>
                <div class="am-form-content">
                    <input id="user-phone" placeholder="age" type="text" value="{{$userinfo->age}}" name="age">

                </div>
            </div>

            <div class="am-form-group">
                <label for="user-phone" class="am-form-label">电话</label>
                <div class="am-form-content">
                    <input id="user-phone" placeholder="telephonenumber" type="text" value="{{$userinfo->telphone}}" name="telphone">
                </div>
            </div>
            <div class="">
                <label for="user-name2" class="am-form-label">上传头像</label>
                <div class="am-form-content">
                    <td>
                        <input type="text" name="avatar" id="art_thumb"  value="" >
                        <input type="file" name="file_upload" id="file_upload" value="">
                        <a> <img src="" alt="" id="img1" style="width:80px" hidden></a>
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
                                    type: "post",
                                    url: "{{asset('/upload')}}",
                                    data: formData,
                                    async: true,
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    success: function(data) {
                                        $('#img1').attr('src','http://leapfrog.oss-cn-beijing.aliyuncs.com/'+data);
                                        $('#img1').show();
                                        $('#art_thumb').val(data);
                                    },
                                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                                        alert("上传失败，请检查网络后重试");
                                    }
                                });
                            }
                        </script>
                    </td>
                </div>
            </div>
            <br>

            <div class="am-form-group">
                <label for="user-email" class="am-form-label">电子邮件</label>
                <div class="am-form-content">
                    <input id="user-email" placeholder="Email" type="text" name="email" value="{{$userinfo->email}}">

                </div>
            </div>

            <div class="info-btn">
                <div class=""><button type="submit">保存修改</button></div>
            </div>

        </form>
    </div>
@endsection