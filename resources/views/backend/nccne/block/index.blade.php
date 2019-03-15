@extends('backend.layouts.app')

@section('title', app_name() . ' | ' .'你瞅啥文章管理')

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <h4 class="card-title mb-0">
                        你瞅啥文章管理
                    </h4>
                </div><!--col-->
                <div class="col-sm-5">
                    <form class="form-horizontal" action="/admin/nccne/block" method="get">
                        <div class="form-group">
                            <div class="controls">
                                <div class="input-group">
                                    <input class="form-control" name="q" size="16" type="text"  value="{{ request()->query('q') }}">
                                    <span class="input-group-append">
                                            <button type="submit" class="btn btn-secondary" type="button">Search</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>name</th>
                                <th>slug</th>
                                <th>状态</th>
                                <th>最后更新时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($blocks as $block)
                                <tr>
                                    <td>{{ $block->id }}</td>
                                    <td>{{ $block->name }}</td>
                                    <td>{{ $block->slug }}</td>
                                    <td>{!! $block->status_label !!}</td>
                                    <td>{{empty($block->updated_at) ? '' : $block->updated_at->diffForHumans()  }}</td>
                                    <td>{!! $block->action_buttons !!}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!--col-->
            </div><!--row-->

            <div class="row">
                <div class="col-5">
                    @if(request()->has('q'))
                        {!! $blocks->appends(['q' => request()->query('q')])->links() !!}
                    @else
                        {!! $blocks->links() !!}
                    @endif
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
@endsection


