<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Memo;
use App\Models\Tags;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // タグ一覧。メモ一覧の取得
        view()->composer('*', function ($view) {

            // メモ一覧の取得
            $memo_model = new Memo();
            $memos = $memo_model->getMyMemo();


            // タグ一覧の取得
            $tags = Tags::where('user_id', '=', \Auth::id())
            ->whereNull('deleted_at')
            ->orderBy('id', 'DESC')
            ->get();



            $view->with('memos', $memos)->with('tags', $tags);


        });
    }
}
