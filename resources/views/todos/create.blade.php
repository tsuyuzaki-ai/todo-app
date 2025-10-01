@extends('layouts.app')

@section('content')
<div class="card">
    <h1 class="heading">新規ToDo作成</h1>
    <form action="{{ route('todos.store') }}" method="POST" enctype="multipart/form-data" class="form">
        @csrf
        <div class="form-group">
            <label for="title" class="form-label">タイトル:</label>
            <input type="text" name="title" id="title" class="form-input" required>
        </div>
        <div class="form-group">
            <label for="description" class="form-label">詳細:</label>
            <textarea name="description" id="description" rows="4" class="form-input"></textarea>
        </div>
        <div class="form-group">
            <label for="priority" class="form-label">優先度:</label>
            <select name="priority" id="priority" class="form-input">
                <option value="high">高</option>
                <option value="medium" selected>中</option>
                <option value="low">低</option>
            </select>
        </div>
        <div class="form-group">
            <label for="image" class="form-label">画像:</label>
            <input type="file" name="image" id="image" class="form-input">
        </div>
        <div class="form-actions">
            <button type="submit" class="button primary-button">作成</button>
            <a href="{{ route('todos.index') }}" class="cancel-link">キャンセル</a>
        </div>
    </form>
</div>
@endsection
