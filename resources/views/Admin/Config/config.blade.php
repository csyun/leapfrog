@extends('Admin.head')

@section('content')
        <div class="tpl-content-wrapper">

            <div class="container-fluid am-cf">
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                        <small id="info"></small>
                        <div class="page-header-heading"> 配置 <small>信息管理</small></div>
                        <p class="page-header-description">网站配置   及 系统配置</p>
                    </div>
                </div>
            </div>
            <div class="row-content am-cf">
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">网站信息配置管理</div>
                                <div class="widget-function am-fr">
                                    <a href="javascript:;" class="am-icon-cog"></a>
                                </div>
                            </div>
                            <div class="widget-body  widget-body-lg am-fr">

                                <table width="100%" class="am-table am-table-compact tpl-table-black " id="example-r">
                                    <thead>
                                  
                                        <tr>
                                            <th>序号</th>
                                            <th>项目</th>
                                            <th >内容<a href="javascript:;">
                                                        <i class="am-icon-pencil"></i> 双击可修改
                                                    </a>
                                            </th>
                                            <th></th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                               
                                        <tr class="gradeX">
                                            <td>1</td>
                                            <td id="xiangmu">官方电话号码</td>                        
                                            <td class="tel">{{$configs->tel}}</td>
                                            <td class="ids"></td>
                                            <td>
                                                <div class="tpl-table-black-operation">
                                                    <a href="javascript:;">
                                                        <i class="am-icon-pencil"></i> 隐藏
                                                    </a>
                                                    <a href="javascript:;" class="tpl-table-black-operation-del">
                                                        <i class=""></i> 显示
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    
                                        <tr class="gradeX">
                                            <td>2</td>
                                            <td id="xiangmu">官方邮箱</td>                        
                                            <td class="email">{{$configs->email}}</td>
                                            <td class="ids"></td>
                                            <td>
                                                <div class="tpl-table-black-operation">
                                                    <div class="tpl-table-black-operation">
                                                    <a href="javascript:;">
                                                        <i class="am-icon-pencil"></i> 隐藏
                                                    </a>
                                                    <a href="javascript:;" class="tpl-table-black-operation-del">
                                                        <i class=""></i> 显示
                                                    </a>
                                                </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="gradeX">
                                            <td>3</td>
                                            <td id="xiangmu">官方传真</td>                        
                                            <td class="fax">{{$configs->fax}}</td>
                                            <td class="ids"></td>
                                            <td>
                                                <div class="tpl-table-black-operation">
                                                    <div class="tpl-table-black-operation">
                                                    <a href="javascript:;">
                                                        <i class="am-icon-pencil"></i> 隐藏
                                                    </a>
                                                    <a href="javascript:;" class="tpl-table-black-operation-del">
                                                        <i class=""></i> 显示
                                                    </a>
                                                </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="gradeX">
                                            <td>4</td>
                                            <td id="xiangmu">官方备案码</td>                        
                                            <td class="recordnumber">{{$configs->recordnumber}}</td>
                                            <td class="ids"></td>
                                            <td>
                                                <div class="tpl-table-black-operation">
                                                    <div class="tpl-table-black-operation">
                                                    <a href="javascript:;">
                                                        <i class="am-icon-pencil"></i> 隐藏
                                                    </a>
                                                    <a href="javascript:;" class="tpl-table-black-operation-del">
                                                        <i class=""></i> 显示
                                                    </a>
                                                </div>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        <!-- more data -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">系统基本信息</div>
                                <div class="widget-function am-fr">
                                    <a href="javascript:;" class="am-icon-cog"></a>
                                </div>
                            </div>
                            <div class="widget-body  widget-body-lg am-fr">

                                <table width="100%" class="am-table am-table-compact am-table-bordered tpl-table-black " id="example-r">
                                    <thead>
                                        <tr>
                                            <th>序号</th>
                                            <th>项目</th>
                                            <th>内容</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="gradeX">
                                            <td>1</td>
                                            <td>操作系统</td>
                                            <td>WINNT</td>
                                            <td>
                                                <div class="tpl-table-black-operation">
                                                    <a href="javascript:;">
                                                        <i class="am-icon-pencil"></i> 隐藏
                                                    </a>
                                                    <a href="javascript:;" class="tpl-table-black-operation-del">
                                                        <i class=""></i> 显示
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="even gradeC">
                                            <td>2</td>
                                            <td>运行环境</td>
                                            <td>{{$_SERVER['SERVER_SOFTWARE']}}</td>
                                            <td>
                                                <div class="tpl-table-black-operation">
                                                    <a href="javascript:;">
                                                        <i class="am-icon-pencil"></i> 隐藏
                                                    </a>
                                                    <a href="javascript:;" class="tpl-table-black-operation-del">
                                                        <i class=""></i> 显示
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="gradeX">
                                            <td>3</td>
                                            <td>PHP运行环境</td>
                                            <td>apache2handler</td>
                                            <td>
                                                <div class="tpl-table-black-operation">
                                                    <a href="javascript:;">
                                                        <i class="am-icon-pencil"></i> 隐藏
                                                    </a>
                                                    <a href="javascript:;" class="tpl-table-black-operation-del">
                                                        <i class=""></i> 显示
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="even gradeC">
                                            <td>4</td>
                                            <td>上传附件限制</td>
                                            <td><?php echo get_cfg_var("upload_max_filesize")?get_cfg_var("upload_max_filesize"):"不允许上传";?></td>
                                            <td>
                                                <div class="tpl-table-black-operation">
                                                    <a href="javascript:;">
                                                        <i class="am-icon-pencil"></i> 隐藏
                                                    </a>
                                                    <a href="javascript:;" class="tpl-table-black-operation-del">
                                                        <i class=""></i> 显示
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="even gradeC">
                                            <td>5</td>
                                            <td>北京时间</td>
                                            <td>{{date('Y-m-d H:i:s')}}</td>
                                            <td>
                                                <div class="tpl-table-black-operation">
                                                    <a href="javascript:;">
                                                        <i class="am-icon-pencil"></i> 隐藏
                                                    </a>
                                                    <a href="javascript:;" class="tpl-table-black-operation-del">
                                                        <i class=""></i> 显示
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="even gradeC">
                                            <td>6</td>
                                            <td>服务器域名/IP</td>
                                            <td>{{$_SERVER['SERVER_NAME']}} [{{$_SERVER['SERVER_ADDR']}}  ]</td>
                                            <td>
                                                <div class="tpl-table-black-operation">
                                                    <a href="javascript:;">
                                                        <i class="am-icon-pencil"></i> 隐藏
                                                    </a>
                                                    <a href="javascript:;" class="tpl-table-black-operation-del">
                                                        <i class=""></i> 显示
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="even gradeC">
                                            <td>7</td>
                                            <td>Host</td>
                                            <td>{{$_SERVER['SERVER_ADDR']}}</td>
                                            <td>
                                                <div class="tpl-table-black-operation">
                                                    <a href="javascript:;">
                                                        <i class="am-icon-pencil"></i> 隐藏
                                                    </a>
                                                    <a href="javascript:;" class="tpl-table-black-operation-del">
                                                        <i class=""></i> 显示
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- more data -->
                                    </tbody>
                                </table>

                            </div>


             <script>

                $(".tel").on('dblclick', fn1);

                function fn1(){

                    var t = $(this);
                    // var id = t.parent().find('.ids').html();
                    var tel = t.html();
                    var inp = $('<input type="text">');
                    inp.val(tel);
                    t.html(inp);
                    inp.select();

                  inp.on('blur', function () {
                    var newtel= $(this).val();
                    $.ajax({
                        url:"{{ url('/admin/config/ajaxtel') }}",
                        type:'get',
                        data:{ name:newtel},
                        beforeSend:function()
                        {
                            $("#info").html('<span class="text-red"><i class="fa fa-fw fa-spin fa-circle-o-notch"></i>正在修改中...</span>');
                            $("#info").show();
                        },
                        success:function (data) {
                            if(data.code == 0)
                            {
                                t.html(tel);
                                $("#info").html('<span class="text-red">用户名已经存在</span>');
                                $("#info").show();
                                $("#info").fadeOut(1000);
                            }else if(data.code == 1)
                            {

                                t.html(newtel);
                                $("#info").html('<span class="text-red">修改成功</span>');
                                $("#info").show();
                                $("#info").fadeOut(1000);
                            }else {
                                t.html(tel);
                                $("#info").html('<span class="text-red">修改失败</span>');
                                $("#info").show();
                                $("#info").fadeOut(1000);
                            }
                        },
                        error:function () {

                        },
                        dataType:'json'
                    });
    //               添加事件。
                    t.on('dblclick', fn1);
                });


                t.unbind('dblclick');


            }




        </script>

@stop


           



