@extends('Admin.head')
@section('content')

    <div class="row" style="margin-left:100px;">

        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">

                <div class="widget-body am-fr">

                    <form action="{{url('/admin/recyclegoodattribute/'.$recyclegoodattribute->attr_id)}}" id="art_form" class="am-form tpl-form-border-form tpl-form-border-br" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field('put')}}
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
                            @endif
                                <<div class="am-form-group">
                                    <label for="user-phone" class="am-u-sm-3 am-form-label">商品类型 <span class="tpl-form-line-small-title">Type</span></label>
                                    <div class="am-u-sm-9">
                                        <select data-am-selected="{searchBox: 1}" style="display: none;" name="type_id">
                                            @foreach($recyclegoodtype as $k=>$v)
                                                @if($recyclegoodattribute->attr_type==$v->type_id)
                                                    <option selected value="{{$v->type_id}}"> {{$v->type_name}}</option>
                                                @else
                                                    <option value="{{$v->type_id}}"> {{$v->type_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">属性名称 <span class="tpl-form-line-small-title">Name</span></label>
                                    <div class="am-u-sm-9">
                                        <input style="width: 400px;" type="text" class="tpl-form-input" id="attr_name" placeholder="请输入名称" name="attr_name" value="{{$recyclegoodattribute->attr_name}}">
                                        <small>请填写文字2-10字左右。</small>
                                    </div>
                                </div>
                                <div class="am-form-group">

                                    <label for="user-name" class="am-u-sm-3 am-form-label">选择类型 <span class="tpl-form-line-small-title"></span></label>
                                    <div class="am-u-sm-9">
                                        <input style="width: 50px;" type="radio" class="tpl-form-input" id="attr_type1"  name="attr_type" value="1" @if($recyclegoodattribute->attr_type==1)  checked  @endif>单选
                                        <input style="width: 50px;" type="radio" class="tpl-form-input" id="attr_type2"  name="attr_type" value="2" @if($recyclegoodattribute->attr_type==2)  checked  @endif>多选
                                    </div>

                                </div>
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">输入类型 <span class="tpl-form-line-small-title"></span></label>
                                    <div class="am-u-sm-9">
                                        <input style="width: 50px;" type="radio" class="tpl-form-input" id="attr_input_type0"  name="attr_type" value="0" @if($recyclegoodattribute->attr_input_type==0)  checked  @endif>input
                                        <input style="width: 50px;" type="radio" class="tpl-form-input" id="attr_input_type1"  name="attr_input_type" value="1" @if($recyclegoodattribute->attr_input_type==1)  checked  @endif>radio
                                        <input style="width: 50px;" type="radio" class="tpl-form-input" id="attr_input_type2"  name="attr_input_type" value="2" @if($recyclegoodattribute->attr_input_type==2)  checked  @endif>select
                                    </div>

                                </div>
                                <div class="am-form-group">
                                    <label for="user-intro" class="am-u-sm-3 am-form-label">参数值</label>
                                    <div class="am-u-sm-9">
                                        <textarea class="" rows="6"  style="width: 300px;"  id="attr_values" name="attr_values"  placeholder="多个值请换行填写">{{$recyclegoodattribute->attr_values}}</textarea>
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


@stop