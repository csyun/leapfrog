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
   <div style="height: 500px;">
       <div style="float: left;">
           <img style="width: 480px;height: 450px;" src="{{asset('/Home/images/2017-12-12_140315.png')}}" />
       </div>
       <div style="border: 1px solid silver;height: 450px;width: 700px;float: left">
           <div>
               <div style="float: left;height: 300px; width: 300px;border-right:1px solid silver; text-align: center; ">
                   <div><img style="height: 200px;width: 200px;margin-top: 20px;" src="http://leapfrog.oss-cn-beijing.aliyuncs.com//{{$recyclegood['rgpic']}}" /></div>
                   <div style="font-size: 18px;margin-top: 20px;">{{$recyclegood['rgname']}}</div>
               </div>
               <div style="float: left;height: 300px; width: 300px;">
                   <div style="margin-top: 80px;margin-left: 20px;font-size: 14px;">评估报价</div>
                   <div style="margin-top: 20px;margin-left: 20px;font-size: 36px;color: #FF3737;">￥{{$count}}<a href="{{url('/recyclegoods/show/'.$recyclegood['rgid'])}}"><span style="margin-left: 20px;font-size:20px;">重新询价></span></a></div>


                   <div style="margin-top: 60px;margin-left: 20px;font-size: 36px;color: #FF3737;">
                       <a href="{{url('/recyclegoods/order/')}}"><button type="submit"  style="margin-left: 20px;font-size:20px;">提交回收></button></a>
                   </div>

               </div>
           </div>
           <div style="clear: both;"></div>
           <div style="width: 700px;height: 100px;border-top: 1px solid silver;">
               <div style="margin-left: 20px;font-size: 18px;margin-top: 20px;">回收机器信息:</div>
               @foreach($attrarr as $k=>$v)
                <div style="margin-left: 20px;margin-top: 20px;width: 100px;height: 40px;line-height: 40px;float: left;font-size: 18px;background-color: #FF3737;text-align: center;color: #ffffff;">{{$v->attr_value}}</div>
               @endforeach
           </div>
       </div>
   </div>



@endsection