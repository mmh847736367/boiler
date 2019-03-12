@extends('frontend.layouts.app')



@section('title', $viewData['title'].'_'.app_name())
@section('content')
    <div class="mxwidth clear">

        <div class="showleft">
            <div class="showleft-cptu">
                <div class="image image-tu1">
                    <img class="jqimg" src="{{ url('img/upload/'.$viewData['good']['slugImg'][0])  }}"></div>
            </div>
            <div class="showleft-item"><span id="prev" class="prev"></span>
                <ul id="tulist">
                    @foreach($viewData['good']['slugImg'] as $slugImg)
                    <li class="item-list"><img src="{{ url('img/upload/'.$slugImg) }}"></li>
                    @endforeach

                    </li>
                </ul>
                <span id="next" class="next"></span></div>
        </div>

        <div class="showright"><h2>{{ $viewData['good']['name'] }}</h2>
            <div class="price-line">
                @if($viewData['good']['price'] != 0)
                <span> 价格：</span><span class="tm">¥</span><span class="price-present">{{ $viewData['good']['price'] }}</span>
                @else
                <span>暂无报价</span>
                @endif
            </div>
            <ul class="detail_add">
                @foreach($viewData['good']['intro'] as $intro)
                <li>{{ $intro }}</li>
                @endforeach

            </ul>
            {{--<div class="btn-line"><a href="#">--}}
                    {{--<div class="btn-buy">立即购买</div>--}}
                {{--</a><a href="#">--}}
                    {{--<div class="btn-addbuy">加入购物车</div>--}}
                {{--</a>--}}
            {{--</div>--}}
        </div>

    </div>

    {{--<div class="mxwidth clear">--}}
        {{--<div class="description">--}}
            {{--<div class="description-title"><i class="description-tit-icon"></i>商品详情</div>--}}
            {{--<div class="description-text">iRobot 651，是iRobot 650的升级版，比较iRobot--}}
                {{--650来说，651电池替换为X-Life新镍氢电池，采用电源一体充电基座，采用起来更加方便。<p>搭载Aerovac--}}
                    {{--集尘盒，增大存储空间，并更合适毛发扫入收集，能更大程度清洗宠物毛和人的头发等毛发纤维，十分适合养宠物的家庭</p></div>--}}
        {{--</div>--}}


    {{--</div>--}}



    <div class="mxwidth clear">
        <div class="wrapper">
            <div class="title-box">
                <div class="title-line"></div>
                <div class="title-textbig">推荐<b>产品</b></div>
            </div>
            <div class="item-goods">
                <ul>
                    @foreach($viewData['relateGoods'] as $good)
                    <li class="goods-list item-4">
                        <div class="cp">
                            <div class="cptu">
                                <div class="image image-tu1"><img src="{{ url('img/upload/'.$good['slugImg']) }}"></div>
                                <p class="prod-name"><a href="{{ route('frontend.good', $good['slug']) }}" target="_blank">{{ $good['title'] }}</a></p>
                                <p class="prod-price">￥{{ $good['price'] }}</p></div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
    @if(isset($viewData['relateWords']))
    <div class="mxwidth word"><span>相关搜索：</span>
        @foreach($viewData['relateWords'] as $word)
            <a href="{{ url('s/'.$word->slug).'/' }}">{{ $word->name }}</a>
        @endforeach
    </div>
    @endif
@endsection
