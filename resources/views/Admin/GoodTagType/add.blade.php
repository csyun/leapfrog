@extends('Admin.head')
@section('content')

        <!-- 内容区域 -->
        <div class="tpl-content-wrapper">

            <div class="row-content am-cf">
                <div class="row">

                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">添加分类</div>
                                <div class="widget-function am-fr">
                                    <a href="javascript:;" class="am-icon-cog"></a>
                                </div>
                            </div>
                            <div class="widget-body am-fr">

                                <form class="am-form tpl-form-line-form" action="{{url('admin/goodtagtype')}}" method="post">
                                    {{csrf_field()}}
                                    <div class="am-form-group">
                                        @if (count($errors) > 0)
                                            <div class="alert alert-danger">
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
                                        @endif
                                        <label for="user-phone" class="am-u-sm-3 am-form-label">分类 <span class="tpl-form-line-small-title">Cate</span></label>
                                        <div class="am-u-sm-9">


                                              @foreach($cates as $k=>$v)
                                                    <input type="checkbox"  name="cid[]" value="{{$v->cid}}" >{{$v->cname}}

                                               @endforeach



                                        </div>
                                    </div>


                                    <div class="am-form-group">
                                        <label for="user-weibo" class="am-u-sm-3 am-form-label">添加标签类型 <span class="tpl-form-line-small-title">Type</span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" id="user-weibo" placeholder="请添加标签类型" name="tag_type" value="{{old('tag_type')}}">
                                            <div>

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
                    </div>
                </div>
            </div>
        </div>
@stop