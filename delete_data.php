<?php
require_once('funcs.php');

// 1. POSTデータ取得
$id = isset($_POST['id']) ? $_POST['id'] : '';

if (empty($id)) {
  echo json_encode(['error' => 'Invalid ID']);
  exit;
}

// 2. DB接続します
$pdo = db_conn();

// 3. ファイルパスを取得するために該当レコードを取得
$stmt = $pdo->prepare("SELECT photo FROM osakana_table WHERE id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();
$file_path = '';
if ($status) {
    // PDO::FETCH_ASSOCを指定することで、結果を連想配列として取得
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // if ($row)で、取得した行が存在するかどうかを確認
    if ($row) {
        $file_path = $row['photo'];
    } else {
        echo json_encode(['error' => 'Data not found']);
        exit;
    }
} else {
    sql_error($stmt);
}

// 4. ファイルを削除
if (!empty($file_path) && file_exists($file_path)) {
    unlink($file_path);
}

// 5. データ削除SQL作成
$stmt = $pdo->prepare("DELETE FROM osakana_table WHERE id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

// 6. データ削除処理後
if($status === false) {
  sql_error($stmt);
} else {
  echo json_encode(['success' => true]);
}

