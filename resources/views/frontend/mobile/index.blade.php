@extends('frontend.layouts.app_mobile')

@section('content')
    <div class="box">
        <div class="initemtit">
            <span class="line"></span>
            <span class="tit">精选推荐</span>
        </div>
        <div class="content pm15">
            <ul class="goods">
                @foreach($viewData['randomGoods'] as $good)
                    <li class="goods-item">
                        <a href="{{ route('frontend.good', $good['slug']) }}">
                            <div class="goods-pic">
                                <div class="goods-tu goods-img"><img src="{{ config('app.url').'/img/upload/'.$good['slugImg'] }}">
                                </div>
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
