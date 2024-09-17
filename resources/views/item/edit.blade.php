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
            <input type="text" name="name" class="form-control" value="{{ old('name', $item->name) }}">

            <!-- エラーメッセージの表示 -->
            @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="type">種別</label>
            <input type="text" id="type" name="type" class="form-control" value="{{ $item->type }}" required>
            
            @error('type')
                <div class="text-danger">{{ 種別は100文字以内で入力してください。 }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="detail">詳細</label>
            <textarea id="detail" name="detail" class="form-control" required>{{ $item->detail }}</textarea>

            @error('detail')
                <div class="text-danger">{{ 詳細は500文字以内で入力してください。 }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">更新</button>
        <a href="{{ route('items.index') }}" class="btn btn-secondary">戻る</a>
    </form>
@stop

@section('css')
@stop

@section('js')
@stop