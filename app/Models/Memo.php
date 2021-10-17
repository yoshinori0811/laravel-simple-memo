<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    use HasFactory;

    public function getMyMemo(){

        $query_tag = \Request::query('tag');
        // ベースのクエリメソッド
        $query = Memo::query()->select('memos.*')
            ->where('user_id', '=', \Auth::id())
            ->whereNull('deleted_at')
            ->orderBy('updated_at', 'DESC');

        // クエリパラメータがあれば
        if(!empty($query_tag) ){
            // タグからメモを取得
            $query->leftJoin('memo_tags', 'memo_tags.memo_id', '=', 'memos.id')
                ->where('memo_tags.tag_id', '=', $query_tag);
        }

        $memos = $query->get();

        return $memos;
    }
}
