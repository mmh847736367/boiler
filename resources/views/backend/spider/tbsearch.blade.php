@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    taobao spider
                </div>
                <div class="card-body collapse show" id="collapseExample">
                    <form class="form-horizontal" action="/admin/spider/tb/search" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="col-form-label" for="appendedInputButtons">淘宝关键字搜索</label>
                            <div class="controls">
                                <div class="input-group">
                                    <input class="form-control" name="q" size="16" type="text">
                                    <span class="input-group-append">
                                        <button type="submit" class="btn btn-secondary" type="button">Search</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if(!empty($body))
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    抓取结果
                </div>
                <div class="card-body collapse show">
                  <pre style="width: 100%; height: 500px">{!! $body !!}</pre>
                </div>
            </div>
        </div>
    </div>
    @endif

@endsection
