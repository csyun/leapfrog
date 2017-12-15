@extends('Admin.head')

@section('content')

    <div class="tpl-content-wrapper">


        <div class="row-content am-cf">


            <div class="row">

                <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                    <div class="widget am-cf">
                        <div class="widget-head am-cf">
                            <div class="widget-title am-fl">修改订单</div>
                            <div class="widget-function am-fr">
                                <a href="javascript:;" class="am-icon-cog"></a>
                            </div>
                        </div>
                        <div class="widget-body am-fr">

                            <form class="am-form tpl-form-line-form" id="art_form" action="{{url('admin/order/update/'.$order->oid)}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">收货人名称<span class="tpl-form-line-small-title">name</span></label>
                                    <div class="am-u-sm-9">
                                        <input type="text" name="rec" class="tpl-form-input" id="user-name" placeholder="请输入收货人名称" value="{{$order->rec}}">
                                        <small>请输入收货人名称。</small>
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-phone" class="am-u-sm-3 am-form-label">订单状态 <span class="tpl-form-line-small-title">status</span></label>
                                    <div class="am-u-sm-9">
                                        <select data-am-selected="{searchBox: 1}" style="display: none;" name="status">
                                                <option
                                                        @if($order->status==0)
                                                                selected
                                                        @endif
                                                        value="0">待发货</option>
                                                <option
                                                        @if($order->status==1)
                                                                selected
                                                        @endif
                                                        value="1">已发货</option>
                                            <option
                                                    @if($order->status==2)
                                                    selected
                                                    @endif
                                                    value="2">已收货</option>
                                        </select>

                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">订单价格<span class="tpl-form-line-small-title">price</span></label>
                                    <div class="am-u-sm-9">
                                        <input type="text" name="oprice" class="tpl-form-input" id="user-name" placeholder="请输入订单总价" value="{{$order->oprice}}">
                                        <small>请输入订单总价。</small>
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">手机号<span class="tpl-form-line-small-title">tel</span></label>
                                    <div class="am-u-sm-9">
                                        <input type="text" name="tel" class="tpl-form-input" id="user-name" placeholder="请输入手机号" value="{{$order->tel}}">
                                        <small>请输入手机号。</small>
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">订单地址<span class="tpl-form-line-small-title">addr</span></label>
                                    <div class="am-u-sm-9">
                                        <textarea name="addr">{!!$order->addr!!}</textarea>
                                        <small>请输入订单地址。</small>
                                    </div>
                                </div>
                                </div>
                                <div class="am-form-group">
                                    <div class="am-u-sm-9 am-u-sm-push-3">
                                        <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success ">提交</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
@stop