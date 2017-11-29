@extends('Admin.head')

<!--
 * 后台用户列表页
 * @author [苏波] <386249656@qq.com>
 * @data 2017-11-27 20:10
 * 
  -->

@section('content')

        <div class="tpl-content-wrapper">
            <div class="row-content am-cf">
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title  am-cf">文章列表</div>


                            </div>
                            <div class="widget-body  am-fr">

                                <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                                    <div class="am-form-group">
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <a href="{{url('admin/users/add')}}"><button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 
                                                添加后台用户</button></a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="am-u-sm-12 am-u-md-6 am-u-lg-3">
                                    <div class="am-form-group tpl-table-list-select">
                                        <select data-am-selected="{btnSize: 'sm'}">
                                            <option value="option1">所有类别</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="am-u-sm-12 am-u-md-12 am-u-lg-3">
                                    <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
                                        <input type="text" class="am-form-field ">
                                        <span class="am-input-group-btn">
            <button class="am-btn  am-btn-default am-btn-success tpl-table-list-field am-icon-search" type="button"></button>
          </span>
                                    </div>
                                </div>
                                
                                <div class="am-u-sm-12">
                                    <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
                                        <thead>
                                            <tr>
                                                <th>用户名</th>
                                                <th>权限</th>
                                                <th>状态</th>
                                                <th>最后登陆时间</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                          @foreach($data as $k=>$v)
											<tr>
												<td>{{$v->uname}}</td>
												<td>
                                                @if($v->auth == 1)
                                                    普通管理员
                                                    @else
                                                    高级管理员
                                                @endif

                                                </td>
												<td>
                                                @if($v->status == 0)
                                                    离线
                                                    @else
                                                    在线
                                                @endif 

                                                </td>
												<td>{{date('Y-m-d H:i:s',$v->last_login_time)}}</td>
												<td>
                                                    <div class="tpl-table-black-operation">
                                                        <a href="{{url('/admin/users/edit/'.$v->uid)}}">
                                                            <i class="am-icon-pencil"></i> 编辑
                                                        </a>
                                                        <a href="{{url('/admin/users/delete/'.$v->uid)}}" class="tpl-table-black-operation-del">
                                                            <i class="am-icon-trash"></i> 删除
                                                        </a>
                                                    </div>
                                                </td>
											</tr>
                                          @endforeach

                                            <!-- more data -->
                                        </tbody>
                                    </table>
                                </div>
                                <div class="am-u-lg-12 am-cf">

                                    <div class="am-fr">
                                        <ul class="am-pagination tpl-pagination">
                                            <li class="am-disabled"><a href="#">«</a></li>
                                            <li class="am-active"><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li><a href="#">4</a></li>
                                            <li><a href="#">5</a></li>
                                            <li><a href="#">»</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@stop