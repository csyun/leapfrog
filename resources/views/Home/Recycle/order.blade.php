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
    <div><img src="{{asset('/Home/images/2017-12-06-1.png')}}" /></div>
    <div class="center">




                    <!--标题 -->


                    <div class="am-modal am-modal-no-btn" id="doc-modal-1">

                        <div class="add-dress" style="width: 700px;">

                            <!--标题 -->
                            <div class="am-cf am-padding" style="margin-left: 40px;">
                                <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">填写地址</strong> / <small>Add&nbsp;address</small></div>
                            </div>
                            <hr/>

                            <div class="am-u-md-12 am-u-lg-8" style="margin-top: 20px;">
                                <form class="am-form am-form-horizontal" method="post" action="{{url('/recyclegoods/recyclecommit/')}}">
                                    {{csrf_field()}}
                                    <div class="am-form-group">
                                        <label for="user-name" class="am-form-label">收货人</label>
                                        <div class="am-form-content">
                                            <input type="text" id="user-name" placeholder="收货人" name="rcname">
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <label for="user-phone" class="am-form-label">手机号码</label>
                                        <div class="am-form-content">
                                            <input id="user-phone" placeholder="手机号必填" type="text" name="rctel">
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <label for="user-intro" class="am-form-label">详细地址</label>
                                        <div class="am-form-content">
                                            <textarea class="" rows="3" id="user-intro" placeholder="输入详细地址" name="addr"></textarea>
                                            <small>100字以内写出你的详细地址...</small>
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <div class="am-u-sm-9 am-u-sm-push-3">
                                            <button type="submit" class="am-btn am-btn-danger">提交</button>
                                            <a href="javascript: void(0)" class="am-close am-btn am-btn-danger" data-am-modal-close>取消</a>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                        <div style="float: left; width:300px;height:300px;border:1px solid silver; margin-left: 300px;margin-top: -30px;">
                            <div style="text-align: center;">
                                <img style="height: 200px;width: 200px;margin-top: 20px;" src="http://leapfrog.oss-cn-beijing.aliyuncs.com//{{$recyclegood['rgpic']}}" />
                            </div>
                            <div style="height: 30px;text-align: center;line-height: 30px;font-size: 20px;">回收商品:{{$recyclegood['rgname']}}</div>
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