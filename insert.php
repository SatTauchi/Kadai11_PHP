<?php

session_start();

// エラーメッセージを表示する
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 1. POSTデータ取得
// login_act.phpよりuser_idを取得
$user_id = $_SESSION['user_id'];

$date = isset($_POST["date"]) ? $_POST["date"] : '';
$fish = isset($_POST["fish"]) ? $_POST["fish"] : '';
$place = isset($_POST["place"]) ? $_POST["place"] : '';
$price = isset($_POST["price"]) ? $_POST["price"] : '';
$remarks = isset($_POST["remarks"]) ? $_POST["remarks"] : '';

// アップロードディレクトリの指定
$uploadDir = 'uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true); // ディレクトリが存在しない場合に作成
}

// 画像ファイルの処理
$imgFile = '';
if (isset($_FILES['imgFile']) && $_FILES['imgFile']['error'] == 0) {
    // フォームから画像が送られてきたらファイルの保存先を生成
    $upload_file = $_FILES['image']['tmp_name'];
    // ファイルのエクステンションを格納
    $extension = pathinfo($_FILES['imgFile']['name'], PATHINFO_EXTENSION);
    // ファイル名をユニークに変更
    $imgFile = uniqid() . '.' . $extension;
    // アップロードディレクトリパス. ファイル名
    $uploadFile = $uploadDir . $imgFile;
 
    if (move_uploaded_file($_FILES['imgFile']['tmp_name'], $uploadFile)) {
        // contentsテーブルに保存するために、ファイルパスを変数に入れる。
        $imgFile = $uploadFile;
    }
    else{
        exit('Error: File upload failed');
    }
}

// データが空でないことを確認 → エラーの場合メッセージを表示
if (empty($date) || empty($fish) || empty($price)) {
    exit('必須事項が入力されていません');
}

// imgFileが空の場合、デフォルトの値を設定
if (empty($imgFile)) {
    $imgFile = 'default.jpg';  // デフォルトの画像ファイル名
}

// 2. DB接続します
require_once('funcs.php');
$pdo = db_conn();

// 3. データ登録SQL作成
$stmt = $pdo->prepare('INSERT INTO osakana_table (id, user_id, date, fish, place, price, remarks, photo) 
                        VALUES (NULL, :user_id, :date, :fish, :place, :price, :remarks, :photo)');

// 4. バインド変数を設定
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);

$stmt->bindValue(':date', $date, PDO::PARAM_STR);
$stmt->bindValue(':fish', $fish, PDO::PARAM_STR);
$stmt->bindValue(':place', $place, PDO::PARAM_STR);
$stmt->bindValue(':price', $price, PDO::PARAM_INT);
$stmt->bindValue(':remarks', $remarks, PDO::PARAM_STR);
$stmt->bindValue(':photo', $imgFile, PDO::PARAM_STR);

// 5. 実行
$status = $stmt->execute();

// 6. データ登録処理後
if($status === false) {
    sql_error($stmt);
}
else {
// 7. data_list.phpへリダイレクト
    header('Location: data_input.php');
}
?>
