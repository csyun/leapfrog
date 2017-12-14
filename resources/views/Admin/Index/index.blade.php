@extends('Admin.head')

<!--
 * 后台用户首页
 * @author [苏波] <386249656@qq.com>
 * @data 2017-11-28 21:10
 * 
  -->
  
@section('content')

        <!-- 内容区域 -->
        <div class="tpl-content-wrapper">

            <div class="container-fluid am-cf">
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                        <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 首页 <small></small></div>
                        <p class="page-header-description">跳蛙二手后台首页,专业的二手平台</p>
                    </div>

                </div>

            </div>

            <div class="row-content am-cf">
                <div class="row  am-cf">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-4">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl"></div>
                                <div class="widget-function am-fr">
                                    <a href="javascript:;" class="am-icon-cog"></a>
                                </div>
                            </div>
                            <div class="widget-body am-fr">
                                <div class="am-fl">
                                    <div class="widget-fluctuation-period-text">
                                        现有注册用户
                                       
                                    </div>
                                </div>
                                <div class="am-fr am-cf">
                                    <div class="widget-fluctuation-description-amount text-success" am-cf>
                                        {{count($user1)}}

                                    </div>
                                    <div class="widget-fluctuation-description-text am-text-right">
                                        前台注册人数
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="am-u-sm-12 am-u-md-6 am-u-lg-4">
                        <div class="widget widget-primary am-cf">
                            <div class="widget-statistic-header">
                                后台管理员人数
                            </div>
                            <div class="widget-statistic-body">
                                <div class="widget-statistic-value">
                                    {{count($user)}}
                                </div>
                                <div class="widget-statistic-description">
                                     <strong></strong> 
                                </div>
                                <span class="widget-statistic-icon am-icon-credit-card-alt"></span>
                            </div>
                        </div>
                    </div>
                    <div class="am-u-sm-12 am-u-md-6 am-u-lg-4">
                        <div class="widget widget-purple am-cf">
                            <div class="widget-statistic-header">
                                在售商品数量
                            </div>
                            <div class="widget-statistic-body">
                                <div class="widget-statistic-value">
                                    {{$good}}
                                </div>
                                <div class="widget-statistic-description">
                                     <strong></strong>
                                </div>
                                <span class="widget-statistic-icon am-icon-support"></span>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">跳蛙系统基本信息</div>
                                <div class="widget-function am-fr">
                                    <a href="javascript:;" class="am-icon-cog"></a>
                                </div>
                            </div>
                            <div class="widget-body  widget-body-lg am-fr">

                                <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
                                    <thead>
                                        <tr>
                                            <th>序号</th>
                                            <th>项目</th>
                                            <th>内容</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="gradeX">
                                            <td>1</td>
                                            <td>操作系统</td>
                                            <td>WINNT</td>

                                        </tr>
                                        <tr class="even gradeC">
                                            <td>2</td>
                                            <td>运行环境</td>
                                            <td>Apache/2.4.25(win32)OpenSSl/1.0.2j PHP/7.1.1</td>
                                            
                                        </tr>
                                        <tr class="gradeX">
                                            <td>3</td>
                                            <td>php运行环境</td>
                                            <td>apache2handler</td>
                                            
                                        </tr>
                                        <tr class="even gradeC">
                                            <td>4</td>
                                            <td>上传附件限制</td>
                                            <td>2M</td>
                                            
                                        </tr>
                                        <tr class="even gradeC">
                                            <td>5</td>
                                            <td>版本更新时间</td>
                                            <td>2017-12-14 17:00:00</td>
                                            
                                        </tr>

                                        <tr class="even gradeC">
                                            <td>6</td>
                                            <td>服务器域名</td>
                                            <td>localhost</td>
                                            
                                        </tr>

                                        <tr class="even gradeC">
                                            <td>7</td>
                                            <td>Host</td>
                                            <td>localhost</td>
                                            
                                        </tr>
                                        <!-- more data -->
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                
            </div>
        </div>
@stop
