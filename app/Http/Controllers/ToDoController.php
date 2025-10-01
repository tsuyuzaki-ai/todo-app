<?php

namespace App\Http\Controllers;

use App\Models\ToDo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // ファイル保存のために追加

class ToDoController extends Controller
{
    // ToDoリストの一覧を表示
    public function index()
    {
        // 全てのToDo項目を取得
        $todos = ToDo::all();
        // 'todos.index'ビューにデータを渡して表示
        return view('todos.index', compact('todos'));
    }


    // ToDo作成フォームの表示 
    public function create()
    {
        return view('todos.create');
    }




    // 新しいToDoをデータベースに保存
    public function store(Request $request)
    {
        // データのバリデーション
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'priority' => 'required|in:high,medium,low',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // ToDoインスタンスを新規作成
        $todo = new ToDo();
        $todo->title = $request->title;
        $todo->description = $request->description;
        $todo->priority = $request->priority;
        $todo->is_completed = false; // 初期値は未完了

        // 画像がアップロードされた場合
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $todo->image_path = $imagePath;
        }

        // データベースに保存
        $todo->save();

        // 一覧ページにリダイレクト
        return redirect()->route('todos.index')->with('success', 'ToDoが作成されました。');
    }







    // ToDo詳細の表示
    public function show(ToDo $todo)
    {
        return view('todos.show', compact('todo'));
    }





    
    // ToDo編集フォームの表示
    public function edit(ToDo $todo)
    {
        return view('todos.edit', compact('todo'));
    }

    // 既存のToDoを更新
    public function update(Request $request, ToDo $todo)
    {
        // データのバリデーション
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'priority' => 'required|in:high,medium,low',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // ToDoのデータを更新
        $todo->title = $request->title;
        $todo->description = $request->description;
        $todo->priority = $request->priority;
        $todo->is_completed = $request->has('is_completed'); // チェックボックスの状態を反映

        // 新しい画像がアップロードされた場合
        if ($request->hasFile('image')) {
            // 既存の画像を削除
            if ($todo->image_path) {
                Storage::disk('public')->delete($todo->image_path);
            }
            $imagePath = $request->file('image')->store('images', 'public');
            $todo->image_path = $imagePath;
        }

        // データベースに保存
        $todo->save();

        // 一覧ページにリダイレクト
        return redirect()->route('todos.index')->with('success', 'ToDoが更新されました。');
    }


    // ToDoを削除
    public function destroy(ToDo $todo)
    {
        // 画像を削除
        if ($todo->image_path) {
            Storage::disk('public')->delete($todo->image_path);
        }

        // ToDoをデータベースから削除
        $todo->delete();

        // 一覧ページにリダイレクト
        return redirect()->route('todos.index')->with('success', 'ToDoが削除されました。');
    }
}
