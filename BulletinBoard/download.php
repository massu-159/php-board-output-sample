<?php

// データベースの接続情報
define('DB_CONNECTION', 'psql');
define('DB_HOST', 'ec2-3-223-72-172.compute-1.amazonaws.com');
define('DB_USERNAME', 'mcapyoipwvajfb');
define('DB_PORT', '5432');
define('DB_DATABASE', 'd59oducka9g5p0');
define('DB_PASSWORD', 'a3435bb9478c04decbfeee822f9fe9138efd1aae7c7a097b39b1118262a64d05');

define('SslMode', 'DISABLED');

// 変数の初期化
$csv_data = null;
$sql = null;
$res = null;
$message_array = array();
$limit = null;

session_start();

if (!empty($_GET['limit'])) {
  if ($_GET['limit'] === "10") {
    $limit = 10;
  } elseif ($_GET['limit'] === "30") {
    $limit = 30;
  }
}

if (!empty($_SESSION['admin_login']) && $_SESSION['admin_login'] === true) {

  header("Content-Type: application/octet-stream");
  header("Content-Disposition: attachment; filename=メッセージデータ.csv");
  header("Content-Transfer-Encording: binary");

  // データベースに接続
  $mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

  // 接続エラーの確認
  if (!$mysqli->connect_errno) {

    if (!empty($limit)) {
      $sql = "SELECT * FROM message ORDER BY post_date ASC LIMIT $limit";
    } else {
      $sql = "SELECT * FROM message ORDER BY post_date ASC";
    }
    
    $res = $mysqli->query($sql);

    if ($res) {
      $message_array = $res->fetch_all(MYSQLI_ASSOC);
    }

    $mysqli->close();
  }

  // csvデータ作成
  if (!empty($message_array)) {
    // 一行目のラベル作成
    $csv_data .= '"ID", "表示名", "メッセージ", "投稿日時"' ."\n";
    foreach($message_array as $value){
      // データを一行ずつcsvファイルに書き込む
      $csv_data .= '"' . $value['id'] . '","' . $value['view_name'] . '", "' . $value['message'] . '", "' . $value['post_date'] . "\"\n";
    }
  }
  // ファイルを出力
  echo $csv_data;

} else {

  // ログインページへリダイレクト
  header("Location: ./admin.php");
}

return;
