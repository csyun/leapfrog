@extends('Admin.head')
@section('content')

    <div class="row" style="margin-left:100px;">

        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-body am-fr">
                    <form action="{{url('/admin/idea')}}" id="art_form" class="am-form tpl-form-border-form tpl-form-border-br" method="post" enctype="multipart/form-data">
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

                            <label for="user-name" class="am-u-sm-3 am-form-label">反馈标题 <span class="tpl-form-line-small-title">Title</span></label>
                            <div class="am-u-sm-9">
                                <input style="width: 400px;" type="text" class="tpl-form-input" id="user-name" placeholder="请输入反馈意见标题" name="title" value="{{old('title')}}">
                                <small>请填写意见反馈标题</small>
                            </div>
                        <label for="user-name" class="am-u-sm-3 am-form-label">意见反馈内容 <span class="tpl-form-line-small-title">Content</span></label>
                        <div class="am-u-sm-9">
                            <input style="width: 400px;" type="text" class="tpl-form-input" id="user-name" placeholder="请输入反馈内容" name="content" value="{{old('content')}}">
                            <small>请填写意见反馈内容</small>
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