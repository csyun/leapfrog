<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @yield('title')
    <meta name="description" content="这是一个 index 页面">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="icon" type="image/png" href="{{asset('/Adminui/assets/i/favicon.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('/Adminui/assets/i/app-icon72x72@2x.png')}}">
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <script src="{{asset('/Adminui/assets/js/echarts.min.js')}}"></script>
    <script src="{{asset('/Adminui/assets/js/jquery.min.js')}}"></script>

    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('/Adminui/assets/css/amazeui.min.css')}}" />
    <link rel="stylesheet" href="{{asset('/Adminui/assets/css/amazeui.datatables.min.css')}}" />
    <link rel="stylesheet" href="{{asset('/Adminui/assets/css/app.css')}}">


</head>
<body>
	@section('body')
	@show


    <script src="{{asset('/Adminui/assets/js/amazeui.min.js')}}"></script>
    <script src="{{asset('/Adminui/assets/js/amazeui.datatables.min.js')}}"></script>
    <script src="{{asset('/Adminui/assets/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('/Adminui/assets/js/app.js')}}"></script>
    <script src="{{asset('/layer/layer.js')}}"></script>



</body>

</html>