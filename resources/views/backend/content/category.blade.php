@extends('backend.layouts.app')

@section('title', app_name() . ' | ' .'导航管理')

@section('breadcrumb-links')
@include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    导航管理
                </h4>
            </div><!--col-->

            {{--<div class="col-sm-7">--}}
                {{--@include('backend.auth.user.includes.header-buttons')--}}
            {{--</div><!--col-->--}}
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>name</th>
                            <th>title</th>
                            <th>slug</th>
                            <th>status</th>
                            <th>最后更新时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->title }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>{!! $category->status_label !!}</td>
                            <td>{{ $category->updated_at->diffForHumans() }}</td>
                            <td>{!! $category->action_buttons !!}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        {{--<div class="row">--}}
            {{--<div class="col-7">--}}
                {{--<div class="float-left">--}}
                    {{--{!! $users->total() !!} {{ trans_choice('labels.backend.access.users.table.total', $users->total()) }}--}}
                {{--</div>--}}
            {{--</div><!--col-->--}}

            {{--<div class="col-5">--}}
                {{--<div class="float-right">--}}
                    {{--{!! $users->render() !!}--}}
                {{--</div>--}}
            {{--</div><!--col-->--}}
        {{--</div><!--row-->--}}
    </div><!--card-body-->
</div><!--card-->
@endsection
