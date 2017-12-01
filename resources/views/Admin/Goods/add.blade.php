@extends('Admin.head')

@section('content')

    <div class="tpl-content-wrapper">



        <div class="row-content am-cf">


            <div class="row">

                <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                    <div class="widget am-cf">
                        <div class="widget-head am-cf">
                            <div class="widget-title am-fl">添加商品</div>
                            <div class="widget-function am-fr">
                                <a href="javascript:;" class="am-icon-cog"></a>
                            </div>
                        </div>
                        <div class="widget-body am-fr">

                            <form class="am-form tpl-form-line-form">
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">商品名称<span class="tpl-form-line-small-title">name</span></label>
                                    <div class="am-u-sm-9">
                                        <input type="text" name="gname" class="tpl-form-input" id="user-name" placeholder="请输入商品名称">
                                        <small>请输入商品名称。</small>
                                    </div>
                                </div>



                                <div class="am-form-group">
                                    <label for="user-phone" class="am-u-sm-3 am-form-label">分类 <span class="tpl-form-line-small-title">Author</span></label>
                                    <div class="am-u-sm-9">
                                        <select data-am-selected="{searchBox: 1}" style="display: none;">
                                            <option value="0">根分类</option>

                                        </select>

                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">商品价格<span class="tpl-form-line-small-title">price</span></label>
                                    <div class="am-u-sm-9">
                                        <input type="text" name="gprice" class="tpl-form-input" id="user-name" placeholder="请输入商品价格">
                                        <small>请输入商品价格。</small>
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label for="user-weibo" class="am-u-sm-3 am-form-label">商品图片 <span class="tpl-form-line-small-title">Images</span></label>
                                    <div class="am-u-sm-9">
                                        <div class="am-form-group am-form-file">
                                            <div class="tpl-form-file-img">
                                                <img src="assets/img/a5.png" alt="">
                                            </div>
                                            <button type="button" class="am-btn am-btn-danger am-btn-sm">
                                                <i class="am-icon-cloud-upload"></i> 添加商品图片</button>
                                            <input id="doc-form-file" type="file" multiple="">
                                        </div>

                                    </div>
                                </div>




                                <div class="am-form-group">
                                    <label for="user-intro" class="am-u-sm-3 am-form-label">商品描述</label>
                                    <div class="am-u-sm-9">
                                        <textarea class="" rows="10" id="user-intro" placeholder="请输入商品描述内容"></textarea>
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <div class="am-u-sm-9 am-u-sm-push-3">
                                        <button type="button" class="am-btn am-btn-primary tpl-btn-bg-color-success ">提交</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
@stop