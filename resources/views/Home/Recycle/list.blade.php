@extends('Layouts.home')
@section('title')
    <title>跳蛙--回收</title>
@endsection
@section('body')
    <div><img src="{{asset('/Home/images/2017-12-06-1.png')}}" /></div>
    <div style="background-color:#f8f8f8; ">

        <div style="float: left; width: 220px;height: 500px;background-color:#ffffff;border: 1px solid silver ;margin-left: 40px;">
            <div style="font-size: 20px;text-align: center;line-height: 50px;height: 50px;">热门回收</div>
                 <ul>
                    <li style="margin-top: 20px;">
                        <div style="border: 1px solid #f1f4f5;">
                        <div>
                            <img style="height: 150px;width: 180px;margin-left: 20px;" src="{{asset('/Home/images/4.jpg')}}" /></a>
                        </div>
                        <div style="height: 30px;text-align: center;line-height: 30px;">苹果X</div>
                        <div style="height: 30px;text-align: center;line-height: 30px;">已有38人回收</div>
                        </div>
                    </li>
                    <li>
                        <div>
                            <img style="height: 150px;width: 180px;margin-left: 20px;" src="{{asset('/Home/images/4.jpg')}}" /></a>
                        </div>
                        <div style="height: 30px;text-align: center;line-height: 30px;">苹果X</div>
                        <div style="height: 30px;text-align: center;line-height: 30px;">已有38人回收</div>
                    </li>
                </ul>
            </div>
            <div style="background-color: #ffffff;width: 900px;height: 500px;float: left;margin-left: 20px;border: 1px solid #f1f4f5;">
                <ul style="">
                    @foreach($recyclegoods as $k=>$v)
                    <li style="margin-top: 20px;float: left;margin-left: 10px;">
                        <div style="border: 1px solid #f1f4f5;">
                            <div>
                                <img style="height: 240px;width:220px;" src="http://p0a39ed4q.bkt.clouddn.com/{{$v->rgpic}}" /></a>
                            </div>
                            <div style="height: 30px;text-align: center;line-height: 30px;">{{$v->rgname}}</div>
                            <div style="height: 30px;text-align: center;line-height: 30px;">平均回收价:38元</div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        <div style="clear: both;"></div>

    </div>



@endsection