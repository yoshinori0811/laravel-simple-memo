# laravel-simple-memo

laravelを使ってのメモアプリです。

## 簡単な説明

タグ一覧から登録したタグでメモの絞り込みができます。
メモ一覧から新規作成、既存メモの編集が可能です。

***デモ***

![デモ画面](README_image.png)`
![デモ画面](README_image_2.png)`

## 機能　

1. アカウント登録、ログイン、ログアウト機能
2. メモの作成、編集、削除機能
3. タグの絞り込み機能

## 必要要件

※windows,macで動作確認済み
1. PHP 7.4.24
2. Laravel 8.64.0
3. MySQL 5.7.24
4. MAMP 5.0.0

## 使い方

1. 「Register」より、アカウント登録をしてください。(アカウント登録済みの方は「login」からログインしてください。)
2. 「新規メモ作成」欄から新規メモ、新規タグを作成します。
3. メモ一覧からメモを編集します。
4. タグ一覧から対象のタグを押下すると対象のタグ名で登録したメモを絞り込みます。

## インストール

※1.実行後「.env.example」ファイルを「.env」にリネーム。DB接続などをローカル用に書き換えてください。
書き換え項目例
  ・DB_HOST
  ・DB_PORT
  ・DB_DATABASE
  ・DB_PASSWORD
※5.実行前にsqlのデータベースの作成と作成したデータベース名を.envの「DB_DATABASE=」に入力してください。
※MAMPを使用の方はDocument Rootを下記に設定してください。
　Document Root：laravel-simple-memo/public

1. 本appをクローン
git clone https://github.com/yoshinori0811/laravel-simple-memo.git
2. laravel-simple-memoディレクトリ内に移動
cd laravel-simple-memo
3. composerインストール
composer install
4. アプリケーションキーの初期化をおこなう(.envにAPP_KEYが入る)
php artisan key:generate
5. マイグレーション
php artisan migrate
