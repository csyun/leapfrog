@extends('Layouts.home')
@section('title')
    <title>跳蛙--回收估价</title>
@endsection
@section('body')
    <link href="{{asset('/Home/huishou/common_new.css')}}" rel="Stylesheet" type="text/css">
    <link href="{{asset('/Home/huishou/index.css')}}" rel="stylesheet">

    <script src="http://code.jquery.com/jquery-1.8.1.min.js"></script>

    <script src="{{asset('/Home/huishou/index_1211.js')}}"></script>
    <div><img src="{{asset('/Home/images/2017-12-06-1.png')}}" /></div>
    <div style="background-color:#ffffff; ">

        <div style="float: left; width: 260px;height:720px;background-color:#ffffff;border: 1px solid silver ;margin-left: 10px;">

                <div style="border: 1px solid #f1f4f5;">
                    <div style="text-align: center;">
                        <img style="height: 200px;width: 200px;margin-top: 20px;" src="http://leapfrog.oss-cn-beijing.aliyuncs.com//{{$recyclegood->rgpic}}" />
                    </div>
                    <div style="height: 30px;text-align: center;line-height: 30px;">{{$recyclegood->rgname}}</div>
                    <div style="height: 30px;text-align: center;line-height: 30px;">已有38人回收</div>
                </div>
            <div style="font-size: 20px;text-align: center;line-height: 50px;height: 50px;"><a href="{{url('/recyclegoods')}}">重新选择</a></div>
            <div style="font-size: 15px;border-top: 1px solid silver ;height:450px;">
                <p style="text-align: center;font-size: 20px;margin-top: 10px;">安全小贴士</p>
                <p style="margin-top: 5px;margin-left: 10px;">为保障你的手机隐私不在快递途中、质检、交易过程中泄露，我们粉碎你的隐私，更以严格的政策来管理所有数据的处理方式。
                </p>
                <p style="margin-top: 5px;margin-left: 10px;">1. 删除手机相关账号及密码</p>
                <p style="margin-top: 5px;margin-left: 10px;">2. 恢复出厂重置手机</p>
                <p style="margin-top: 5px;margin-left: 10px;">3. 检查是否还留有信息的同时，并检查和取出手机中的内存卡及SIM卡</p>
                <p style="margin-top: 5px;margin-left: 10px;">4.信息重复覆盖技术，个人隐私不担忧</p>
                <p style="margin-top: 5px;margin-bottom:5px;margin-left: 10px;">通过电脑或者下载，存入一些无关紧要的文件或者视频，将硬盘空间占满，反复覆盖硬盘上的数据可以被多次覆盖，数据恢复一般只能恢复最上层的数据，所以，爱回收用一些无关紧要的内容把用户的个人信息覆盖，这样即便信息被恢复，也不会影响到个人隐私。</p>
             </div>
            </div>
        <div id="group-property" class="clearfix">

            <div class="right">
                <div class="select-property base-property">
                    <h2>基本信息</h2>
                    @foreach($recycleattr as $k=>$v)
                    <dl class="">

                        <dt>
                            {{$v->attr_name}}<i>修改</i><span class="selected-property"></span>

                        </dt>
                        @if($v->goodattrvalue)
                        <dd>
                            <ul data-ppn-name="" class="clearfix">
                                @foreach($v->goodattrvalue as $k3=>$v3)
                                <li class="property-value hasIllus" data-id="{{$v3['goods_attr_id']}}" >
                                    <div class="value-text">{{$v3['attr_value']}}</div>
                                    <div class="tips"></div>
                                </li>
                                @endforeach

                            </ul>
                        </dd>
                        @endif
                    </dl>
                    @endforeach

                </div>
                <form id="attrform" action="{{url('/recyclegoods/count/')}}" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="rgname" value="{{$recyclegood->rgname}}">
                    <input type="hidden" name="rgid" value="{{$recyclegood->rgid}}">
                    <input type="hidden" name="rgprice" value="{{$recyclegood->rgprice}}">
                    <input type="hidden" name="rgpic" value="{{$recyclegood->rgpic}}">
                <div class="footer clearfix">
                    <div style="background-color: #FF5400;height: 40px;line-height:40px;width: 100px;text-align: center;margin-left:600px;">
                    <button type="submit" style="font-size: 20px;color: #ffffff">免费询价</button>
                    </div>
                </div>
                </form>


            </div>
        </div>

        <div style="clear: both;"></div>

    </div>



@endsection