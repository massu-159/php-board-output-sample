# php-output-sample
PHPを使ったログイン機能のある掲示板サンプル

基礎学習のためフレームワークを使わず、作成。

DBはMySQLを使って記事データ保存。

セッションを使った認証機能を実装。

AWSのEC2を使って仮装サーバー構築。

urlはこちら
https://github.com/massu-159/php-outputーsample/

## アプリケーションの仕様

### 1. 仕様
- 記事投稿
  - 記事一覧表示
  - 記事新規投稿処理
  - 記事更新処理
  - 記事削除処理
- 認証
  - 会員登録
  - ログイン(ログアウト)
  - バリデーション

### 2. 構成技術
- php : "^7.3"
- MySQL : "8.0"
- EC2(AWS)