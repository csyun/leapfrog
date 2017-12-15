@extends('Admin.head')

@section('content')

    <div class="tpl-content-wrapper">
        <div class="row-content am-cf">
            <div class="row">
                <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                    <div class="widget am-cf">
                        <div class="widget-head am-cf">
                            <div class="widget-title  am-cf">订单列表</div>
                            <ul>
                            @if(session('msg'))
                                <li style="color:#00ff6a">{{session('msg')}}</li>
                                @endif
                                </ul>

                        </div>
                        <div class="widget-body  am-fr">

                            <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                                <div class="am-form-group">
                                    <div class="am-btn-toolbar">

                                    </div>
                                </div>
                            </div>



                            <div class="am-u-sm-12">
                                <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
                                    <thead>
                                    <tr>
                                        <th>订单号</th>
                                        <th>收货人</th>
                                        <th>下单人</th>
                                        <th>联系电话</th>
                                        <th>地址</th>
                                        <th>下单时间</th>
                                        <th>状态</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    @foreach($orders as $k=>$v)
                                    <tbody>
                                    <tr class="gradeX">

                                        <td>{{$v->oid}}</td>
                                        <td>{{$v->rec}}</td>
                                        <td>{{$v->uname}}</td>
                                        <td>{{$v->tel}}</td>
                                        <td>{{$v->addr}}</td>
                                        <td>{{date('Y年m月d日h:i:s',$v->creata_time)}}</td>
                                        <td>@if($v->status==0)
                                                已下单,未发货
                                                @elseif($v->status==1)
                                                已发货,未收货
                                                @else
                                                已收货
                                            @endif
                                        </td>
                                        <td>
                                            <div class="tpl-table-black-operation">
                                                <a href="{{url('/admin/order/edit/'.$v->oid)}}">
                                                    <i class="am-icon-pencil"></i> 修改订单
                                                </a>

                                            </div>

                                        </td>
                                        <td>
                                            <div class="tpl-table-black-operation">
                                                <a href="{{url('/admin/order/details/'.$v->oid)}}">
                                                    <i class="am-icon-pencil"></i> 查看订单
                                                </a>

                                            </div>

                                        </td>
                                    </tr>

                                    <!-- more data -->
                                    </tbody>
                                        @endforeach
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop