@extends('frontend.layouts.app')

@push('style')
{{ style(url('css/bootstrap.min.css')) }}
@endpush
@section('title', '品牌库_'.app_name())
@section('content')
    <div class="container">
        <div class="mxwidth location">当前位置：&nbsp;<a href="/">首页</a> &gt; 品牌库</div>

        <div class="mxwidth clear">
            <div class="wrapper">
                <div class="rmss">
                    <ul class="row">
                        @foreach($keywords as $word)
                            <li class="col-xs-3"><a href="{{ url('/s/'.$word->slug).'/' }}" target="_blank">{{ $word->name }}</a></li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
        <nav class="text-center" aria-label="Page navigation">
            {!! $keywords->links() !!}
        </nav>
    </div>
@endsection