<div class="top-main mxwidth">
    <div class="logo"><a href="{{ config('app.url') }}"><img src="{{ url('images/logo.png') }}"></a></div><div class="search">
        <form name="searchform" method="post" action="/query">
            @csrf
                <span>
                    <input name="wd" type="text" id="key" onfocus="this.value=&#39;&#39;;this.style.color=&#39;#000&#39;;" class="input_tt" placeholder="搜索商品、品牌">
                </span>
            <input type="submit" class="s_btn" value="搜索">

        </form>
    </div>
    <div class="topright"><i class="topright-f"></i><i class="topright-x"></i><i class="topright-g"></i></div>
</div>

<div class="top-nave">
    <div class="mxwidth">
        <div class="category-all"><a href="javascript:;"><div class="category-all-title"><img class="icon-fenlei" src="{{ url('images/fltu.png') }}"><span class="categorytext">全部商品分类</span><img class="icon-fenlei2" src="{{ url('images/mb-arrow-right.png') }}"></div></a>
            <div class="category {{ request()->is('/') ? 'show' : '' }}">
                <ul class="listnav">
                    @foreach($navs as $navGroup)
                    <li class="listid1">
                        @foreach($navGroup as $nav)
                        <a {!! $nav->is_hot ? 'class="co" ' : ' '!!}href="{{ url('lm'.$nav->slug).'/' }}">{{ $nav->name }}</a>{{ !$loop->last ? ' / ' : '' }}
                        @endforeach
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="nav-hd">
            <a href="{{ config('app.url') }}">首页</a>
            @foreach($categories as $category)
            <a href="{{ url('lm'.$category->slug) }}/">{{ $category->name }}</a>
            @endforeach
            <a href="{{ url('/pinpaiku').'/' }}">品牌库</a>
        </div>
    </div>
</div>