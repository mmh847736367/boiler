@extends('frontend.layouts.app')

@section('title', $viewData['title'].'_'.app_name())

@section('content')
    <div class="mxwidth location">当前位置：&nbsp;<a href="{{ config('app.url') }}">首页</a> &gt; {{ $viewData['title'] }}
    </div>
    {{--<div class="mxwidth clear">--}}
        {{--<div class="listfenlei">--}}
            {{--<div class="classification">--}}
                {{--<div class="belowpart">--}}
                    {{--<div class="menu-title">--}}
                        {{--<div class="title-text"><a href="list2.html">相关品牌</a></div>--}}
                        {{--<i class="righticon iconfont icon-gengduo2"></i></div>--}}
                    {{--<div class="menu-con">--}}
                        {{--@foreach($viewData['words'] as $word)--}}
                        {{--<a href="{{ url('s/'.$word->slug).'/' }}">{{ $word->name }}</a>--}}
                        {{--@endforeach--}}
                        {{--<div class="line"></div>--}}
                    {{--</div>--}}

                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>


    <div class="mxwidth clear">
        <div class="wrapper">

            <div class="item-goods">
                <ul>
                    @foreach($viewData['goods'] as $good)
                    <li class="goods-list item-4">
                        <div class="cp">
                            <div class="cptu">
                                <div class="image image-tu1">
                                    <img src="{{ url('img/upload/'.$good['slugImg']) }}">
                                </div>
                                <p class="prod-name">
                                    <a href="{{ route('frontend.good', $good['slug']) }}" target="_blank">{{ $good['title'] }}</a>
                                </p>
                                <p class="prod-price">￥{{ $good['price'] }}</p></div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>


    <div class="mxwidth clear">
        <div class="page">
            <div class="pagelist">
             {!! $viewData['pageHtml'] !!}
            </div>
        </div>
    </div>

    <div class="mxwidth word"><span>相关搜索：</span>
        @foreach($viewData['relateWords'] as $word)
        <a href="{{ url('s/'.$word->slug).'/' }}">{{ $word->name }}</a>
        @endforeach
    </div>

@endsection
