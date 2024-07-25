<?php
session_start();

//POST値を受け取る
$lid = filter_input(INPUT_POST, 'lid');
$lpw = filter_input(INPUT_POST, 'lpw');

//エラーメッセージの初期化
$err = [];

//IDのチェック
if (!$lid) {
    $err['lid'] = 'ログインIDを入力してください';
}

// パスワードのチェック
if (!$lpw) {
    $err['lpw'] = 'パスワードを入力してください';
}

if (count($err) > 0) {
    // エラーがあった場合は戻す
    $_SESSION['err'] = $err;
    header('Location: index.php');
    exit();
}

//DB接続
require_once('funcs.php');
$pdo = db_conn();

// データ登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM osakana_user_table WHERE lid = :lid');
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$status = $stmt->execute();

// SQL実行時にエラーがある場合STOP
if ($status === false) {
    sql_error($stmt);
}

// 抽出データを取得
$val = $stmt->fetch(PDO::FETCH_ASSOC);

// ユーザーが存在し、アカウントが有効で、パスワードが一致する場合
if ($val && $val['life_flg'] === 1 && password_verify($lpw, $val['lpw'])) {
    //Login成功時 該当レコードがあればSESSIONに値を代入
    $_SESSION['chk_ssid'] = session_id();
    $_SESSION['login_time'] = time(); // 現在のタイムスタンプを保存
    $_SESSION['user_id'] = $val['user_id'];
    $_SESSION['name'] = $val['name'];
    $_SESSION['admin_flg'] = $val['admin_flg'];
    header('Location: dashboard.php');
    exit();
} else {
    //Login失敗時
    $_SESSION['err'] = 'IDまたはパスワードが間違っています';
    header('Location: index.php');
    exit();
}
