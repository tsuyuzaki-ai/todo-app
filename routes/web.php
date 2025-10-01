<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToDoController;


// 下層7つを全部まとめる場合
// Route::resource('todos', ToDoController::class); 


// ホームページ（タスク一覧）
Route::get('/', [ToDoController::class, 'index'])->name('todos.index');
// タスクの作成フォーム（具体的なルートを先に配置）
Route::get('/todos/create', [ToDoController::class, 'create'])->name('todos.create');
// タスクの詳細
Route::get('/todos/{todo}', [ToDoController::class, 'show'])->name('todos.show');
// タスクの追加（見えない）
Route::post('/todos', [ToDoController::class, 'store'])->name('todos.store');
// タスクの編集フォーム
Route::get('/todos/{todo}/edit', [ToDoController::class, 'edit'])->name('todos.edit');
// タスクの更新（見えない）
Route::put('/todos/{todo}', [ToDoController::class, 'update'])->name('todos.update');
// タスクの削除（見えない）
Route::delete('/todos/{todo}', [ToDoController::class, 'destroy'])->name('todos.destroy');


