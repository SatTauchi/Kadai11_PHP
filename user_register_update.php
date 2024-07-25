<?php
session_start();
//関数群の読み込み
require_once('init.php');
require_once('funcs.php');
 //ログインセッションの確認
loginCheck();
//セッションからuser_idを取得
$user_id = $_SESSION['user_id'];
//セッションからnameを取得
$name = $_SESSION['name'];
// 1. クエリパラメータの確認 = GETで取得している内容を確認する
$id = $_GET['id'];
require_once('funcs.php');
$pdo = db_conn();
//２．データ詳細表示SQL作成
$stmt = $pdo->prepare('SELECT * FROM osakana_user_table WHERE user_id = :user_id;');
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$status = $stmt->execute();
//３．データ表示
$view = '';
if ($status === false) {
    sql_error($stmt);
} else {
    $result = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>おさかなハぅマっチ？ - 新規登録</title>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/user_register_update.css?<?php echo date('YmdHis');?>"/>
  <link rel="icon" href="img/Logo2.webp" type="image/x-icon">
  </head>

  <body>
  <header class="header">
    <div class="logo">
      <img src="img/Logo.png" alt="ロゴ">
      <span>おさかなハぅマっチ？</span>
      </div>
    <!--ここからハンバーガーメニュー-->
    <?php include('hamburger_menu.php'); ?>
    <!--ここまでハンバーガーメニュー-->
  </header>

  <!-- ここからナビゲーション -->
  <?php include('navigation_menu.php'); ?> 
  <!-- ここまでナビゲーション -->

  <div class="container">
    <div class="card">
      <h2 class="card-title">登録ユーザー情報の更新</h2>
      <form name="form1"  id="form1" action="update_user_info.php" method="post">
        <div class="form-group">
          <label for="name">お名前 *</label>
          <input type="text" class="form-control" name="name" value="<?= $result['name'] ?>" required>
        </div>
        <div class="form-group">
          <label for="lid">ユーザーID *</label>
          <input type="text" class="form-control" name="lid" value="<?= $result['lid'] ?>" required>
        </div>
        <div class="form-group">
          <label for="lpw">パスワード *半角英数字４文字以上</label>
          <input type="text" class="form-control" id="lpw" name= "lpw" placeholder="パスワードを入力" required>
        </div>
        <div id="errorMessage" style="color: red;"></div>
          <p></p>
        <div class="btn_area">
          <button type="submit" class="btn">更新</button>
          <p></p>
          <button class="btn" onclick="location.href='dashboard.php'">戻る</button>
        </div>
      </form>
    </div>
  </div>


  <footer>
    &copy; 2024 Osakana How much？ All rights reserved.
  </footer>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
  <script src="js/fish_price_checker01.js"></script>
  <script type="module" src="js/fish_price_checker01.js"></script>
  <!-- PWの入力バリデーション -->
  <script>
      document.getElementById('form1').addEventListener('submit', function(event) {
      var input = document.getElementById('lpw').value;
      var regex = /^[a-zA-Z0-9]{4,}$/;

      if (!regex.test(input)) {
        event.preventDefault();
        document.getElementById('errorMessage').textContent = '半角英数字４文字以上で入力して下さい';
      } else {
        document.getElementById('errorMessage').textContent = '';
      }
    });
  </script>
</body>






</html>
