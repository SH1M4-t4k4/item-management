@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <h1>商品一覧</h1>
@stop

@section('content')
<!-- 成功メッセージの表示 -->
@if (session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif

<!-- 検索フォーム -->
<form method="GET" action="{{ url('items') }}">
    <div class="row mb-3">
        <div class="col-md-4">
            <!-- 名前・種別で検索（10文字まで） -->
            <input type="text" name="keyword" placeholder="商品名または種別を入力" value="{{ request()->input('keyword') }}" maxlength="10">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">検索</button>
        </div>
    </div>
</form>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">商品一覧</h3>
                <div class="card-tools">
                    <div class="input-group input-group-sm">
                        <div class="input-group-append">
                            <a href="{{ url('items/add') }}" class="btn btn-default">商品登録</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>名前</th>
                            <th>種別</th>
                            <th>詳細</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->type }}</td>
                                <td>{{ $item->detail }}</td>
                                <td>
                                    <!-- 編集ボタン -->
                                    <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning">編集</a>
                                    <!-- 削除ボタン -->
                                    <form action="{{ route('items.delete', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">削除</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
@stop
