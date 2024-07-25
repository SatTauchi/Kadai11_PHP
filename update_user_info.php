<?php 

session_start();
//関数群の読み込み
require_once('funcs.php');
//ログインセッションの確認
loginCheck();
//セッションからuser_idを取得
$user_id = $_SESSION['user_id'];
//セッションからnameを取得
$name = $_SESSION['name'];

// エラーメッセージを表示する
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 1. POSTデータ取得
$name = isset($_POST["name"]) ? $_POST["name"] : '';
$lid = isset($_POST["lid"]) ? $_POST["lid"] : '';
$lpw = isset($_POST["lpw"]) ? $_POST["lpw"] : '';

// $lpwをハッシュ化する
$hashed_pw = password_hash($lpw, PASSWORD_DEFAULT);

// 2. DB接続します
$pdo = db_conn();

// 3. データ登録SQL作成
$stmt = $pdo->prepare('UPDATE osakana_user_table
                       SET name = :name,
                           lid = :lid,
                           lpw = :lpw
                       WHERE user_id = :user_id');

// 4. バインド変数を設定
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $hashed_pw, PDO::PARAM_STR);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);

// 5. 実行
$status = $stmt->execute();

// 6. データ登録処理後
if ($status === false) {
    // SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    sql_error($stmt);
} else {
    // 7. data_list.htmlへリダイレクト
    redirect('user_register_update.php');
}
?>
