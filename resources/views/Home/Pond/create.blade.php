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
                <img class="am-circle am-img-thumbnail" src="{{asset('/Home/images/getAvatar.do.jpg')}}" alt="" />
              </div>

              <p class="am-form-help">头像</p>

              <div class="info-m">
                <div><b>用户名：<i>小叮当</i></b></div>
                <div class="u-level">
                  <span class="rank r2">
                           <s class="vip1"></s><a class="classes" href="#">铜牌会员</a>
                        </span>
                </div>
                <div class="u-safety">
                  <a href="safety.html">
                   账户安全
                  <span class="u-profile"><i class="bc_ee0000" style="width: 60px;" width="0">60分</i></span>
                  </a>
                </div>
              </div>
            </div>

            <!--个人信息 -->
            <div class="info-main">
              <form class="am-form am-form-horizontal">

                <div class="am-form-group">
                  <label for="user-name2" class="am-form-label">蛙塘名称</label>
                  <div class="am-form-content">
                    <input type="text" id="user-name2" placeholder="">

                  </div>
                </div>

                <div class="am-form-group">
                  <label for="user-name2" class="am-form-label">蛙塘名称</label>
                  <div class="am-form-content">
                    <input type="text" id="user-name2" placeholder="">

                  </div>
                </div>                

                <div class="am-form-group">
                  <label for="user-name2" class="am-form-label">蛙塘名称</label>
                  <div class="am-form-content">
                    <input type="text" id="user-name2" placeholder="">

                  </div>
                </div> 



                     <vue-city-picker ref="picker" @select="select"></vue-city-picker> 
                    


                
                     
                    

  
            

                <div >
                      <label for="user-intro" class="am-form-label">蛙塘描述</label>
                      <div class="am-form-content">
                        <textarea class="" rows="3" id="user-intro" placeholder=""></textarea>
                        <small></small>
                      </div>
                </div>

             
               
            
               
          
                <div class="info-btn">
                  <div class="am-btn am-btn-danger">保存修改</div>
                </div>

              </form>
            </div>

          </div>
          
@stop