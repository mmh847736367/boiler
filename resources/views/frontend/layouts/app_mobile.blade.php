<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="x-dns-prefetch-control" content="on">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta content="telephone=no" name="format-detection">
    <meta name="full-screen" content="yes">
    <meta name="x5-fullscreen" content="true">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
    <title>@yield('title', config('app.name'))</title>
    <link rel="icon" href="/favicon.ico" type="images/x-icon">
    {{ style(url('css/mobilecss.css')) }}
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
                    <li><a href="mlist.html">女装</a></li>
                    <li><a href="mlist.html">男装</a></li>
                    <li><a href="mlist.html">内衣</a></li>
                    <li><a href="mlist.html">女鞋</a></li>
                    <li><a href="mlist.html">男鞋</a></li>
                </ul>
                <div id="aa" onclick="toggleWords(this);" class="more arrow_down"><i></i></div>
            </div>
            <div class="dewm" id="dewmdiv"><a href="#">女包</a><a href="#">男包</a><a href="#">日用</a><a href="#">床品</a><a
                        href="#">收纳</a><a href="#">护肤</a><a href="#">彩妆</a><a href="#">护发</a><a href="#">户外</a><a
                        href="#">运动服</a><a href="#">饰品</a><a href="#">手表</a><a href="#">眼镜</a><a href="#">数码配件</a><a
                        href="#">电脑</a><a href="#">家居</a><a href="#">玩具</a><a href="#">零食</a><a href="#">冲饮</a><a
                        href="#">电器</a><a href="#">厨房</a><a href="#">宠物</a><a href="#">音乐音像</a></div>
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
