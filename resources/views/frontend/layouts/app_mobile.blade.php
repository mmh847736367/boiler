<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="x-dns-prefetch-control" content="on">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-agent" content="format=html5; url={{ config('app.url').$_SERVER['REQUEST_URI'] }}">
    <meta name="mobile-agent" content="format=xhtml; url={{ config('app.url').$_SERVER['REQUEST_URI'] }}">
    <meta content="telephone=no" name="format-detection">
    <meta name="full-screen" content="yes">
    <meta name="x5-fullscreen" content="true">
    <meta name="applicable-device" content="mobile">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
    <title>@yield('title', config('app.name'))</title>
    @if(request()->is('/'))
    <meta name="keywords" content="拼购网,购物网,网络购物,折扣网,天天特价,特价网,九块九包邮,全场包邮,今日特价">
    <meta name="description" content="拼购网能帮您买到更具性价比的产品,有各大商城的服饰、时尚鞋包、美食小吃、居家生活、母婴等产品促销优惠信息和折扣秒杀特价商品!是您网络购物省钱的首选网站!">
    @endif
    <link rel="icon" href="/favicon.ico" type="images/x-icon">
    {{ style(url('css/mobilecss.css')) }}
    @stack('script')
</head>
<body>
<div class="top">
    <div class="top-box">
        <div class="main-top"><a href="javascript:history.go(-1)"><i class="main-icon1"></i></a>
            <div class="search">
                <form name="searchform" method="POST" action="/query">
                    <input type="submit" class="icon-sousuo" value="">
                    <span>
                        <input name="wd" type="text" id="key" class="input_tt" placeholder="搜索商品">
                </span>
                </form>
            </div>
            <a href="{{ url('/') }}"><i class="main-icon2"></i></a></div>


        <div class="nave clear">
            <div class="navelist">
                <ul>
                    <li><a href="/lmnvzhuang">女装</a></li>
                    <li><a href="/lmnanzhuang">男装</a></li>
                    <li><a href="/lmneiyi">内衣</a></li>
                    <li><a href="/lmxiebao">鞋包</a></li>
                    <li><a href="/lmpeishi">配饰</a></li>
                </ul>
                <div id="aa" onclick="toggleWords(this);" class="more arrow_down"><i></i></div>
            </div>
            <div class="dewm" id="dewmdiv">
                <a href="/lmjiaju">家居</a>
                <a href="/lmmeizhuang">美妆</a>
                <a href="/lmmeishi">美食</a>
                <a href="/lmshuma">数码</a>
                <a href="/lmhuwai">户外</a>
            </div>
        </div>
    </div>
</div>

@yield('content')

<a href="javascript: void(0);" data-event_id="MHome_BackTop" class="totop" style="display: none;"></a>

<div id="foot">
    <div class="foot-copyright">&copy; {{ date('Y') }} <a
                href="{{ config('app.mobileurl') }}">{{ config('app.name') }}</a> All Rights Reserved
    </div>
</div>


{{ script(url('js/jquery.min.js')) }}
{{ script(url('js/mobile.js')) }}
<script type="text/javascript">

    function toggleWords(obj) {

        var target = !!window.ActiveXObject ? obj.parentNode.nextSibling : obj.parentNode.nextElementSibling;

        target.style.display = !target.style.display || target.style.display == 'none' ? 'block' : 'none';

        obj.className = obj.className == 'more arrow_down' ? 'more arrow_up' : 'more arrow_down';
        return false;
    }
    $(window).scroll(function () {
        if ($(window).scrollTop() > 500) {
            $(".totop").fadeIn(1000);
        }
        else {
            $(".totop").fadeOut(1000);
        }
    });

</script>


</body>
</html>
