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
                        拼购关键字批量添加
                    </h4>
                </div><!--col-->
            </div>
            <div class="row mt-4">
                <div class="col">
                    <form action="{{ route('admin.store.keyword.upload') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input id="file" type="file" name="keyword" required>
                        <button type="submit" class="btn btn-primary">确定</button>
                    </form>

                    <form action="{{ route('admin.keyword.store') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-danger">批量添加关键字</button>
                    </form>
               </div><!--col-->
            </div><!--row-->


        </div><!--card-body-->
    </div><!--card-->
@endsection


