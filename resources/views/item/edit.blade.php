@extends('adminlte::page')

@section('title', '商品編集')

@section('content_header')
    <h1>商品編集</h1>
@stop

@section('content')
    <form action="{{ route('items.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- 更新メソッドを指定 -->
        <div class="form-group">
            <label for="name">名前</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $item->name) }}">

            <!-- エラーメッセージの表示 -->
            @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="type">種別</label>
            <input type="text" id="type" name="type" class="form-control" value="{{ old('type', $item->type) }}">
            
            @if ($errors->has('type'))
                <div class="text-danger">{{ $errors->first('type') }}</div>
            @endif
        </div>

        <div class="form-group">
            <label for="detail">詳細</label>
            <textarea id="detail" name="detail" class="form-control" required>{{ old('detail', $item->detail) }}</textarea>

            @if ($errors->has('detail'))
                <div class="text-danger">{{ $errors->first('detail') }}</div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">更新</button>
        <a href="{{ route('items.index') }}" class="btn btn-secondary">戻る</a>
    </form>
@stop

@section('css')
@stop

@section('js')
@stop