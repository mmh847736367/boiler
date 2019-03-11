@extends('frontend.layouts.app')

@section('banner')
@include('frontend.includes.banner')
@endsection
@section('content')
<div class="mxwidth clear">
    <div class="title-box">
        <div class="title-line"></div>
        <div class="title-textbig">精选<b>推荐</b></div>
    </div>
    <div class="wrapper">
        <div class="item-goods">
            <ul>
                @foreach($viewData['randomGoods'] as $good)
                <li class="goods-list item-4">
                    <div class="cp">
                        <div class="cptu">
                            <div class="image image-tu1"><img src="{{ url('img/upload/'.$good['slugImg']) }}"></div>
                            <p class="prod-name"><a href="{{ route('frontend.good', $good['slug']) }}" target="_blank">{{ $good['title'] }}</a></p>
                            <p class="prod-price">￥{{ $good['price'] }}</p>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<div class="mxwidth word"><span>热门搜索：</span>
    @foreach($viewData['relateWords'] as $word)
        <a href="{{ url('s/'.$word->slug).'/' }}">{{ $word->name }}</a>
    @endforeach
</div>

@endsection

@push('script')
<script type="text/javascript">
    $("#carousel_1").FtCarousel();

    $("#carousel_2").FtCarousel({
        index: 1,
        auto: false
    });

    $("#carousel_3").FtCarousel({
        index: 0,
        auto: true,
        time: 3000,
        indicators: false,
        buttons: true
    });


</script>
@endpush
