<?php

session_start();

// エラーメッセージを表示する
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'funcs.php';
loginCheck();

//1. POSTデータ取得
$user_id = $_GET['user_id'];

$name = isset($_POST["name"]) ? $_POST["name"] : '';
$lid = isset($_POST["lid"]) ? $_POST["lid"] : '';
$lpw = isset($_POST["lpw"]) ? $_POST["lpw"] : '';
$admin_flg = isset($_POST["admin_flg"]) ? $_POST["admin_flg"] : '';
$life_flg = 0; // life_flgを0に設定

//2. DB接続します
$pdo = db_conn();

//3. ユーザーのライフフラグ変更SQL
$stmt = $pdo->prepare('UPDATE osakana_user_table SET life_flg = :life_flg WHERE user_id = :user_id');

//4. バインド変数を設定
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT); 
$stmt->bindValue(':life_flg', $life_flg, PDO::PARAM_INT);

//5. 実行
$status = $stmt->execute(); // 実行

//6. 処理後
if ($status === false) {
    sql_error($stmt);
} else {
    redirect('settings.php');
}
