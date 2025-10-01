@extends('layouts.app')

@section('content')
<div class="card">
    <h1 class="heading">ToDoリスト</h1>
    <a href="{{ route('todos.create') }}" class="button primary-button">新規ToDo作成</a>

    @if($todos->isEmpty())
        <p class="empty-message">ToDoはまだありません。</p>
    @else
        <ul class="todo-list">
            @foreach($todos as $todo)
                <li class="todo-item">
                    <div class="todo-content">
                        <h2 class="todo-title">{{ $todo->title }}</h2>
                        <p class="todo-description">{{ $todo->description }}</p>
                        <p class="todo-priority">優先度: {{ $todo->priority }}</p>
                    </div>
                    <div class="todo-actions">
                        <a href="{{ route('todos.edit', $todo->id) }}" class="button edit-button">編集</a>
                        <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" class="delete-form" onsubmit="return confirm('本当に削除しますか？');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button delete-button">削除</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
