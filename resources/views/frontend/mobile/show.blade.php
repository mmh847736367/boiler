@extends('frontend.layouts.app_mobile')

@section('title', $viewData['title'].'_'.app_name())
@section('content')
<div class="box">
    <div id="cptubox">
        <div id="cptulb" class="cptulb">
            <div class="tulist">
                <div class="tu">
                    <ul>
                        @foreach($viewData['good']['slugImg'] as $slugImg)
                        <li><img src="{{ url('img/upload/'.$slugImg) }}"></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="tunamblist">
                <ul>

                    @foreach($viewData['good']['slugImg'] as $key => $slugImg)
                    <li class="">{{ $key }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <script type="text/javascript">
            Touchtplb({
                slideCell: "#cptulb",
                titCell: ".tunamblist ul",
                mainCell: ".tulist ul",
                effect: "leftLoop",
                autoPage: true,
                autoPlay: true
            });
        </script>
    </div>


    <div class="cpbox_box2">
        <h3>{{ $viewData['good']['name'] }}</h3>

        <div class="cpbox_buy">
            <span>￥{{ $viewData['good']['price'] }}</span>
        </div>
        <div class="wid12hr"></div>
        <div class="cptxt">
            <div class="cp_tit">商品详情</div>
            <div class="cpjs">
                @foreach($viewData['good']['intro'] as $intro)
                <p>{{ $intro }}</p>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="wid12hr"></div>
<div class="box">
    <div class="initemtit">
        <span class="line"></span>
        <span class="tit"><a href="mlist.html">相关产品</a></span>
    </div>
    <div class="content">
        <ul class="goods">
            @foreach($viewData['relateGoods'] as $good)
            <li class="goods-item"><a href="{{ route('frontend.good', $good['slug']) }}">
                    <div class="goods-pic">
                        <div class="goods-tu goods-img"><img src="{{ url('img/upload/'.$good['slugImg']) }}"></div>
                    </div>
                    <div class="goods-item-name">{{ $good['title'] }}</div>
                    <div class="goods-item-price">￥{{ $good['price'] }}</div>
                </a>
            </li>
            @endforeach
        </ul>
    </div>

    <div class="wid12hr"></div>
    <div class="keyword"><span>相关搜索：</span>
       @foreach($viewData['relateWords'] as $word)
            <a href="{{ url('s/'.$word->slug).'/' }}">{{ $word->name }}</a>
        @endforeach
    </div>

</div>
@endsection
