@extends('adminlte::page')

@section('title', '商品編集')

@section('content_header')
    <h1>商品編集</h1>
@stop

@section('content')
    <form action="{{ route('items.update', $item->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">名前</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $item->name }}" required>
        </div>
        <div class="form-group">
            <label for="type">種別</label>
            <input type="text" id="type" name="type" class="form-control" value="{{ $item->type }}" required>
        </div>
        <div class="form-group">
            <label for="detail">詳細</label>
            <textarea id="detail" name="detail" class="form-control" required>{{ $item->detail }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">更新</button>
        <a href="{{ route('items.index') }}" class="btn btn-secondary">戻る</a>
    </form>
@stop

@section('css')
@stop

@section('js')
@stop