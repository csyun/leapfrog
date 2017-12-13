@extends('Home.UserInfo.common')
@section('content')

    <div class="main-wrap" style="margin-left: 20px;">

        <div class="user-address">
            <!--标题 -->

            <div class="clear"></div>
            <a class="new-abtn-type" data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0}">编辑地址</a>
            <!--例子-->
            <div class="am-modal am-modal-no-btn" id="doc-modal-1">

                <div class="add-dress">

                    <!--标题 -->
                    <div class="am-cf am-padding">
                        <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">编辑地址</strong> / <small>Edit&nbsp;address</small></div>
                    </div>
                    <hr/>

                    <div class="am-u-md-12 am-u-lg-8" style="margin-top: 20px;">
                        <form class="am-form am-form-horizontal" method="post" action="{{url('/userinfo/addr/'.$addr->addit)}}">
                            {{csrf_field()}}
                            {{method_field('put')}}
                            <div class="am-form-group">
                                <label for="user-name" class="am-form-label">收货人</label>
                                <div class="am-form-content">
                                    <input type="text" id="user-name" placeholder="收货人" name="addrname" value="{{$addr->addrname}}">
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-phone" class="am-form-label">手机号码</label>
                                <div class="am-form-content">
                                    <input id="user-phone" placeholder="手机号必填" type="text" name="tel" value="{{$addr->tel}}">
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-intro" class="am-form-label">详细地址</label>
                                <div class="am-form-content">
                                    <textarea name="addrcontent" class="" rows="3" id="user-intro" placeholder="输入详细地址">{{$addr->addrcontent}}</textarea>

                                </div>
                            </div>

                            <div class="am-form-group">
                                <div class="am-u-sm-9 am-u-sm-push-3">
                                    <button type="submit" class="am-btn am-btn-danger">保存</button>
                                    <a href="javascript: void(0)" class="am-close am-btn am-btn-danger" data-am-modal-close>取消</a>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

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

            });

            function cateDel(id) {

                layer.confirm('您确认要删除吗?',{
                    btn:['确认','取消']
                },function () {
                    $.post("{{url('/userinfo/addr')}}/"+id,{"_method":"delete","_token":"{{csrf_token()}}"},function(data){

//                    删除成功
                        if(data.error == 0){
                            layer.msg(data.msg, {icon: 6});
                            var t=setTimeout("location.href = location.href;",2000);
                        }else if(data.error == 1){
                            layer.msg(data.msg, {icon: 5});

                            var t=setTimeout("location.href = location.href;",2000);
                        }else{
                            layer.msg(data.msg, {icon: 2});
                            var t=setTimeout("location.href = location.href;",2000);
                        }


                    });

                })
            }
        </script>

        <div class="clear"></div>

    </div>
@endsection