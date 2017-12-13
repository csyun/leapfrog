@extends('Admin.head')

@section('content')



        <!-- 内容区域 -->
        <div class="tpl-content-wrapper">
            <div class="row-content am-cf">
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title  am-cf">订单详情</div>


                            </div>
                            <div class="widget-body  am-fr">

                                <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                                    <div class="am-form-group">
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <a href="{{url('admin/order/index')}}">  <button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 返回</button></a>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="am-u-sm-12">
                                    <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black ">
                                        <thead>
                                            <tr>

                                                <th>商品缩略图</th>
                                                <th>商品名称</th>
                                                <th>商品价格</th>
                                                <th>商品描述</th>
                                            </tr>
                                        </thead>
                                        @foreach($orders as $k=>$v)
                                        <tbody>

                                            <tr class="gradeX">

                                                <td>
                                                    <img src="{{$v->gpurl}}" class="tpl-table-line-img" alt="">
                                                </td>

                                                <td class="am-text-middle">{{$v->gname}}</td>
                                                <td class="am-text-middle">{{$v->gprice}}</td>
                                                <td class="am-text-middle">{!!$v->gdesc!!}</td>
                                            </tr>

                                            <!-- more data -->
                                        </tbody>
                                            @endforeach
                                    </table>
                                </div>
                                <div class="am-u-lg-12 am-cf">


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @stop