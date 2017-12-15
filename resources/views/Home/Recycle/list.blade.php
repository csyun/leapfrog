@extends('Layouts.home')
@section('title')
    <title>跳蛙--回收</title>
@endsection
@section('body')
    <div><img src="{{asset('/Home/images/2017-12-06-1.png')}}" /></div>
    <div style="background-color:#ffffff; ">

        <div style="float: left; width: 220px;height: 700px;background-color:#ffffff;border: 1px solid silver ;margin-left: 40px;">
            <div style="font-size: 20px;text-align: center;line-height: 50px;height: 50px;">热门回收</div>
                 <ul>
                     @foreach($goods as $k=>$v)
                    <li style="margin-top: 20px;">
                        <div style="border: 1px solid #f1f4f5;">
                        <div>
                            <img style="height: 150px;width: 180px;margin-left: 20px;" src="http://leapfrog.oss-cn-beijing.aliyuncs.com/{{$v->rgpic}}" /></a>
                        </div>
                        <div style="height: 30px;text-align: center;line-height: 30px;">{{$v->rgname}}</div>
                            <div style="height: 30px;text-align: center;line-height: 30px;">平均回收价:{{$v->avgprice}}</div>
                        <div style="height: 30px;text-align: center;line-height: 30px;">已有{{$v->sale}}人回收</div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div style="background-color: #ffffff;width: 900px;height: 700px;float: left;margin-left: 20px;border: 1px solid #f1f4f5;">
                <div style="height: 650px">
                <ul style="">
                    @foreach($recyclegoods as $k=>$v)
                    <li style="margin-top: 20px;float: left;margin-left: 20px;">
                        <div style="border: 1px solid #f1f4f5;">
                            <div>
                                <a href="{{url('/recyclegoods/show/'.$v->rgid)}}"><img style="height: 200px;width:200px;" src="http://leapfrog.oss-cn-beijing.aliyuncs.com//{{$v->rgpic}}" /></a>
                            </div>
                            <div style="height: 30px;text-align: center;line-height: 30px;">{{$v->rgname}}</div>
                            <div style="height: 30px;text-align: center;line-height: 30px;">已有{{$v->sale}}人回收</div>
                        </div>
                    </li>
                    @endforeach
                </ul>
                </div>
                <div class="am-fr" style="text-align: center;width: 525px;height: 30px;margin-top: -25px;">
                    {!! $recyclegoods->render() !!}
                </div>

            </div>
        <div style="clear: both;"></div>

    </div>



@endsection