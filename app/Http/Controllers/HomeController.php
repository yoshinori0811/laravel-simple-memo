<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memo;
use App\Models\Tags;
use App\Models\MemoTags;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    /**
     * メモデータ取得
    * @param void
    * @return view
    */
    public function index()
    {

        return view('create');
    }


    /**
     * 新規作成のメモ保存
     * @param request
     * @return redirect home
     *
     */
    public function store(Request $request)
    {
        $posts = $request->all();

        $request->validate( ['content' => 'required'] );

        DB::transaction(function() use($posts) {
            $memo_id = Memo::insertGetId(['content' => $posts['content'],'user_id' => \Auth::id()]);
            $tag_exists = Tags::where('user_id', '=', \Auth::id())->where('name' , '=', $posts['new_tag'])->exists();

            if(!empty($posts['new_tag']) && !$tag_exists) {
                $tag_id = Tags::insertGetId(['user_id' => \Auth::id(), 'name' => $posts['new_tag']]);
                MemoTags::insert(['memo_id' => $memo_id, 'tag_id' => $tag_id]);
            }

            if(!empty($posts['tags'][0])){
                foreach($posts['tags'] as $tag){
                    MemoTags::insert(['memo_id'=> $memo_id, 'tag_id' => $tag]);
                }
            }
        });

        return redirect (route('home') );
    }

    /**
     * 「メモの編集」画面の表示
     *
     *
     */
    public function edit($id)
    {
        $edit_memo = Memo::select('memos.*', 'tags.id AS tag_id')
        ->leftjoin('memo_tags', 'memo_tags.memo_id', '=', 'memos.id')
        ->leftjoin('tags', 'memo_tags.tag_id', '=', 'tags.id')
        ->where('memos.user_id', '=', \Auth::id())
        ->where('memos.id', '=', $id)
        ->whereNull('memos.deleted_at')
        ->get();

        $include_tags = [];
        foreach($edit_memo as $memo){
            array_push($include_tags, $memo['tag_id']);
        }

        $tags = Tags::where('user_id', '=', \Auth::id())
        ->wherenull('deleted_at')
        ->orderBy('id', 'DESC')
        ->get();

        return view('edit', compact('edit_memo', 'include_tags', 'tags'));
    }

    /**
     * 「メモの編集」の更新
     *
     *
     */
    public function update(Request $request)
    {
        $posts = $request->all();

        $request->validate( ['content' => 'required'] );

        DB::transaction(function() use($posts){
            Memo::where('id', $posts['memo_id'])
            ->update(['content' => $posts['content']]);

            Memotags::where('memo_id', '=', $posts['memo_id'])->delete();

            if(isset($posts['tags'])){
                foreach($posts['tags'] as $tag){
                    Memotags::insert(['memo_id' => $posts['memo_id'], 'tag_id' => $tag]);
                }
            }

            $tag_exists = Tags::where('user_id', '=', \Auth::id())->where('name' , '=', $posts['new_tag'])->exists();

            if(!empty($posts['new_tag']) && !$tag_exists) {
                $tag_id = Tags::insertGetId(['user_id' => \Auth::id(), 'name' => $posts['new_tag']]);
                MemoTags::insert(['memo_id' => $posts['memo_id'], 'tag_id' => $tag_id]);
            }
        });

        return redirect( route('home') );
    }

    /**
     * メモの駆除
     *
     *
     */
    public function destory(Request $request)
    {
        $posts = $request->all();

        Memo::where('id', $posts['memo_id'])
            ->update(['deleted_at' => date("Y-m-d H:i:s", time())]);

        return redirect( route('home') );
    }
}
