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
                    <form class="form-horizontal" action="/admin/spider/tb/show" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="col-form-label" for="appendedInputButtons">淘宝内页id</label>
                            <div class="controls">
                                <div class="input-group">
                                    <input class="form-control" name="id" size="16" type="text">
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
@endsection
