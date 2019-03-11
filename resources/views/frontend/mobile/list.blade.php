@extends('frontend.layouts.app_mobile')

@section('title', $viewData['title'].'_'.app_name())

@section('content')
<div class="box">
    <div class="content">
        <ul class="goods">
            @foreach($viewData['goods'] as $good)
            <li class="goods-item"><a href="{{ route('frontend.good', $good['slug']) }}">
                    <div class="goods-pic">
                        <div class="goods-tu goods-img"><img src="{{ config('app.url').'/img/upload/'.$good['slugImg']) }}"></div>
                    </div>
                    <div class="goods-item-name">{{ $good['title'] }}/div>
                    <div class="goods-item-price">￥{{ $good['price'] }}</div>
                </a>
            </li>
            @endforeach
        </ul>
    </div>


    <div class="page">
        <ul class="page-list">
            {!! $viewData['pageHtml'] !!}
        </ul>
    </div>

    <div class="keyword"><span>相关搜索：</span>
        @foreach($viewData['relateWords'] as $word)
            <a href="{{ url('s/'.$word->slug).'/' }}">{{ $word->name }}</a>
        @endforeach
    </div>

</div>
@endsection
