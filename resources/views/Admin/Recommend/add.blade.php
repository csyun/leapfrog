@extends('Admin.head')
@section('content')

    <div class="row" style="margin-left:100px;">

        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">

                <div class="widget-body am-fr">

                    <form action="{{url('/admin/recommend')}}" id="art_form" class="am-form tpl-form-border-form tpl-form-border-br" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}

                        <div class="am-form-group">
                            @if (count($errors) > 0)
                                <div style="margin-left: 300px;">
                                    <ul>
                                        @if(is_object($errors))
                                            @foreach ($errors->all() as $error)
                                                <li style="color:red">{{ $error }}</li>
                                            @endforeach
                                        @else
                                            <li style="color:red">{{ $errors }}</li>
                                        @endif
                                    </ul>
                                </div>
                        </div>
                            @endif
                            <label for="user-name" class="am-u-sm-3 am-form-label">推荐位名称 <span class="tpl-form-line-small-title">Name</span></label>
                            <div class="am-u-sm-9">
                                <input style="width: 400px;" type="text" class="tpl-form-input" id="user-name" placeholder="请输入名称" name="rname" value="{{old('rname')}}">
                                <small>请填写名称文字10-20字左右。</small>
                            </div>
                        <label for="user-name" class="am-u-sm-3 am-form-label">推荐位状态 <span class="tpl-form-line-small-title">Name</span></label>
                        <div class="am-u-sm-9">
                            <input style="width: 50px;" type="radio" class="tpl-form-input" id="user-name"  name="status" value="1" @if(old('status')==1)  checked  @endif>开启
                            <input style="width: 50px;" type="radio" class="tpl-form-input" id="user-name"  name="status" value="0" @if(old('status')==0)  checked  @endif>关闭
                        </div>

                        <div class="am-form-group">
                            <div class="am-u-sm-9 am-u-sm-push-3">
                                <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success ">提交</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@stop