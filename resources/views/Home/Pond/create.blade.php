@extends('Home.Pond.head')
@section('content')
<script src="{{asset('/layer/layer.js')}}"></script>
  <div class="user-info">
            <!--标题 -->
            <div class="am-cf am-padding">
              <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">创建鱼塘</strong> / <small>创建个人的</small></div>
            </div>
            <hr/>
             @if (count($errors) > 0)
                <div id="lan" class="alert alert-danger">
                    <ul>
                        @if(is_object($errors))
                        @foreach ($errors->all() as $error)
                          <li class="aa" style="display:none">{{ $error }}</li>
                            <script type="text/javascript">
                            var a = $(".aa").html();
                              layer.alert(a, {
                    icon: 6,
                    skin: 'layer-ext-moon' //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
                });
                            </script>
                        @endforeach
                            @else
                            <li class="aa" style="display:none">{{ $errors}}</li>
                            <script type="text/javascript">
                              var a = $(".aa").html();
                              layer.alert(a, {
                    icon: 6,
                    skin: 'layer-ext-moon' //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
                });
                            </script>                             
                            @endif
                    </ul>
                </div>
                @endif

            <!--头像 -->
            <div class="user-infoPic">

              <div class="filePic">
                <input type="file" class="inputPic" allowexts="gif,jpeg,jpg,png,bmp" accept="image/*">
                <img class="am-circle am-img-thumbnail" src="{{$userinfo->avatar}}" alt="" />
              </div>

              <p class="am-form-help">头像</p>

              <div class="info-m">
                <div><b>用户名：<i>{{$user->uname}}</i></b></div>
                <div><b>昵称：<i>{{$userinfo->nickname}}</i></b></div>
                <div class="u-level">
                  <span class="rank r2">
                           <s class="vip1"></s><a class="classes" href="#">铜牌会员</a>
                        </span>
                </div>
                
              </div>
            </div>

            <!--蛙塘信息 -->
            <div class="info-main">
              <form action="{{asset('/pond')}}" method="post" id="art_form" enctype="multipart/form-data" class="am-form am-form-horizontal" >

                {{csrf_field()}}
                <div class="am-form-group">
                  <label for="user-name2" class="am-form-label">蛙塘名称</label>
                  <div class="am-form-content">
                    <input name="mname" type="text" id="mname"  placeholder="填入蛙塘名称">

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
              
                <div >
                      <label for="user-intro" class="am-form-label">蛙塘描述</label>
                      <div class="am-form-content">
                        <textarea class="" name="desc" rows="3" id="desc" placeholder="蛙塘描述100字内"></textarea>
                        <small></small>
                      </div>
                </div>

              

             
               
            
               
          
                <div class="info-btn">
                  <input type="submit" name="btn" value="创建蛙塘" class="am-btn am-btn-primary am-btn-sm">
                </div>

              </form>
            </div>

          </div>

<script type="text/javascript">

    
        
    $("input").focus(function() {
        $(this).prev().css("color","#008DE8");
    });
    
    
    $("#mname").blur(function() {
        var v=$(this).val();
        if (v=='') {
            layer.msg("蛙塘名称不能为空", {icon: 6});
        }else{
            $(this).prev().css("color","#0EA74A");
            $("#mname").next().html("");
        } 
           
        
    });

    $("#art_thumb").blur(function() {
        var v=$(this).val();
        if (v=='') {
          layer.msg("请选择上传图片！", {icon: 6});
           
        }else{
            $(this).prev().css("color","#0EA74A");
            $("#art_thumb").next().html("");
        } 
    });

    $("#desc").blur(function() {
        var v=$(this).val();
        if (v=='') {
          layer.msg("描述不能为空", {icon: 6});
           
        }else{
            $(this).prev().css("color","#0EA74A");
            $("#art_thumb").next().html("");
        } 
    });    
       


        
       
    $('#btn').click(function(){
    
    var mname=$("#mname").val();
    var art_thumb=$("#art_thumb").val();
    var desc = $('#desc').val();

    
    if (mname=="") {
        layer.msg("蛙塘名不能为空！", {icon: 6});
        return false;
    }
    if (art_thumb=='') {
        layer.msg("请选择上传图片！", {icon: 6});
        return false;
    }
    if(desc == ''){
        layer.msg("描述不能为空！", {icon: 6});
        return false; 
    }
            
    });
  </script>
          
@stop