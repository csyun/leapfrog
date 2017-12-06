@extends('Admin.head')

<!--
 * 前台用户列表页
 * @author [苏波] <386249656@qq.com>
 * @data 2017-11-28 21:10
 * 
  -->

@section('content')

        <div class="tpl-content-wrapper">
            <div class="row-content am-cf">
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title  am-cf">前台用户列表</div>


                            </div>

                            <div class="widget-body  am-fr">

                                <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                                    <div class="am-form-group">
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <form action="{{url('/admin/husers/index')}}" method="get">
                                {{csrf_field()}}
                                <div class="am-u-sm-12 am-u-md-6 am-u-lg-3">
                                    <div class="am-form-group tpl-table-list-select">
                                        <select name="auth" data-am-selected="{btnSize: 'sm'}">

              <option
            @if(!$request->auth)
            selected
            @endif
               value="0">所有用户</option>
              <option 
            @if($request->auth == 1)
            selected
            @endif
              value="1">普通用户</option>
              <option
            @if($request->auth == 2)
            selected
            @endif
               value="2">塘主</option>

            </select>
                                    </div>
                                </div>
                                <div class="am-u-sm-12 am-u-md-12 am-u-lg-3">
                                    <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
                                        <input type="text" class="am-form-field " name="key" placeholder="用户名关键字" value="{{$request->key}}">
                                        <span class="am-input-group-btn">
            <button class="am-btn  am-btn-default am-btn-success tpl-table-list-field am-icon-search" type="submit"></button>
          </span>
                                    </div>
                                </div>
                                </form>



                                <div class="am-u-sm-12">
                                    <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
                                        <thead>
                                            <tr>
                                                <th>用户名</th>
                                                <th>昵称</th>
                                                <th>权限</th>
                                                <th>状态</th>
                                                <th>手机</th>
                                                <th>邮箱</th>
                                                <th>头像</th>
                                                <th>最后登陆时间</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                          @foreach($data as $k=>$v)
											<tr>
                                                <td>{{$v->uname}}</td>
												<td>{{$v->userinfo->nickname}}</td>
												<td>
                                                @if($v->auth == 1)
                                                    普通用户
                                                    @else
                                                    塘主
                                                @endif

                                                </td>
												<td>
                                                @if($v->status == 0)
                                                    离线
                                                    @else
                                                    在线
                                                @endif 

                                                </td>
                                                <td>{{$v->userinfo->telphone}}</td>
                                                <td>{{$v->userinfo->email}}</td>
                                                <td><img src="{{$v->userinfo->avatar}}"></td>

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
                                         {!! $data->appends($request->all())->render() !!}
                                    </div>
                                
                                </div>
                            


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@stop