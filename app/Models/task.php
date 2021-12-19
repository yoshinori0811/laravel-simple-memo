<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    use HasFactory;

    public function getTask() {

        $query_task = \Request::query('task');
        $limit = date('Y-m-d');
        // タスクのベースクエリ
        $task_query = task::query()->select('tasks.*')
        ->where('user_id', '=', \Auth::id())
        // ->where('timelimit', '=', $limit)
        // ->where('status', '!=', '3')->orWhereNull('status')
        ->whereNull('deleted_at')
        ->orderBy('timelimit', 'ASC');
        // ログイン日を取得したい yyyy/mm/dd
        // 今日のタスクを全表示
        $tasks = $task_query->get();
        // テスト

        return $tasks;



    }
}
