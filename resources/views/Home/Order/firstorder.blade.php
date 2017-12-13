@extends('Layouts.home')
@section('title')
    <title>跳蛙--首页</title>
@endsection
@section('body')
<script type="text/javascript" src="{{asset('Home/basic/js/jquery-1.7.min.js')}}"></script>
<div class="take-delivery">
 <div class="status">
   <h2>您已成功付款</h2>
   <div class="successInfo">
     <ul>
       <li>付款金额<em>{{$orders['oprice']}}</em></li>
       <div class="user-info">
         <p>收货人：{{$orders['rec']}}</p>
         <p>联系电话：{{$orders['tel']}}</p>
         <p>收货地址：{{$orders['addr']}}</p>
       </div>
             请认真核对您的收货信息，如有错误请联系客服
                               
     </ul>
     <div class="option">
       <span class="info">您可以</span>
        <a href="{{url('/home/order/myorder')}}">查看<span>已买到的宝贝</span></a>
     </div>
    </div>
  </div>
</div>


@stop
