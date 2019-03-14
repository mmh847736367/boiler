@extends('backend.layouts.app')

@section('title', app_name() . ' | ' .'拼购关键字管理')

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <h4 class="card-title mb-0">
                        拼购关键字管理
                    </h4>
                </div><!--col-->
                <div class="col-sm-5">
                    <form class="form-horizontal" action="/admin/content/keyword/search" method="get">
                        @csrf
                        <div class="form-group">
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
                <div class="col-sm-3">
                    <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                        <a href="{{ route('admin.keyword.create') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="批量添加关键字"><i class="fas fa-plus-circle"></i></a>
                    </div><!--btn-toolbar-->
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>name</th>
                                <th>md5</th>
                                <th>slug</th>
                                <th>是否过滤</th>
                                <th>最后更新时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($keywords as $keyword)
                                <tr>
                                    <td>{{ $keyword->id }}</td>
                                    <td>{{ $keyword->name }}</td>
                                    <td>{{ $keyword->md5 }}</td>
                                    <td>{{ $keyword->slug }}</td>
                                    <td>{!! $keyword->status_label !!}</td>
                                    <td>{{ $keyword->updated_at->diffForHumans() }}</td>
                                    <td>{!! $keyword->action_buttons !!}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!--col-->
            </div><!--row-->

            <div>
            <div class="col-5">
            {!! $keywords->links() !!}
            </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
@endsection

