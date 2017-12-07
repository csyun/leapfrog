@extends('Home.Pond.head')
@section('content')
  <div class="user-info">
            <!--标题 -->
            <div class="am-cf am-padding">
              <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">创建鱼塘</strong> / <small>创建个人的</small></div>
            </div>
            <hr/>

            <!--头像 -->
            <div class="user-infoPic">

              <div class="filePic">
                <input type="file" class="inputPic" allowexts="gif,jpeg,jpg,png,bmp" accept="image/*">
                <img class="am-circle am-img-thumbnail" src="{{$userinfo->userinfo->avatar}}" alt="" />
              </div>

              <p class="am-form-help">头像</p>

              <div class="info-m">
                <div><b>用户名：<i>{{$user->uname}}</i></b></div>
                <div><b>昵称：<i>{{$userinfo->userinfo->nickname}}</i></b></div>
                <div class="u-level">
                  <span class="rank r2">
                           <s class="vip1"></s><a class="classes" href="#">铜牌会员</a>
                        </span>
                </div>
                
              </div>
            </div>

            <!--个人信息 -->
            <div class="info-main">
              <form action="{{asset('/pond')}}" method="post" id="art_form" enctype="multipart/form-data" class="am-form am-form-horizontal" >

                {{csrf_field()}}
                <div class="am-form-group">
                  <label for="user-name2" class="am-form-label">蛙塘名称</label>
                  <div class="am-form-content">
                    <input name="mname" type="text" id="user-name2" placeholder="">

                  </div>
                </div>

         

                <div class="am-form-group">
                  <label for="user-address" class="am-form-label">所在地</label>
                  <div class="am-form-content address">
                    <select name="a" data-am-selected>
                      <option value="北京市">北京市</option>
                      <option value="河北省" selected>河北省</option>
                    </select>
                    <select name="b" data-am-selected>
                      <option value="昌平区">昌平市</option>
                      <option value="石家庄市" selected>石家庄市</option>
                    </select>
                    <select name="c" data-am-selected>
                      <option value="沙河镇">沙河镇</option>
                      <option value="长安区" selected>长安区</option>
                    </select>
                  </div>
                </div>
                    
                <div class="">
                  <label for="user-name2" class="am-form-label">上传图片</label>
                  <div class="am-form-content">
                    <td>
                  <input type="text" name="art_thumb" id="art_thumb"  value="{{old('art_thumb')}}" >
                  
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
                              url: "{{asset('/pond/upload')}}",
                              data: formData,
                              async: true,
                              cache: false,
                              contentType: false,
                              processData: false,
                              success: function(data) {
                                  $('#img1').attr('src','/'+data);
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
              
                <div >
                      <label for="user-intro" class="am-form-label">蛙塘描述</label>
                      <div class="am-form-content">
                        <textarea class="" name="desc" rows="3" id="user-intro" placeholder=""></textarea>
                        <small></small>
                      </div>
                </div>

              

             
               
            
               
          
                <div class="info-btn">
                  <input type="submit" name="btn" value="创建鱼塘" class="am-btn am-btn-primary am-btn-sm">
                </div>

              </form>
            </div>

          </div>
          
@stop