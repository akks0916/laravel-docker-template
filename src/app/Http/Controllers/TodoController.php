<?php

namespace App\Http\Controllers;

use App\Todo;
// TodoモデルをControllerにて呼び出し、インスタンス化/
use Illuminate\Http\Request;

class TodoController extends Controller
{
    private $todo;

    // 追加
    public function __construct(Todo $todo)
    // Todo $todoでルートから呼び出されて内部でインスタンス化
    {
        $this->todo = $todo;
    }
    
    public function create()
    {
        return view('todo.create');
    }

    public function store(Request $request)
    {
        $inputs = $request->all();
        // Requestクラスのall()を使用し、フォームで入力された値を連想配列に変換して取得
        $this->todo->fill($inputs);
        // 連想配列を渡しその情報を$this->todoに保存
        $this->todo->save();
        // ToDo一覧画面にリダイレクト
        return redirect()->route('todo.index');
    }
    // fiiでモデルに値を一括セット

    public function index()
    {
        $todos = $this->todo->all();
        // モデルが対応するテーブルにSELECT文を実行しレコードを取得
        return view('todo.index', ['todos' => $todos]);
        // todosという名前の変数に$todosの中身を入れて、todo/index.blade.phpで使えるように
    }
}
