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
                        添加
                    </h4>
                </div><!--col-->
            </div>
            <div class="row mt-4">
                <div class="col">

                    @if(old('uploaded') == 1)
                    <form action="{{ route('admin.keyword.store') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-success">执行添加关键字</button>
                    </form>
                    @else
                        <form action="{{ route('admin.store.keyword.upload') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input id="file" type="file" name="keyword" required>
                            <input type="hidden" name="uploaded" value="1">
                            <button type="submit" class="btn btn-primary">上传</button>
                        </form>
                    @endif
               </div><!--col-->
            </div><!--row-->


        </div><!--card-body-->
    </div><!--card-->

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <h4 class="card-title mb-0">
                        过滤
                    </h4>
                </div><!--col-->
            </div>
            <div class="row mt-4">
                <div class="col">

                    @if(old('uploaded') == 2)
                    <form action="{{ route('admin.keyword.filter.store') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-success">执行过滤关键字</button>
                    </form>
                    @else
                    <form action="{{ route('admin.store.keyword.filter.upload') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input id="file" type="file" name="keyword" value="111" required>
                        <input type="hidden" name="uploaded" value="2">
                        <button type="submit" class="btn btn-primary">上传</button>
                    </form>
                    @endif
                </div><!--col-->
            </div><!--row-->


        </div><!--card-body-->
    </div><!--card-->
@endsection


