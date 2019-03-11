<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Cache-Control" content="no-transform">
    <meta http-equiv="Cache-Control" content="no-siteapp">
    <meta name="mobile-agent" content="format=html5; url={{ config('app.mobileurl').$_SERVER['REQUEST_URI'] }}">
    <meta name="mobile-agent" content="format=xhtml; url={{ config('app.mobileurl').$$_SERVER['REQUEST_URI'] }}">
    <meta name="applicable-device" content="pc">
    <link rel="icon" href="/favicon.ico" type="images/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', app_name())</title>
    @if(request()->is('/'))
    <meta name="keywords" content="放心购,购物网,网络购物,折扣网,天天特价,特价网,九块九包邮,全场包邮,今日特价">
    <meta name="description" content="放心购网络购物网能帮您买到更具性价比的产品,有各大商城的服饰、时尚鞋包、美食小吃、居家生活、母婴等产品促销优惠信息和折扣秒杀特价商品!是您网络购物省钱的首选网站!">
    @endif
    {{ style(url('css/wwwfxg.css')) }}
    {{ style(url('css/banner.css')) }}
    @stack('style')
    <script>
        if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
            window.location = window.location.href.replace("www.fangxinmai.com","m.fangxinmai.com");
        }
    </script>
</head>
<body>
<div class="top">

@include('frontend.includes.nav')

</div>
<div class="clear"></div>

@yield('banner')

@yield('content')


<div class="mxwidth foot"> Copyright &copy; {{ date('Y') }} All Rights Reserved</div>
{{ script(url('js/jquery.js')) }}
{{ script(url('js/wwwlib.js')) }}
{{ script(url('js/banner.js')) }}
@stack('script')



</body>
</html>