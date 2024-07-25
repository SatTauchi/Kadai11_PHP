<?php
//共通に使う関数を記述
//XSS対応（ echoする場所で使用！それ以外はNG ）

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
  }

  //DB接続関数：db_conn() 
//※関数を作成し、内容をreturnさせる。

  function db_conn()
{
    try {
        $db_name = 'osakana_database'; //データベース名
        $db_id   = 'root'; //アカウント名
        $db_pw   = ''; //パスワード：MAMPは'root'
        $db_host = 'localhost'; //DBホスト
        $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
        return $pdo;
    } catch (PDOException $e) {
        exit('DB Connection Error:' . $e->getMessage());
    }

}
//SQLエラー関数：sql_error($stmt)

function sql_error($stmt){

  $error = $stmt->errorInfo();
  exit('SQLError:' . print_r($error, true));
  
  }
  
  //リダイレクト関数: redirect($file_name)
  
  function redirect($file_name){
      header('Location: ' . $file_name);
      exit();
  }

  //ログインチェク処理 loginCheck() エラー発生時にはindex.phpへリダイレクト
function loginCheck() {
  if (!isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid'] !== session_id()) {
      header('Location: index.php');
      exit();
  }

  // ログイン時間を確認し、一定時間が経過していたらログアウト
  $maxLoginTime = 1800; // 30分
  if (isset($_SESSION['login_time'])) {
      $elapsedTime = time() - $_SESSION['login_time'];
      if ($elapsedTime > $maxLoginTime) {
          // セッションをクリアしてログインページにリダイレクト
          session_unset();
          session_destroy();
          header('Location: index.php');
          exit();
      }
  }

  session_regenerate_id(true);
  $_SESSION['chk_ssid'] = session_id();
  // ログイン時間を更新
  $_SESSION['login_time'] = time();
}
?>
  